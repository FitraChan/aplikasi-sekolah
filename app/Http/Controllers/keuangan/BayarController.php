<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use App\Models\Bayar;
use App\Models\Konfig;

use App\Models\DetBayar;
use App\Models\Gelombang;
use App\Models\ItemBayar;
use Illuminate\Support\Facades\DB;
use App\Models\DetTempBayar;
use App\Models\Kelas;
use App\Models\LogModel;
use Barryvdh\DomPDF\Facade\Pdf;



class BayarController extends Controller
{

    var $tahun, $smt;

    public function __construct()
    {
        $konfig = Konfig::first();
        $this->tahun = $konfig->id_tahun;
        $this->smt = $konfig->smt;
    }
    public function index()
    {
        $tahunSekarang = $this->tahun;
        $side = 'bayar';
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
        $status = DB::table('tb_status_transaksi')->get();


        return view(
            'keuangan.bayar.index',
            compact(
                'side',
                'tahun',
                'jurusan',
                'gelombang',
                'itemBayar',
                'kelas',
                'status'
            )
        );
    }

    public function update(Request $request, $id)
    {
        try {

            $bayar = Bayar::findOrFail($id);

            // Simpan data lama untuk log

            $bayar->update([
                'no_kwitansi' => $request->no_kwitansi,
                'tgl_bayar'   => date('Y-m-d', strtotime($request->tgl_bayar ?? now())),
                'id_kasir'    => auth()->user()->id,
                'keterangan'  => $request->keterangan,
            ]);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_bayar',
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

            $bayar = Bayar::findOrFail($id);

            // Ambil detail pembayaran
            $detailBayar = DetBayar::where('id_bayar', $id)->get();

            // Simpan data lama untuk log
            $dataBayarLama = $bayar->toArray();
            $dataDetailLama = $detailBayar->toArray();

            // Log tb_bayar
            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'tb_bayar',
                'aksi'       => 'soft_delete',
                'user'       => $user->id,
                'ip'         => $request->ip(),
                'serial'     => $request->userAgent(),
                'keterangan' => json_encode($dataBayarLama),
            ]);

