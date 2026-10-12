<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use App\Models\BayarCalonSiswa;
use App\Models\CalonSiswa;
use App\Models\DetBayarCalonSiswa;
use App\Models\Gelombang;
use App\Models\UjianCalon;
use App\Models\IpaymuBayar;
use App\Models\IpaymuDetBayar;
use Illuminate\Support\Facades\Http;


use App\Models\ItemBayar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\DetTempBayar;
use App\Models\Kelas;
use App\Models\LogModel;
use App\Models\Konfig;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\KartuUjianMail;
use App\Models\BuktiBayarCalon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class BayarCalonSiswaController extends Controller
{
    var $tahun, $smt;
  
    public function __construct()
    {
        $konfig = Konfig::first();
        $this->tahun = $konfig->id_thn_ppdb;
        $this->smt = $konfig->smt;

      
    }  
    public function index()
    {
        $tahunSekarang = $this->tahun;

        $side = 'bayar-calon-siswa';
        $tahun =  TahunAjaran::whereBetween('id', [
                        $tahunSekarang - 3,
                        $tahunSekarang
                    ])
                    ->orderBy('id', 'desc')
                    ->get();
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        $gelombang = Gelombang::orderBy('nama_gelombang')->get();
        $itemBayar = ItemBayar::orderBy('nama_item')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();


        return view(
            'keuangan.bayar_calon_siswa.index',
            compact(
                'side',
                'tahun',
                'jurusan',
                'gelombang',
                'itemBayar',
                'kelas'
            )
        );
    }

    public function update(Request $request, $id)
    {
        try {

            $bayar = BayarCalonSiswa::findOrFail($id);

            // Simpan data lama untuk log

            $bayar->update([
                'no_kwitansi' => $request->no_kwitansi,
                'tgl_bayar'   => date('Y-m-d', strtotime($request->tgl_bayar ?? now())),
                'id_kasir'    => auth()->user()->id,
                'keterangan'  => $request->keterangan,
            ]);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_bayar_regis',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($bayar),
                'serial' => url('update')
            ]);

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'msg'     => 'Data telah tersimpan'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'title'   => 'Peringatan',
                'msg'     => 'Gagal mengubah data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {

            $user = auth()->user();



            DB::beginTransaction();

            $bayar = BayarCalonSiswa::findOrFail($id);

            $detailBayar = DetBayarCalonSiswa::where('id_bayar', $id)->get();

            // Log tb_bayar_regis
            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'tb_bayar_regis',
                'aksi'       => 'delete',
                'user'       => $user->id,
                'ip'         => $request->ip(),
                'serial'     => $request->userAgent(),
                'keterangan' => json_encode($bayar),
            ]);

            // Log tb_det_bayar_regis
            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'tb_det_bayar_regis',
                'aksi'       => 'delete',
                'user'       => $user->id,
                'ip'         => $request->ip(),
                'serial'     => $request->userAgent(),
                'keterangan' => json_encode($detailBayar),
            ]);

            // Hapus detail terlebih dahulu
            DetBayarCalonSiswa::where('id_bayar', $id)->delete();

            // Hapus master
            $bayar->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'title'   => 'Success',
                'msg'     => 'Proses berhasil dilakukan'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'title'   => 'Gagal',
                'msg'     => 'Proses gagal dilakukan',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function data(Request $request)
    {
        $query = CalonSiswa::with([
            'tahunAjaran:id,thn_ajaran',
            'jurusan:id,nama_jurusan',
            'gelombang:id,nama_gelombang',
            'kelas:idx,nama_kelas',
        ]);

        if ($request->filled('tahun')) {
            $query->whereHas('tahunAjaran', function ($q) use ($request) {
                $q->where('thn_ajaran', $request->tahun);
            });
        }

        if ($request->filled('jurusan')) {
            $query->where('id_jurusan', $request->jurusan);
        }

        if ($request->filled('kelas')) {
            $query->whereHas('kelas', function ($q) use ($request) {
                $q->where('id_kelas', 'like', '%' . $request->kelas . '%');
            });
        }

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->keyword . '%')
                ->orWhere('no_daftar', 'like', '%' . $request->keyword . '%');
            });
        }

        $data = $query
            ->orderByDesc('nipd')
            ->get()
            ->map(function ($item) {

                return [
                    'id' => $item->id,
                    'id_calon_siswa' => $item->id_calon_siswa,
                    'no_daftar' => $item->no_daftar,
                    'nama_lengkap' => $item->nama_lengkap,
                    'jk' => $item->jk,
                    'status_daftar' => $item->statusDaftar?->keterangan,

                    'no_hp' => $item->no_hp,

                    'tahun_ajaran' => [
                        'thn_ajaran' => $item->tahunAjaran?->thn_ajaran,
                    ],

                    'jurusan' => [
                        'nama_jurusan' => $item->jurusan?->nama_jurusan,
                    ],

                    'kelas' => [
                        'nama_kelas' => $item->kelas?->nama_kelas,
                    ],

                    'gelombang' => [
                        'nama_gelombang' => $item->gelombang?->nama_gelombang,
                    ],
                ];
            });

        return response()->json($data);
    }

    public function detail($nipd)
    {
        return BayarCalonSiswa::where('id_calon_siswa', $nipd)
            ->orderBy('tgl_bayar', 'desc')
            ->get()
            ->map(function ($row) {

                return [
                    'id'            => $row->id,
                    'id_calon_siswa'  => $row->id_calon_siswa,
                    'tahun_ajaran'  => $row->id_tahun ?? '',
                    'bulan'         => $row->id_bulan ?? '',
                    'tgl_bayar'     => $row->tgl_bayar,
                    'tot_bayar'     => $row->tot_bayar,
                    'total_kwajiban'  => $row->total_kwajiban,
                    'keterangan'    => $row->keterangan,
                    'no_kwitansi'   => $row->no_kwitansi,
                    'bukti_bayar'   => $row->bukti_bayar,
                ];
            });
    }

    public function detailBayar($id)
    {
        return DetBayarCalonSiswa::where('id_bayar', $id)
            ->get()
            ->map(function ($row) {

                return [
                    'id'            => $row->id,
                    'id_bayar'  => $row->id_bayar ?? '',
                    'nama_item' => $row->itemBayar->nama_item ?? '',
                    'id_item' => $row->id_item ?? '',
                    'kwajiban_bayar'     => $row->kwajiban_bayar,
                    'potongan'     => $row->potongan,
                    'jml_bayar'  => $row->jml_bayar,

                ];
            });
    }

   public function setDefBulan(Request $request)
    {
        $request->validate([
            'id_thn_ajaran' => ['required'],
            'id_jurusan'    => ['required'],
            'id_tahun'      => ['required'],
            'id_bulan'      => ['required'],
        ]);

        $idTahunAjaran = $request->id_thn_ajaran;
        $idJurusan     = $request->id_jurusan;
        $idTahun       = $request->id_tahun;
        $idBulan       = $request->id_bulan;

        $berhasil = 0;
        $gagal    = 0;

        DB::beginTransaction();

        try {
            $siswa = CalonSiswa::query()
                ->where('id_thn_ajaran', $idTahunAjaran)
                ->where('id_jurusan', $idJurusan)
                ->get();

            $nomorDaftar = $siswa->pluck('no_daftar');

            /*
            * Cari pembayaran lama pada bulan dan tahun yang sama,
            * khusus calon siswa pada tahun ajaran dan jurusan tersebut.
            */
            $bayarLama = BayarCalonSiswa::query()
                ->where('id_tahun', $idTahun)
                ->where('id_bulan', $idBulan)
                ->whereIn('id_calon_siswa', $nomorDaftar)
                ->get();
            
                if ($bayarLama->isNotEmpty()) {
                    return response()->json([
                    'success' => false,
                    'title'   => 'Error',
                    'msg'     => 'Sudah Ada Tagihan Di Bulan Ini',
                ], 500);
            }

            foreach ($siswa as $row) {
                $bayar = BayarCalonSiswa::create([
                    'id_tahun'        => $idTahun,
                    'id_bulan'        => $idBulan,
                    'id_calon_siswa'  => $row->no_daftar,
                ]);

                $detailTemplate = DetTempBayar::query()
                    ->where('id_template', $row->id_template_bayar)
                    ->whereHas('itemBayar', function ($query) {
                        $query->whereIn('id_kategori', [1, 2]);
                    })
                    ->get();

                foreach ($detailTemplate as $item) {
                    $detail = DetBayarCalonSiswa::create([
                        'id_bayar'       => $bayar->id,
                        'id_item'        => $item->id_item,
                        'kwajiban_bayar' => $item->jml_bayar,
                        'potongan'       => 0,
                        'jml_bayar'      => 0,
                    ]);

                    if ($detail) {
                        $berhasil++;
                    } else {
                        $gagal++;
                    }
                }

                $this->updateTotalBayar($bayar->id);
            }

            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'tb_bayar_regis',
                'aksi'       => 'create',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'keterangan' => json_encode([
                    'id_tahun'        => $idTahun,
                    'id_bulan'        => $idBulan,
                    'id_thn_ajaran'   => $idTahunAjaran,
                    'id_jurusan'      => $idJurusan,
                  
                    'jumlah_berhasil' => $berhasil,
                    'jumlah_gagal'    => $gagal,
                ]),
                'serial' => url('simpan'),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'title'   => 'Success',
                'msg'     => "Proses berhasil. {$bayarLama->count()} pembayaran lama dihapus. Detail berhasil dibuat: {$berhasil}, gagal: {$gagal}.",
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            report($e);

            return response()->json([
                'success' => false,
                'title'   => 'Error',
                'msg'     => $e->getMessage(),
            ], 500);
        }
    }



    public function updateTotalBayar($id)
    {
        $total = DetBayarCalonSiswa::where('id_bayar', $id)
            ->sum('kwajiban_bayar')
            - DetBayarCalonSiswa::where('id_bayar', $id)
            ->sum('potongan');

        BayarCalonSiswa::where('id', $id)
            ->update([
                'total_kwajiban' => $total
            ]);
    }

    public function setLunas(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $no_daftar =   BayarCalonSiswa::where('id',$id)->first();
            $noKwitansi = empty($request->no_kwitansi)
                ? 'BK'
                : $request->no_kwitansi;

            $keterangan = $request->keterangan;

            // Update semua detail menjadi lunas
            DetBayarCalonSiswa::where('id_bayar', $id)
                ->update([
                    'jml_bayar' => DB::raw('kwajiban_bayar - potongan')
                ]);

            // Hitung total bayar
            $totalBayar = DetBayarCalonSiswa::where('id_bayar', $id)
                ->sum('jml_bayar');

            // Update header pembayaran
            BayarCalonSiswa::where('id', $id)
                ->update([
                    'no_kwitansi' => $noKwitansi,
                    'tgl_bayar'   => $request->tgl_bayar,
                    'keterangan'  => $keterangan,
                    'tot_bayar'   => $totalBayar,
                ]);

             CalonSiswa::where('no_daftar', $no_daftar->id_calon_siswa)->update(['status_daftar' => 1]);   

                $calonSiswa = CalonSiswa::where(
                            'no_daftar',
                            $no_daftar->id_calon_siswa
                        )->firstOrFail();

                CalonSiswa::where('no_daftar', $no_daftar->id_calon_siswa)->update(['status_daftar' => 0]);  

                CalonSiswa::where(
                'no_daftar',
                $no_daftar->id_calon_siswa
                )->update([                            
                    'kartu_ujian_terbit'  => 1,
                    'tanggal_kartu_ujian' => now(),
                ]);


                $linkKartuUjian = URL::temporarySignedRoute(
                    'kartuUjian.download',
                    now()->addDays(7),
                    [
                        'calonSiswa' => $calonSiswa->id,
                    ]
                );

                if (!empty($calonSiswa->email)) {
                    Mail::to($calonSiswa->email)->send(
                        new KartuUjianMail(
                            $calonSiswa,
                            $linkKartuUjian
                        )
                    );
                }
                  

            DB::commit();

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_bayar_regis',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode(['id_bayar' => $id, 'no_kwitansi' => $noKwitansi, 'keterangan' => $keterangan]),
                'serial' => url('bayar/setLunas/' . $id)
            ]);

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'msg'     => 'Data telah tersimpan'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'title'   => 'Peringatan',
                'msg'     => $e->getMessage()
            ], 500);
        }
    }

    public function simpanCicilan(Request $request)
    {
        DB::beginTransaction();

        try {


         $namaBuktiBayar = null;

        if ($request->hasFile('bukti_bayar')) {

            $file = $request->file('bukti_bayar');

            $namaBuktiBayar =
                'bukti_cicilan_' .
                date('YmdHis') .
                '_' .
                uniqid() .
                '.' .
                $file->getClientOriginalExtension();          

             $file->storeAs(
                    'uploads/pembayaran',
                    $namaBuktiBayar,
                    'public'
                );

        }
               

            $bayar = BayarCalonSiswa::create([
                'id_tahun'    => date('Y'),
                'id_bulan'    => date('m'),
                'id_calon_siswa'    => $request->id_csiswa,
                'no_kwitansi' => $request->no_kwitansi,
                'tgl_bayar'   => date('Y-m-d', strtotime($request->tgl_bayar ?? now())),
                'id_kasir'    => auth()->user()->id,
                'keterangan'  => $request->keterangan,
                'bukti_bayar' =>  'uploads/pembayaran/' .$namaBuktiBayar,
            ]);

            if($request->id_bukti != 0){

                    BuktiBayarCalon::where('id', $request->id_bukti)->update(['status' => 2]);
            }

            $idBayar = $bayar->id;

            $items = [
                [
                    'nominal' => $request->jml_pendaftaran,
                    'id_item' => 1,
                ],
                [
                    'nominal' => $request->jml_dpp,
                    'id_item' => 2,
                ],
                [
                    'nominal' => $request->jml_mos,
                    'id_item' => 3,
                ],
                [
                    'nominal' => $request->jml_seragam,
                    'id_item' => 5,
                ],
            ];

            foreach ($items as $item) {

                if ($item['nominal'] > 0) {

                    $detail =  DetBayarCalonSiswa::create([
                        'id_bayar'   => $idBayar,
                        'id_item'    => $item['id_item'],
                        'jml_bayar'  => $item['nominal'],
                        'id_cicilan' => $request->cicilan,
                    ]);

                    if($item['id_item'] == 1){

                        $calonSiswa = CalonSiswa::where(
                                        'no_daftar',
                                        $request->id_csiswa
                                    )->firstOrFail();

                        CalonSiswa::where('no_daftar', $request->id_csiswa)->update(['status_daftar' => 0]);  


                         CalonSiswa::where(
                            'no_daftar',
                            $request->id_csiswa
                        )->update([                            
                            'kartu_ujian_terbit'  => 1,
                            'tanggal_kartu_ujian' => now(),
                        ]);


                         $linkKartuUjian = URL::temporarySignedRoute(
                                'kartuUjian.download',
                                now()->addDays(7),
                                [
                                    'calonSiswa' => $calonSiswa->id,
                                ]
                            );

                            if (!empty($calonSiswa->email)) {
                                Mail::to($calonSiswa->email)->send(
                                    new KartuUjianMail(
                                        $calonSiswa,
                                        $linkKartuUjian
                                    )
                                );
                            }
                    }
                  
      
                }
            }

            $this->updateKewajiban($idBayar);
            $this->updateBayar($idBayar);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_bayar_regis',
                'aksi' => 'create',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($bayar),
                'serial' => url('simpanCicilan')
            ]);

           

            DB::commit();

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'bayar'   => $bayar,
                'detail'  => $items,
                'msg'     => 'Data telah tersimpan. ID : ' . $idBayar,
                'id'      => $idBayar,
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'title'   => 'Peringatan',
                'msg'     => $e->getMessage(),
            ], 500);
        }
    }

    public function updateBayar($id)
    {
        $total = DetBayarCalonSiswa::where('id_bayar', $id)
            ->sum('jml_bayar');

        return BayarCalonSiswa::where('id', $id)
            ->update([
                'tot_bayar' => $total
            ]);
    }
    public function updateKewajiban($id)
    {
        $total = DetBayarCalonSiswa::where('id_bayar', $id)
            ->selectRaw('COALESCE(SUM(kwajiban_bayar),0) - COALESCE(SUM(potongan),0) as total')
            ->value('total');

        return BayarCalonSiswa::where('id', $id)
            ->update([
                'total_kwajiban' => $total
            ]);
    }

    public function createReportPdf(Request $request, $id)
    {
        $hasil = DB::table('tb_bayar_regis')
            ->join('tb_det_bayar_regis', 'tb_bayar_regis.id', '=', 'tb_det_bayar_regis.id_bayar')
            ->join('tb_itembayar', 'tb_det_bayar_regis.id_item', '=', 'tb_itembayar.id')
            ->select(
                'tb_bayar_regis.id_calon_siswa',
                'tb_det_bayar_regis.id_item',
                'tb_itembayar.nama_item',
                DB::raw('SUM(tb_bayar_regis.tot_bayar) as SUMT1'),
                DB::raw('SUM(tb_bayar_regis.total_kwajiban) as SUMK1'),
                DB::raw('SUM(tb_det_bayar_regis.jml_bayar) as SUMB'),
                DB::raw('SUM(tb_det_bayar_regis.kwajiban_bayar) as SUMK2'),
                DB::raw('SUM(tb_det_bayar_regis.potongan) as SUMP')
            )
            ->where('tb_bayar_regis.id_calon_siswa', $id)
            ->groupBy(
                'tb_bayar_regis.id_calon_siswa',
                'tb_det_bayar_regis.id_item',
                'tb_itembayar.nama_item'
            )
            ->orderBy('tb_det_bayar_regis.id_item')
            ->get();

        $atas = CalonSiswa::with('kelas', 'jurusan')->where('no_daftar', $id)->first();

        $profile = DB::table('tb_profile')->first();

        $data = compact('hasil', 'atas', 'profile');



        if ($request->has('grid')) {
            return response()->json($data);
        }

        //return view('keuangan.bayar.rptkewajiban_pdf', $data);
        $pdf = Pdf::loadView(
            'keuangan.bayar_calon_siswa.rptkewajiban_pdf',
            $data
        )->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-kewajiban-' . $atas->nipd . '.pdf');
    }

    public function download(CalonSiswa $calonSiswa)
    {
        abort_unless(
            (bool) $calonSiswa->kartu_ujian_terbit,
            403,
            'Kartu ujian belum diterbitkan.'
        );

        $ujian = UjianCalon::query()
            ->where('id_gelombang', $calonSiswa->id_gelombang)
            ->where('status', 1)
            ->orderBy('tanggal_mulai')
            ->first();

        abort_if(
            !$ujian,
            404,
            'Jadwal ujian untuk gelombang calon siswa belum tersedia.'
        );

        $pdf = Pdf::loadView(
            'pendaftaran.ujian.kartu-ujian',
            compact('calonSiswa', 'ujian')
        )->setPaper('a4', 'portrait');

        return $pdf->download(
            'kartu-ujian-' . $calonSiswa->no_daftar . '.pdf'
        );
    }

     public function callback(Request $request)
    {
        Log::info('Callback iPaymu', $request->all());

        return response()->json([
            'success' => true
        ]);
    }

    public function ipaymu(Request $request)
    {
        // Ambil data calon siswa


        $siswa = CalonSiswa::where('id_user', auth()->user()->id)->first();

        $apiKey = 'SANDBOX18AEF286-79CD-44C6-8764-2C89B94C7872';
        $va      = '0000007864357063';

        try {

            $referenceId = 'INV-' . time();
            $userId      = auth()->id();

            $nominal = (int) preg_replace('/[^0-9]/', '', $request->nominal);

            DB::beginTransaction();

            /** =====================
             * SIMPAN DATA BAYAR
             * ===================== */
            $orderId = DB::table('tb_ipaymu_bayar')->insertGetId([
                'id_calon_siswa'   => $siswa->no_daftar,
                'id_tahun'    => date('Y'),
                'id_bulan'    => date('m'),
                'tgl_bayar'   => $request->tgl_trans ?? now(),
                'id_kasir'    => $userId,
                'via'         => 4,
                'sts_bayar'   => 2, // pending
                'no_kwitansi' => $request->no_kwitansi,
                'keterangan'  => $request->comments,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            $itemBayar = ItemBayar::find($request->item);

            DB::table('tb_ipaymu_det_bayar')->insert([
                'id_bayar' => $orderId,
                'nama_item' => $itemBayar->nama_item,
                'id_item' =>   $itemBayar->id,
                'jml_bayar' => $nominal,
                'id_user'  => $userId,
            ]);

            /** =====================
             * AMBIL DATA MAHASISWA
             * ===================== */


            /** =====================
             * DATA IPAYMU
             * ===================== */
            $data = [
                'buyerName'  => $siswa->nama_lengkap,
                'buyerPhone' => $siswa->no_hp,
                'buyerEmail' => $siswa->email,
                'amount'    => (int) $nominal,
                'referenceId' => $referenceId,
                'product'   => [$itemBayar->nama_item],
                'qty'       => [1],
                'price'     => [(int) $nominal],
                'notifyUrl' => url('api/calon-siswa/notifyPembayaran'),
                'returnUrl' => route('calon-siswa.success-pembayaran'),
                'cancelUrl' => route('calon-siswa.cancel-pembayaran'),
            ];

            $timestamp   = now()->setTimezone('Asia/Jakarta')->format('YmdHis');
            $body        = json_encode($data, JSON_UNESCAPED_SLASHES);
            $bodyHash    = strtolower(hash('sha256', $body));
            $stringToSign = "POST:{$va}:{$bodyHash}:{$apiKey}";
            $signature   = hash_hmac('sha256', $stringToSign, $apiKey);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'signature'    => $signature,
                'va'           => $va,
                'timestamp'    => $timestamp,
            ])->post('https://sandbox.ipaymu.com/api/v2/payment', $data);

            /** =====================
             * CEK RESPONSE IPAYMU
             * ===================== */
            if (!$response->successful() || !isset($response['Data']['Url'])) {
                DB::rollBack();
                return back()->with('error', 'Gagal membuat transaksi iPaymu');
            }

            DB::table('tb_ipaymu_transaction')->insert([
                'id_bayar'        => $orderId,
                'ipaymu_ref'      => $referenceId,
                'amount'          => (int) $nominal,
                'payment_url'     => $response['Data']['Url'],
                'session_id'      => $response['Data']['SessionID'] ?? null,
                'ipaymu_response' => json_encode($response['Data']),
                'status'          => 'pending',
                'signature'       => $signature,
                'created_at'      => now(),
            ]);



            DB::commit();

            return redirect($response['Data']['Url']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    function successPembayaran()
    {

        return redirect()->route('calon-siswa.profil')->with('success', 'pembayaran Berhasil');
    }

    function cancelPembayaran()
    {

        return redirect()->route('calon-siswa.profil');
    }

    public function notifyPembayaran(Request $request)
    {
        // =========================
        // AMBIL DATA WAJIB
        // =========================
        $referenceId = $request->input('reference_id');


        if (!$referenceId) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        DB::beginTransaction();

        // =========================
        // CARI TRANSAKSI (LOCK)
        // =========================
        $trx = DB::table('tb_ipaymu_transaction')
            ->where('ipaymu_ref', $referenceId)
            ->lockForUpdate()
            ->first();

        if (!$trx) {
            DB::rollBack();
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        // =========================
        // IDEMPOTENCY CHECK
        // =========================
        if ($trx->status === 'success') {
            DB::commit();
            return response()->json(['message' => 'Already processed'], 200);
        }

        // =========================
        // VALIDASI SETTLED
        // =========================
        // if ($statusCode !== 1 || $settlement !== 'settled') {
        //     DB::commit();
        //     return response()->json(['message' => 'Payment not settled'], 200);
        // }

        // =========================
        // UPDATE TRANSAKSI
        // =========================
        DB::table('tb_ipaymu_transaction')
            ->where('id', $trx->id)
            ->update([
                'status'          => 'success',
                'payment_method' => $request->input('via'),      // contoh: va
                'payment_channel' => $request->input('channel'),  // contoh: danamon
                'paid_at'        => $request->input('paid_at') ?? now(),
                'ipaymu_response' => json_encode($request->all()),
                'updated_at'     => now(),
            ]);

        $ipaymuBayar = DB::table('tb_ipaymu_bayar')
            ->where('id', $trx->id_bayar)
            ->first();

        $ipaymuDetBayar = DB::table('tb_ipaymu_det_bayar')
            ->where('id_bayar', $trx->id_bayar)
            ->first();

        $bayar = BayarCalonSiswa::create([
            'id_tahun'    => date('Y'),
            'id_bulan'    => date('m'),
            'id_calon_siswa'    => $ipaymuBayar->id_calon_siswa,
            'no_kwitansi' => $request->no_kwitansi,
            'tgl_bayar'   => now(),
            'id_kasir'    => auth()->user()->id,
            'keterangan'  => $request->keterangan ?? 'Pembayaran iPaymu',
        ]);

        $idBayar = $bayar->id;

        DetBayarCalonSiswa::create([
            'id_bayar'   => $idBayar,
            'id_item'    => $ipaymuDetBayar->id_item,
            'jml_bayar'  => $ipaymuDetBayar->jml_bayar,
            'id_cicilan' => $request->cicilan,
        ]);

        if($ipaymuDetBayar->id_item == 1){
            CalonSiswa::where('no_daftar',$ipaymuBayar->id_calon_siswa)->update(['status_daftar' => 0]);
        }

        if($ipaymuDetBayar->id_item > 1){
            CalonSiswa::where('no_daftar',$ipaymuBayar->id_calon_siswa)->update(['status_daftar' => 1]);
        }


        BayarCalonSiswa::updateBayar($idBayar);
        BayarCalonSiswa::updateKewajiban($idBayar);

        DB::commit();

        return response()->json(['message' => 'Notifikasi diterima'], 200);
    }

    function dataIpaymu($id){

        $data = IpaymuBayar::with([
            'detailBayar',
            'calonSiswa'
        ])->find($id);

        return response()->json($data);
    }
}
