<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gtk;
use App\Models\Quiz;
use App\Models\JenisSoal;
use App\Models\MasterJadwal;
use App\Models\LogModel;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    public function index()
    {
        $konfig = konfig();

        $smt = $konfig['smt'];
        $id_tahun = $konfig['id_tahun'];

        $idGtk = Gtk::where('user_id', auth()->id())->first();

        $jenisSoal = JenisSoal::orderBy('id')->get();

        $mapel = MasterJadwal::with(['mapel', 'kelas'])
            ->where('id_gtk', $idGtk->id)
            ->where('id_tahun', $id_tahun)
            ->where('semester', $smt)
            ->get()
            ->map(function ($item) {
                return [
                    'id'          => $item->id,
                    'id_mapel'    => $item->id_mapel,
                    'nama_mapel'  => $item->mapel->nama_mapel,
                    'id_gtk'      => $item->id_gtk,
                    'kelas'       => $item->nkelas,
                    'nama_kelas'  => $item->kelas->nama_kelas,
                ];
            });

        return view('guru.ujian.index', [
            'side'       => 'ujianGuru',
            'thn'        => $id_tahun,
            'smt'        => $smt == 1 ? 'Ganjil' : 'Genap',
            'nama_gtk'   => $idGtk->nama_gtk,
            'jenis_soal' => $jenisSoal,
            'mapel'      => $mapel,
        ]);
    }
    public function data()
    {
        $konfig = konfig();

        $smt = $konfig['smt'];
        $id_tahun = $konfig['id_tahun'];

        $idGtk = Gtk::where('user_id', auth()->id())->first();

        $data = Quiz::with(['masterJadwal.mapel', 'masterJadwal.kelas'])
            ->whereHas('masterJadwal', function ($q) use ($id_tahun, $smt, $idGtk) {
                $q->where('id_tahun', $id_tahun)
                ->where('semester', $smt)
                ->where('id_gtk', $idGtk->id);
            })
            ->latest()
            ->get()
            ->map(function ($item) {

                return [
                    'id'         => $item->id,
                    'judul'      => $item->judul,
                    'tgl_quiz'   => \Carbon\Carbon::parse($item->tgl_quiz)->format('d-m-Y'),
                    'kelas'      => $item->masterJadwal->nkelas . ' ' . $item->masterJadwal->kelas->nama_kelas,
                    'nama_mapel' => $item->masterJadwal->mapel->nama_mapel,
                    'updated_at' => $item->updated_at,
                ];
            });

        return response()->json($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'master_kelas_id'   => 'required|integer',
            'tgl_quiz'          => 'required|date',
            'tgl_mulai'         => 'required|date',
            'tgl_selesai'       => 'required|date|after:tgl_mulai',
            'durasi'            => 'required|integer|min:1',
        ]);

        try {

          $data =  Quiz::create([
                'created_by'      => auth()->user()->id, // atau auth()->id()
                'judul'           => $request->judul,
                'master_kelas_id' => $request->master_kelas_id,
                'tgl_quiz'        => date('Ymd', strtotime($request->tgl_quiz)),
                'tgl_mulai'       => date('YmdHis', strtotime($request->tgl_mulai)),
                'tgl_selesai'     => date('YmdHis', strtotime($request->tgl_selesai)),
                'durasi'          => $request->durasi,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);

              LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_trans_ajar',
                'aksi' => 'create',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($data),
                'serial' => url('ujian/store')
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
                'msg'     => 'Gagal menyimpan data',
                'error'   => $e->getMessage()
            ], 500);

        }
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $quiz = Quiz::findOrFail($id);

            // Simpan log sebelum dihapus
            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_trans_ajar',
                'aksi' => 'delete',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($quiz),
                'serial' => url('ujianGuru/destroy')
            ]);

            $quiz->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'msg'     => 'Data berhasil dihapus.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'title'   => 'Error',
                'msg'     => $e->getMessage()
            ], 500);

        }
    }
}
