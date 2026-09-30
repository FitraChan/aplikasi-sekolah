<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use App\Models\Bayar;
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
    public function index()
    {
        
        $side = 'bayar';
        $tahun = TahunAjaran::orderBy('id', 'desc')->get();
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        $gelombang = Gelombang::orderBy('nama_gelombang')->get();
        $itemBayar = ItemBayar::orderBy('nama_item')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();


        return view(
            'keuangan.bayar.index',
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

            $detailBayar = DetBayar::where('id_bayar', $id)->get();

            // Log tb_bayar
            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'tb_bayar',
                'aksi'       => 'delete',
                'user'       => $user->id,
                'ip'         => $request->ip(),
                'serial'     => $request->userAgent(),
                'keterangan' => json_encode($bayar),
            ]);

            // Log tb_det_bayar
            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'tb_det_bayar',
                'aksi'       => 'delete',
                'user'       => $user->id,
                'ip'         => $request->ip(),
                'serial'     => $request->userAgent(),
                'keterangan' => json_encode($detailBayar),
            ]);

            // Hapus detail terlebih dahulu
            DetBayar::where('id_bayar', $id)->delete();

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
    $query = Siswa::with([
        'tahunAjaran:id,thn_ajaran',
        'jurusan:id,nama_jurusan',
        'gelombang:id,nama_gelombang',
        'kelas:idx,nama_kelas',
        'templateBayar:id,keterangan'
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
            $q->where('nama_kelas', 'like', '%' . $request->kelas . '%');
        });
    }

    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama_lengkap', 'like', '%' . $request->keyword . '%')
              ->orWhere('nipd', 'like', '%' . $request->keyword . '%')
              ->orWhere('nisn', 'like', '%' . $request->keyword . '%');
        });
    }

    $data = $query
        ->orderByDesc('nipd')
        ->get()
        ->map(function ($item) {

            return [
                'id' => $item->id,
                'nipd' => $item->nipd,
                'nama_lengkap' => $item->nama_lengkap,
                'nisn' => $item->nisn,

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

                'template_bayar' => [
                    'keterangan' => $item->templateBayar?->keterangan,
                ],
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
        'id_thn_ajaran' => ['required'],
        'id_jurusan'    => ['required'],
        'id_tahun'      => ['required', 'digits:4'],
        'id_bulan'      => ['required'],
    ]);

    $idTahunAjaran = $request->id_thn_ajaran;
    $idJurusan     = $request->id_jurusan;
    $idTahun       = $request->id_tahun;
    $idBulan       = $request->id_bulan;

    $berhasil       = 0;
    $gagal          = 0;
    $duplikat       = 0;
    $jumlahTagihan  = 0;
    $siswaDiproses  = 0;

    /*
    |--------------------------------------------------------------------------
    | Tentukan bulan yang diproses
    |--------------------------------------------------------------------------
    */

    $daftarBulan = $idBulan === 'all_bulan'
        ? range(1, 12)
        : [(int) $idBulan];

    /*
    |--------------------------------------------------------------------------
    | Ambil siswa
    |--------------------------------------------------------------------------
    */

    $querySiswa = Siswa::query()
        ->where('id_thn_ajaran', $idTahunAjaran);

    // Filter jurusan hanya jika bukan semua jurusan
    if ($idJurusan !== 'all_jurusan') {
        $querySiswa->where('id_jurusan', $idJurusan);
    }

    $siswa = $querySiswa->get();

    if ($siswa->isEmpty()) {
        return response()->json([
            'success' => false,
            'title'   => 'Peringatan',
            'msg'     => 'Tidak ada siswa yang ditemukan berdasarkan pilihan tersebut.',
        ], 422);
    }

    DB::beginTransaction();

    try {

        foreach ($siswa as $row) {

            /*
            |--------------------------------------------------------------------------
            | Ambil detail template pembayaran bulanan
            |--------------------------------------------------------------------------
            */

            $detailTemplate = DetTempBayar::query()
                ->where('id_template', $row->id_template_bayar)
                ->whereHas('itemBayar', function ($query) {
                    $query->where('id_kategori', 5);
                })
                ->get();

            /*
             * Jika siswa belum memiliki template pembayaran
             * atau tidak ada item kategori bulanan, lewati.
             */
            if ($detailTemplate->isEmpty()) {
                $gagal++;
                continue;
            }

            foreach ($daftarBulan as $bulan) {

                /*
                |--------------------------------------------------------------------------
                | Cek apakah tagihan siswa pada tahun dan bulan sudah ada
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

                $this->updateTotalBayar($bayar->id);

                $jumlahTagihan++;
            }

            $siswaDiproses++;
        }

        LogModel::create([
            'tanggal' => now(),
            'tabel'   => 'tb_bayar',
            'aksi'    => 'create',
            'user'    => auth()->id(),
            'ip'      => $request->ip(),

            'keterangan' => json_encode([
                'id_thn_ajaran' => $idTahunAjaran,
                'id_tahun'       => $idTahun,
                'id_bulan'       => $idBulan,
                'id_jurusan'     => $idJurusan,
                'siswa_diproses' => $siswaDiproses,
                'jumlah_tagihan' => $jumlahTagihan,
                'detail_berhasil'=> $berhasil,
                'gagal'          => $gagal,
                'duplikat'       => $duplikat,
            ]),

            'serial' => url('simpan'),
        ]);

        DB::commit();

        $keteranganBulan = $idBulan === 'all_bulan'
            ? 'Januari sampai Desember'
            : $this->namaBulan((int) $idBulan);

        $keteranganJurusan = $idJurusan === 'all_jurusan'
            ? 'semua jurusan'
            : "jurusan ID {$idJurusan}";

        return response()->json([
            'success' => true,
            'title'   => $duplikat > 0 ? 'Warning' : 'Success',
            'msg'     => "Proses selesai untuk {$keteranganJurusan}, bulan {$keteranganBulan}. "
                . "Siswa diproses: {$siswaDiproses}, "
                . "tagihan dibuat: {$jumlahTagihan}, "
                . "detail dibuat: {$berhasil}, "
                . "template tidak ditemukan: {$gagal}, "
                . "tagihan duplikat dilewati: {$duplikat}.",
        ]);

    } catch (\Throwable $e) {

        DB::rollBack();

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

            $bayar = Bayar::create([
                'id_tahun'    => date('Y'),
                'id_bulan'    => date('m'),
                'id_siswa'    => $request->id_csiswa,
                'no_kwitansi' => $request->no_kwitansi,
                'tgl_bayar'   => date('Y-m-d', strtotime($request->tgl_bayar ?? now())),
                'id_kasir'    => auth()->user()->id,
                'keterangan'  => $request->keterangan,
            ]);

            $idBayar = $bayar->id;

            $items = [
                [
                    'nominal' => $request->jml_dpp,
                    'id_item' => 2,
                ],
                [
                    'nominal' => $request->jml_seragam,
                    'id_item' => 5,
                ],
                [
                    'nominal' => $request->jml_spp,
                    'id_item' => 6,
                ],
                [
                    'nominal' => $request->jml_tabungan,
                    'id_item' => 7,
                ],
                [
                    'nominal' => $request->jml_osis,
                    'id_item' => 8,
                ],
            ];

            foreach ($items as $item) {

                if ($item['nominal'] > 0) {

                    $detail =  DetBayar::create([
                        'id_bayar'   => $idBayar,
                        'id_item'    => $item['id_item'],
                        'jml_bayar'  => $item['nominal'],
                        'id_cicilan' => $request->cicilan,
                    ]);
                }
            }

            $this->updateKewajiban($idBayar);
            $this->updateBayar($idBayar);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_bayar',
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
        $hasil = DB::table('tb_bayar')
            ->join('tb_det_bayar', 'tb_bayar.id', '=', 'tb_det_bayar.id_bayar')
            ->join('tb_itembayar', 'tb_det_bayar.id_item', '=', 'tb_itembayar.id')
            ->select(
                'tb_bayar.id_siswa',
                'tb_det_bayar.id_item',
                'tb_itembayar.nama_item',
                DB::raw('SUM(tb_bayar.tot_bayar) as SUMT1'),
                DB::raw('SUM(tb_bayar.tot_kwajiban) as SUMK1'),
                DB::raw('SUM(tb_det_bayar.jml_bayar) as SUMB'),
                DB::raw('SUM(tb_det_bayar.kwajiban_bayar) as SUMK2'),
                DB::raw('SUM(tb_det_bayar.potongan) as SUMP')
            )
            ->where('tb_bayar.id_siswa', $id)
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


    
}
