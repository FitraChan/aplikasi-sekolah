<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Siswa;

use App\Models\LogModel;
use Illuminate\Support\Facades\Log;

class SetKelasController extends Controller
{
    /**
     * Display a listing of temporary students for setting class.
     */
    public function index()
    {
        $side = 'set-kelas';

        $kelas = DB::table('v_sisa_kuota_kelas')
            ->orderBy('nama_kelas', 'asc')
            ->get();

        return view('pendaftaran.set_kelas.index', [
            'side' => $side,
            'kelas' => $kelas
        ]);
    }
       


    public function rekapKelas()
    {
        $side = 'rekap_kelas';

        $data = DB::table('tb_kelas')

            ->leftJoin(
                'tb_tmp_siswa',
                'tb_kelas.idx',
                '=',
                'tb_tmp_siswa.id_kelas'
            )

            ->leftJoin(
                'tb_thn_ajaran',
                'tb_tmp_siswa.id_thn_ajaran',
                '=',
                'tb_thn_ajaran.id'
            )

            ->leftJoin(
                'tb_jurusan',
                'tb_kelas.id_jurusan',
                '=',
                'tb_jurusan.id'
            )

            ->select(
                DB::raw('MAX(tb_kelas.id) as id'),
                DB::raw('MAX(tb_kelas.idx) as idx'),
                DB::raw('MAX(tb_kelas.nama_kelas) as nama_kelas'),
                DB::raw('MAX(tb_jurusan.nama_jurusan) as nama_jurusan'),
                DB::raw('COUNT(tb_tmp_siswa.id) as jml_siswa')
            )
            ->where('tb_kelas.kelas', 'X')
            ->orWhere('tb_kelas.kelas', 'x')
            ->where('tb_thn_ajaran.isaktiv', 1)
            ->groupBy(

                'tb_tmp_siswa.id_kelas',               
            )

            ->get();

        return view('pendaftaran.set_kelas.rekap_kelas', compact(            
            'data'
        ),[
            'side' => $side
        ]);
    }

   public function data()
    {
        $data = Siswa::with([
            'jurusan',
            'tahunAjaran',
            'kelas',
            'statusSiswa'
        ])
            ->latest('id')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,

                    'nipd' => $item->nipd ?? '-',

                    'nama_lengkap' => $item->nama_lengkap,

                    'nama_kelas' =>
                        optional($item->kelas)->nama_kelas ?? '-',

                    'tahun_ajaran' =>
                        optional($item->tahunAjaran)->thn_ajaran ?? '-',

                    'nama_jurusan' =>
                        optional($item->jurusan)->nama_jurusan ?? '-',

                    'status_siswa' =>
                      optional($item->statusSiswa)->status_siswa ?? '-',


                    'id_kelas' => $item->id_kelas,
                ];
            });

        return response()->json($data);
    }
    public function updateKelas(Request $request, $id)
    {
        $request->validate([

            'id_kelas' => 'required'

        ]);

        DB::table('tb_siswa')

            ->where('id', $id)

            ->update([

                'id_kelas' => $request->id_kelas,

                'updated_at' => now()

            ]);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_tmp_siswa',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode([
                    'id' => $id,
                    'id_kelas' => $request->id_kelas
                ]),
                'serial' => url('ubah-kelas/' . $id)
             ]);

        return response()->json([

            'success' => true,

            'message' => 'Kelas berhasil diupdate'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        DB::table('tb_siswa')

            ->where('id', $id)

            ->delete();

        return response()->json([

            'success' => true,

            'message' => 'Data berhasil dihapus'

        ]);
    }
}