            // Log tb_det_bayar
            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'tb_det_bayar',
                'aksi'       => 'soft_delete',
                'user'       => $user->id,
                'ip'         => $request->ip(),
                'serial'     => $request->userAgent(),
                'keterangan' => json_encode($dataDetailLama),
            ]);

            // Soft delete detail terlebih dahulu
            DetBayar::where('id_bayar', $id)->delete();

            // Soft delete master
            $bayar->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'title'   => 'Success',
                'msg'     => 'Data pembayaran berhasil dihapus sementara.'
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            report($e);

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
        /*
        |--------------------------------------------------------------------------
        | 1. REKAP PEMBAYARAN PER SISWA
        |--------------------------------------------------------------------------
        */

        $pembayaran = DB::table('tb_bayar as b')
            ->join('tb_det_bayar as c', 'b.id', '=', 'c.id_bayar')
            ->whereNull('b.deleted_at')
            ->whereNull('c.deleted_at')
            ->select(
                'b.id_siswa',

                DB::raw('SUM(c.kwajiban_bayar) as total_kewajiban'),

                DB::raw('SUM(c.potongan) as total_potongan'),

                DB::raw('SUM(
                CASE
                    WHEN b.sts_trans = 2
                    THEN c.jml_bayar
                    ELSE 0
                END
            ) as total_bayar')
            )
            ->groupBy('b.id_siswa');


       

        $query = Siswa::query()
            ->where('is_aktif', 1)

            ->with([
                'tahunAjaran:id,thn_ajaran',
                'jurusan:id,nama_jurusan',
                'gelombang:id,nama_gelombang',
                'kelas:idx,nama_kelas',
                'templateBayar:id,keterangan'
            ])

            ->leftJoinSub(
                $pembayaran,
                'p',
                function ($join) {
                    $join->on('p.id_siswa', '=', 'tb_siswa.nipd');
                }
            )

            ->select(
                'tb_siswa.*',

                DB::raw('COALESCE(p.total_bayar, 0) as total_bayar'),

                DB::raw('COALESCE(p.total_kewajiban, 0) as kewajiban'),

                DB::raw('COALESCE(p.total_potongan, 0) as potongan'),

                DB::raw('
                COALESCE(p.total_kewajiban, 0)
                - COALESCE(p.total_potongan, 0)
                - COALESCE(p.total_bayar, 0)
                as sisa
            ')
            );


       

        if ($request->filled('tahun')) {
            $query->whereHas('tahunAjaran', function ($q) use ($request) {
                $q->where('thn_ajaran', $request->tahun);
            });
        }

       
        if ($request->filled('jurusan')) {
            $query->where('tb_siswa.id_jurusan', $request->jurusan);
        }


       

        if ($request->filled('kelas')) {
            $query->whereHas('kelas', function ($q) use ($request) {
                $q->where(
                    'nama_kelas',
                    'like',
                    '%' . $request->kelas . '%'
                );
            });
        }


       

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {

                $q->where('tb_siswa.nama_lengkap', 'like', '%' . $request->keyword . '%')
                    ->orWhere('tb_siswa.nipd', 'like', '%' . $request->keyword . '%')
                    ->orWhere('tb_siswa.nisn', 'like', '%' . $request->keyword . '%');
            });
        }


       
        if ($request->filled('sts_trans')) {
            $query->whereHas('bayar', function ($q) use ($request) {
                $q->where('sts_trans', $request->sts_trans);
            });
        }


      
        $tahun = $this->tahun;

        $data = $query
            ->orderByDesc('tb_siswa.nipd')
            ->get()
            ->map(function ($item) use ($tahun) {

                $selisih = $tahun - $item->id_thn_ajaran;

                if ($selisih == 0) {
                    $kelas = 'X';
                } elseif ($selisih == 1) {
                    $kelas = 'XI';
                } else {
                    $kelas = 'XII';
                }

                $sisa = (float) $item->sisa;

                $kewajiban = (float) $item->kewajiban;

                if ($kewajiban <= 0) {
                    $statusBayar = 'Belum Ada Tagihan';
                } elseif ($sisa > 0) {
                    $statusBayar = 'Belum Lunas';
                } else {
                    $statusBayar = 'Lunas';
                }

                return [

                    'id' => $item->id,

                    'nipd' => $item->nipd,

                    'nama_lengkap' => $item->nama_lengkap,

                    'nisn' => $item->nisn,

                    'no_hp' => $item->no_hp,

                    'tahun_ajaran' => [
                        'thn_ajaran' => $item->tahunAjaran?->thn_ajaran,
                    ],

                    'jurusan' => [
                        'nama_jurusan' => $item->jurusan?->nama_jurusan,
                    ],

                    'kelas' => [
                        'nama_kelas' => trim(
                            $kelas . ' ' . ($item->kelas?->nama_kelas ?? '')
                        ),
                    ],

                    'gelombang' => [
                        'nama_gelombang' => $item->gelombang?->nama_gelombang,
                    ],

                    'template_bayar' => [
                        'keterangan' => $item->templateBayar?->keterangan,
                    ],

                    // REKAP PEMBAYARAN
                    'total_bayar' => (float) $item->total_bayar,

                    'kewajiban' => $kewajiban,

                    'potongan' => (float) $item->potongan,

                    'sisa' => $sisa,

                    'status_bayar' => $statusBayar,

                ];
            });

        return response()->json($data);
    }

    public function detail($nipd)
    {
        return Bayar::where('id_siswa', $nipd)
            ->orderBy('tgl_bayar', 'desc')
            ->get()
            ->map(function ($row) {

                return [
                    'id'            => $row->id,
                    'id_siswa'      => $row->id_siswa,
                    'tahun_ajaran'  => $row->id_tahun ?? '',
                    'bulan'         => $row->id_bulan ?? '',
                    'tgl_bayar'     => $row->tgl_bayar,
                    'tot_bayar'     => $row->tot_bayar,
                    'tot_kwajiban'  => $row->tot_kwajiban,
                    'keterangan'    => $row->keterangan,
                    'no_kwitansi'   => $row->no_kwitansi,
                    'bukti_bayar'   => $row->bukti_bayar,
                    'status' => $row->statusTransaksi?->nama ?? '',

                ];
            });
    }

    public function detailBayar($id)
    {
        return DetBayar::where('id_bayar', $id)
            ->get()
            ->map(function ($row) {

                return [
                    'id'        => $row->id,
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
            'id_tahun' => ['required', 'digits:4'],
            'id_bulan' => [
                'required',
                'in:all_bulan,1,2,3,4,5,6,7,8,9,10,11,12'
            ],
        ]);

        $idTahun = $request->id_tahun;
        $idBulan = $request->id_bulan;

        $berhasil      = 0;
        $gagal         = 0;
        $duplikat      = 0;
        $jumlahTagihan = 0;
        $siswaDiproses = 0;
        $adaSiswa      = false;

        $daftarBulan = $idBulan === 'all_bulan'
            ? range(1, 12)
            : [(int) $idBulan];

        try {

            /*
        |--------------------------------------------------------------------------
        | Ambil siswa per 500 data
        |--------------------------------------------------------------------------
        */

            Siswa::query()->chunkById(500, function ($siswaChunk) use (
                $idTahun,
                $daftarBulan,
                &$berhasil,
                &$gagal,
                &$duplikat,
                &$jumlahTagihan,
                &$siswaDiproses,
                &$adaSiswa
            ) {

                $adaSiswa = true;

                /*
            |--------------------------------------------------------------------------
            | Ambil seluruh ID template dalam chunk
            |--------------------------------------------------------------------------
            */

                $idTemplate = $siswaChunk
                    ->pluck('id_template_bayar')
                    ->filter()
                    ->unique()
                    ->values();

                /*
            |--------------------------------------------------------------------------
            | Ambil template sekaligus (menghindari query berulang)
            |--------------------------------------------------------------------------
            */

                $templateById = DetTempBayar::query()
                    ->whereIn('id_template', $idTemplate)
                    ->whereHas('itemBayar', function ($query) {
                        $query->where('id_kategori', 5);
                    })
                    ->get()
                    ->groupBy('id_template');

                /*
            |--------------------------------------------------------------------------
            | Proses satu chunk dalam satu transaksi
            |--------------------------------------------------------------------------
            */

                DB::transaction(function () use (
                    $siswaChunk,
                    $templateById,
                    $idTahun,
                    $daftarBulan,
                    &$berhasil,
                    &$gagal,
                    &$duplikat,
                    &$jumlahTagihan,
                    &$siswaDiproses
                ) {

                    foreach ($siswaChunk as $row) {

                        $detailTemplate = $templateById->get(
                            $row->id_template_bayar,
                            collect()
                        );

                        /*
                    |--------------------------------------------------------------------------
                    | Template tidak ditemukan
                    |--------------------------------------------------------------------------
                    */

                        if ($detailTemplate->isEmpty()) {
                            $gagal++;
                            continue;
                        }

                        $siswaDiproses++;

                        foreach ($daftarBulan as $bulan) {

                            /*
                        |--------------------------------------------------------------------------
                        | Cek duplikat
                        |--------------------------------------------------------------------------
                        */

                            $sudahAda = Bayar::query()
                                ->where('id_tahun', $idTahun)
                                ->where('id_bulan', $bulan)
                                ->where('id_siswa', $row->nipd)
                                ->exists();

                            if ($sudahAda) {
                                $duplikat++;
                                continue;
                            }

                            /*
                        |--------------------------------------------------------------------------
                        | Buat header tagihan
                        |--------------------------------------------------------------------------
                        */

                            $bayar = Bayar::create([
                                'id_tahun' => $idTahun,
                                'id_bulan' => $bulan,
                                'id_siswa' => $row->nipd,
                            ]);

                            /*
                        |--------------------------------------------------------------------------
                        | Buat detail tagihan
                        |--------------------------------------------------------------------------
                        */

                            foreach ($detailTemplate as $item) {

                                DetBayar::create([
                                    'id_bayar'       => $bayar->id,
                                    'id_item'        => $item->id_item,
                                    'kwajiban_bayar' => $item->jml_bayar,
                                    'potongan'       => 0,
                                    'jml_bayar'      => 0,
                                ]);

                                $berhasil++;
                            }

                            /*
                        |--------------------------------------------------------------------------
                        | Update total
                        |--------------------------------------------------------------------------
                        */

                            $this->updateTotalBayar($bayar->id);

                            $jumlahTagihan++;
                        }
                    }
                });
            }, 'id');

            /*
        |--------------------------------------------------------------------------
        | Tidak ada siswa
        |--------------------------------------------------------------------------
        */

            if (!$adaSiswa) {
                return response()->json([
                    'success' => false,
                    'title'   => 'Peringatan',
                    'msg'     => 'Tidak ada data siswa.',
                ], 422);
            }

            /*
        |--------------------------------------------------------------------------
        | Simpan log
        |--------------------------------------------------------------------------
        */

            LogModel::create([
                'tanggal' => now(),
                'tabel'   => 'tb_bayar',
                'aksi'    => 'create',
                'user'    => auth()->id(),
                'ip'      => $request->ip(),

                'keterangan' => json_encode([
                    'id_tahun'        => $idTahun,
                    'id_bulan'        => $idBulan,
                    'siswa_diproses'  => $siswaDiproses,
                    'jumlah_tagihan'  => $jumlahTagihan,
                    'detail_berhasil' => $berhasil,
                    'gagal'           => $gagal,
                    'duplikat'        => $duplikat,
                ]),

                'serial' => url('simpan'),
            ]);

            $keteranganBulan = $idBulan === 'all_bulan'
                ? 'Januari sampai Desember'
                : $this->namaBulan((int) $idBulan);

            return response()->json([
                'success' => true,
                'title'   => $duplikat > 0 ? 'Warning' : 'Success',

                'msg' => "Proses selesai untuk tahun pembayaran {$idTahun}, "
                    . "bulan {$keteranganBulan}. "
                    . "Siswa diproses: {$siswaDiproses}, "
                    . "tagihan dibuat: {$jumlahTagihan}, "
                    . "detail dibuat: {$berhasil}, "
                    . "template tidak ditemukan: {$gagal}, "
                    . "tagihan duplikat dilewati: {$duplikat}.",
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'title'   => 'Error',
                'msg'     => $e->getMessage(),
            ], 500);
        }
    }

    private function namaBulan(int $bulan): string
    {
        $daftarBulan = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $daftarBulan[$bulan] ?? '-';
    }



    public function updateTotalBayar($id)
    {
        $total = DetBayar::where('id_bayar', $id)
            ->sum('kwajiban_bayar')
            - DetBayar::where('id_bayar', $id)
            ->sum('potongan');

        Bayar::where('id', $id)
            ->update([
                'tot_kwajiban' => $total
            ]);
    }

    public function setLunas(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $noKwitansi = empty($request->no_kwitansi)
                ? 'BK'
                : $request->no_kwitansi;

            $keterangan = $request->keterangan;

            // Update semua detail menjadi lunas
            DetBayar::where('id_bayar', $id)
                ->update([
                    'jml_bayar' => DB::raw('kwajiban_bayar - potongan')
                ]);

            // Hitung total bayar
            $totalBayar = DetBayar::where('id_bayar', $id)
                ->sum('jml_bayar');

            // Update header pembayaran
            Bayar::where('id', $id)
                ->update([
                    'no_kwitansi' => $noKwitansi,
                    'tgl_bayar'   => $request->tgl_bayar,
                    'keterangan'  => $keterangan,
                    'tot_bayar'   => $totalBayar,
                    'sts_trans' => 2,
                    'id_kasir' => auth()->user()->id
                ]);

            DB::commit();

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_bayar',
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

            /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

            $request->validate([
                'id_csiswa'   => 'required',
                'tgl_bayar'   => 'nullable|date',
                'no_kwitansi' => 'nullable|string|max:100',
                'keterangan'  => 'nullable|string',

                'jml_dpp'      => 'nullable|numeric|min:0',
                'jml_seragam'  => 'nullable|numeric|min:0',
                'jml_spp'      => 'nullable|numeric|min:0',
                'jml_tabungan' => 'nullable|numeric|min:0',
                'jml_osis'     => 'nullable|numeric|min:0',
                'jml_lain'     => 'nullable|numeric|min:0',

                'bukti_bayar' => [
                    'nullable',
                    'file',
                    'mimes:jpg,jpeg,png,pdf',
                    'max:2048',
                ],
            ]);


            /*
        |--------------------------------------------------------------------------
        | UPLOAD BUKTI BAYAR
        |--------------------------------------------------------------------------
        */

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

            /*
        |--------------------------------------------------------------------------
        | SIMPAN PEMBAYARAN
        |--------------------------------------------------------------------------
        */

            $bayar = Bayar::create([
                'id_tahun'    => date('Y'),
                'id_bulan'    => date('m'),
                'id_siswa'    => $request->id_csiswa,
                'no_kwitansi' => $request->no_kwitansi,
                'tgl_bayar'   => date(
                    'Y-m-d',
                    strtotime($request->tgl_bayar ?? now())
                ),
                'id_kasir'    => auth()->user()->id,
                'keterangan'  => $request->keterangan,
                'sts_trans' => 2,

                // bukti pembayaran
                'bukti_bayar' =>  'uploads/pembayaran/' . $namaBuktiBayar,
            ]);


            $idBayar = $bayar->id;


            /*
        |--------------------------------------------------------------------------
        | DETAIL PEMBAYARAN
        |--------------------------------------------------------------------------
        */

            $items = [
                [
                    'nominal' => $request->jml_dpp ?? 0,
                    'id_item' => 2,
                ],
                [
                    'nominal' => $request->jml_seragam ?? 0,
                    'id_item' => 5,
                ],
                [
                    'nominal' => $request->jml_spp ?? 0,
                    'id_item' => 6,
                ],
                [
                    'nominal' => $request->jml_tabungan ?? 0,
                    'id_item' => 7,
                ],
                [
                    'nominal' => $request->jml_osis ?? 0,
                    'id_item' => 8,
                ],
            ];


            foreach ($items as $item) {

                if ((float) $item['nominal'] > 0) {

                    DetBayar::create([
                        'id_bayar'   => $idBayar,
                        'id_item'    => $item['id_item'],
                        'jml_bayar'  => $item['nominal'],
                        'id_cicilan' => $request->cicilan,
                    ]);
                }
            }


            /*
        |--------------------------------------------------------------------------
        | UPDATE KEWAJIBAN DAN PEMBAYARAN
        |--------------------------------------------------------------------------
        */

            $this->updateKewajiban($idBayar);

            $this->updateBayar($idBayar);


            /*
        |--------------------------------------------------------------------------
        | LOG
        |--------------------------------------------------------------------------
        */

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_bayar',
                'aksi' => 'create',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($bayar),
                'serial' => url('simpanCicilan'),
            ]);


            /*
        |--------------------------------------------------------------------------
        | COMMIT
        |--------------------------------------------------------------------------
        */

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
        $total = DetBayar::where('id_bayar', $id)
            ->sum('jml_bayar');

        return Bayar::where('id', $id)
            ->update([
                'tot_bayar' => $total
            ]);
    }
    public function updateKewajiban($id)
    {
        $total = DetBayar::where('id_bayar', $id)
            ->selectRaw('COALESCE(SUM(kwajiban_bayar),0) - COALESCE(SUM(potongan),0) as total')
            ->value('total');

        return Bayar::where('id', $id)
            ->update([
                'tot_kwajiban' => $total
            ]);
    }

    public function createReportPdf(Request $request, $id)
    {
        $hasil = Bayar::from('tb_bayar as tb_bayar')
            ->join('tb_det_bayar', 'tb_bayar.id', '=', 'tb_det_bayar.id_bayar')
            ->join('tb_itembayar', 'tb_det_bayar.id_item', '=', 'tb_itembayar.id')
            ->select(
                'tb_bayar.id_siswa',
                'tb_det_bayar.id_item',
                'tb_itembayar.nama_item',

                DB::raw('SUM(tb_bayar.tot_kwajiban) as SUMK1'),

                DB::raw('SUM(tb_det_bayar.kwajiban_bayar) as SUMK2'),
                DB::raw('SUM(tb_det_bayar.potongan) as SUMP'),

                DB::raw('SUM(
                    CASE WHEN tb_bayar.sts_trans = 2
                    THEN tb_det_bayar.jml_bayar
                    ELSE 0 END
                ) as SUMB'),

                DB::raw('SUM(
                    CASE WHEN tb_bayar.sts_trans = 2
                    THEN tb_bayar.tot_bayar
                    ELSE 0 END
                ) as SUMT1'),
            )
            ->where('tb_bayar.id_siswa', $id)
            ->whereNull('tb_bayar.deleted_at')
            ->whereNull('tb_det_bayar.deleted_at')
            //->where('tb_bayar.deleted_at',null)
            // ->where('tb_bayar.sts_trans',2)
            ->groupBy(
                'tb_bayar.id_siswa',
                'tb_det_bayar.id_item',
                'tb_itembayar.nama_item'
            )
            ->orderBy('tb_det_bayar.id_item')
            ->get();

        $atas = Siswa::with('kelas', 'jurusan')->where('nipd', $id)->first();

        $profile = DB::table('tb_profile')->first();

        $data = compact('hasil', 'atas', 'profile');



        if ($request->has('grid')) {
            return response()->json($data);
        }

        //return view('keuangan.bayar.rptkewajiban_pdf', $data);
        $pdf = Pdf::loadView(
            'keuangan.bayar.rptkewajiban_pdf',
            $data
        )->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-kewajiban-' . $atas->nipd . '.pdf');
    }

    public function detailVerifikasi($id)
    {
        $dataBayar = Bayar::with([
            'siswa',
            'tahunAjaran',
            'kasir',
            'approver',
            'detail.itemBayar',
            'bankPenerima',
            'bankPengirim',
            'statusTransaksi'

        ])->findOrFail($id);

        $siswa = $dataBayar->siswa;

        $detBayar = $dataBayar->detail;


        return view(
            'keuangan.bayar.detail_verifikasi_pembayaran',
            compact(
                'dataBayar',
                'siswa',
                'detBayar'
            )
        );
    }

    public function updateStatusTransaksi($id, Request $request)
    {

        $updated = Bayar::where('id', $id)
            ->where('sts_trans', 1)

            ->update([
                'sts_trans' => 2,
                'id_kasir' => auth()->user()->id,
            ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_bayar',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($updated),
            'serial' => url('updateStatusTransaksi') . '/' . $id,
        ]);

        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'Data transaksi tidak ditemukan atau tidak berubah.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil disetujui.'
        ]);
    }

    public function updateStatusDanBayarTransaksi(Request $request)
    {
        $request->validate([
            'id_detail_bayar' => 'required|integer',
            'id_bayar'        => 'required|integer',
            'jml_bayar'       => 'required|numeric|min:0',
        ]);


        DB::beginTransaction();

        try {

            $bayar = Bayar::where('id', $request->id_bayar)
                ->lockForUpdate()
                ->firstOrFail();

            // Pastikan detail pembayaran terkait dengan transaksi tersebut.
            $detail = DetBayar::where('id', $request->id_detail_bayar)
                ->where('id_bayar', $bayar->id)
                ->firstOrFail();

            // Update nominal detail pembayaran
            $detail->update([
                'jml_bayar' => $request->jml_bayar,
            ]);

            // Update status transaksi
            $bayar->update([
                'sts_trans' => 2,
                'id_kasir'  => auth()->id(),
            ]);

            // Hitung ulang total pembayaran
            $this->uptotalbayar($bayar->id);

            // Logging
            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_bayar',
                'aksi' => 'update',
                'user' => auth()->id(),
                'ip' => $request->ip(),
                'keterangan' => json_encode([
                    'id_bayar'        => $bayar->id,
                    'id_detail_bayar' => $detail->id,
                    'jml_bayar'       => $request->jml_bayar,
                    'sts_trans'       => 2,
                ]),
                'serial' => url('update-status-dan-bayar'),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Nominal pembayaran berhasil diperbarui dan status transaksi berhasil diubah.',
                'data' => [
                    'id_bayar' => $bayar->id,
                    'id_detail_bayar' => $detail->id,
                    'jml_bayar' => $detail->jml_bayar,
                    'sts_trans' => $bayar->sts_trans,
                ],
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            // Catat detail error di Laravel log


            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui pembayaran.',
                'error' => config('app.debug') ? $e->getMessage() : null,
                'location' => config('app.debug')
                    ? basename($e->getFile()) . ':' . $e->getLine()
                    : null,
            ], 500);
        }
    }

    private function uptotalbayar($id)
    {
        $total = DetBayar::where('id_bayar', $id)
            ->selectRaw('
            COALESCE(SUM(jml_bayar),0) as tot_bayar,
            COALESCE(SUM(kwajiban_bayar),0) - COALESCE(SUM(potongan),0) as tot_kwajiban
        ')->first();

        Bayar::where('id', $id)
            ->update([
                'tot_bayar'    => $total->tot_bayar,
                'tot_kwajiban' => $total->tot_kwajiban,
            ]);
    }





    public function cetakPdf(Request $request)
    {
        /*
    |--------------------------------------------------------------------------
    | 1. REKAP PEMBAYARAN
    |--------------------------------------------------------------------------
    */

        $pembayaran = DB::table('tb_bayar as b')
            ->join('tb_det_bayar as c', 'b.id', '=', 'c.id_bayar')
            ->whereNull('b.deleted_at')
            ->whereNull('c.deleted_at')
            ->select(
                'b.id_siswa',
                DB::raw('SUM(c.kwajiban_bayar) as total_kewajiban'),
                DB::raw('SUM(c.potongan) as total_potongan'),
                DB::raw('SUM(
                CASE
                    WHEN b.sts_trans = 2
                    THEN c.jml_bayar
                    ELSE 0
                END
            ) as total_bayar')
            )
            ->groupBy('b.id_siswa');


        /*
    |--------------------------------------------------------------------------
    | 2. QUERY SISWA
    |--------------------------------------------------------------------------
    */

        $query = Siswa::query()
            ->where('is_aktif', 1)
            ->with([
                'tahunAjaran:id,thn_ajaran',
                'jurusan:id,nama_jurusan',
                'gelombang:id,nama_gelombang',
                'kelas:idx,nama_kelas',
                'templateBayar:id,keterangan'
            ])
            ->leftJoinSub(
                $pembayaran,
                'p',
                function ($join) {
                    $join->on('p.id_siswa', '=', 'tb_siswa.nipd');
                }
            )
            ->select(
                'tb_siswa.*',
                DB::raw('COALESCE(p.total_bayar, 0) as total_bayar'),
                DB::raw('COALESCE(p.total_kewajiban, 0) as kewajiban'),
                DB::raw('COALESCE(p.total_potongan, 0) as potongan'),
                DB::raw('
                COALESCE(p.total_kewajiban, 0)
                - COALESCE(p.total_potongan, 0)
                - COALESCE(p.total_bayar, 0)
                as sisa
            ')
            );


        /*
    |--------------------------------------------------------------------------
    | 3. FILTER
    |--------------------------------------------------------------------------
    */

        if ($request->filled('tahun')) {
            $query->whereHas('tahunAjaran', function ($q) use ($request) {
                $q->where('thn_ajaran', $request->tahun);
            });
        }

        if ($request->filled('jurusan')) {
            $query->where('tb_siswa.id_jurusan', $request->jurusan);
        }

        if ($request->filled('kelas')) {
            $query->whereHas('kelas', function ($q) use ($request) {
                $q->where(
                    'nama_kelas',
                    'like',
                    '%' . $request->kelas . '%'
                );
            });
        }

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('tb_siswa.nama_lengkap', 'like', '%' . $request->keyword . '%')
                    ->orWhere('tb_siswa.nipd', 'like', '%' . $request->keyword . '%')
                    ->orWhere('tb_siswa.nisn', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('sts_trans')) {
            $query->whereHas('bayar', function ($q) use ($request) {
                $q->where('sts_trans', $request->sts_trans);
            });
        }


        /*
    |--------------------------------------------------------------------------
    | 4. AMBIL DATA
    |--------------------------------------------------------------------------
    */

        $tahun = $this->tahun;

        $data = $query
            ->orderByDesc('tb_siswa.nipd')
            ->get()
            ->map(function ($item) use ($tahun) {

                $selisih = $tahun - $item->id_thn_ajaran;

                if ($selisih == 0) {
                    $kelas = 'X';
                } elseif ($selisih == 1) {
                    $kelas = 'XI';
                } else {
                    $kelas = 'XII';
                }

                $sisa = (float) $item->sisa;
                $kewajiban = (float) $item->kewajiban;

                if ($kewajiban <= 0) {
                    $statusBayar = 'Belum Ada Tagihan';
                } elseif ($sisa > 0) {
                    $statusBayar = 'Belum Lunas';
                } else {
                    $statusBayar = 'Lunas';
                }

                return [
                    'id' => $item->id,
                    'nipd' => $item->nipd,
                    'nama_lengkap' => $item->nama_lengkap,
                    'nisn' => $item->nisn,
                    'no_hp' => $item->no_hp,

                    'tahun_ajaran' => $item->tahunAjaran?->thn_ajaran,

                    'jurusan' => $item->jurusan?->nama_jurusan,

                    'kelas' => trim(
                        $kelas . ' ' . ($item->kelas?->nama_kelas ?? '')
                    ),

                    'gelombang' => $item->gelombang?->nama_gelombang,

                    'template_bayar' => $item->templateBayar?->keterangan,

                    'total_bayar' => (float) $item->total_bayar,

                    'kewajiban' => $kewajiban,

                    'potongan' => (float) $item->potongan,

                    'sisa' => $sisa,

                    'status_bayar' => $statusBayar,
                ];
            });


        /*
    |--------------------------------------------------------------------------
    | 5. TOTAL KESELURUHAN
    |--------------------------------------------------------------------------
    */

        $totalKewajiban = $data->sum('kewajiban');
        $totalPotongan = $data->sum('potongan');
        $totalBayar = $data->sum('total_bayar');
        $totalSisa = $data->sum('sisa');


        /*
    |--------------------------------------------------------------------------
    | 6. GENERATE PDF
    |--------------------------------------------------------------------------
    */

        $pdf = Pdf::loadView('keuangan.bayar.rekap_pembayaran_pdf', [
            'data' => $data,
            'totalKewajiban' => $totalKewajiban,
            'totalPotongan' => $totalPotongan,
            'totalBayar' => $totalBayar,
            'totalSisa' => $totalSisa,
            'tanggalCetak' => now()->format('d-m-Y H:i'),
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('rekap-pembayaran.pdf');
    }
}
