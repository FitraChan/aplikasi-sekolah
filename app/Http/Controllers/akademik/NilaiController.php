<?php

namespace App\Http\Controllers\akademik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Gtk;
use App\Models\JamPelajaran;
use App\Models\Jurusan;
use App\Models\PenjadwalanHari;

use Illuminate\Support\Facades\DB;
use App\Models\LogModel;
use App\Models\MasterJadwal;

class NilaiController extends Controller
{

    public function index()
    {
        $side = 'nilai';

        return view('akademik.nilai.index', [

            'side' => $side,

            'tahun' => TahunAjaran::orderBy('id', 'desc')->get(),

            'angkatan' => TahunAjaran::orderBy('id', 'desc')->get(),

            'jurusan' => Jurusan::orderBy('nama_jurusan')->get(),

            'kelas' => Kelas::orderBy('nama_kelas')->get(),

            'mapel' => Mapel::orderBy('nama_mapel')->get(),
            'guru'  => Gtk::orderBy('nama_gtk')->get(),

        ]);
    }

   public function data(Request $request)
    {
        $tahunAktif = TahunAjaran::where('isaktiv', 1)->first();

        $thn = $request->thn ?: $tahunAktif?->id;

        $query = MasterJadwal::with([
            'tahun',
            'kelas.jurusan',
            'mapel',
            'guru'
        ])
        ->where('id_tahun', $thn);

        if (!empty($request->ang)) {

            $query->where(
                'angkatan',
                'like',
                $request->ang
            );
        }

        if (!empty($request->jurusan)) {

            $query->whereHas('kelas', function ($q) use ($request) {

                $q->where(
                    'id_jurusan',
                    $request->jurusan
                );
            });
        }

        if (!empty($request->kelas)) {

            $query->where(
                'id_kelas',
                $request->kelas
            );
        }

        $data = $query
            ->orderBy('id_kelas')
            ->orderBy('id_mapel')
            ->get()
            ->map(function ($item) {

                return [

                    'id' => $item->id,

                    'id_tahun' => $item->id_tahun,

                    'tahun_ajaran' =>
                        $item->tahun?->thn_ajaran ?? '',

                    'semester' =>
                        $item->semester,

                    'angkatan' =>
                        $item->angkatan,

                    'id_kelas' =>
                        $item->id_kelas,

                    'nama_kelas' =>
                        $item->kelas?->nama_kelas ?? '',

                    'id_jurusan' =>
                        $item->kelas?->id_jurusan ?? '',

                    'nama_jurusan' =>
                        $item->kelas?->jurusan?->nama_jurusan ?? '',

                    'id_mapel' =>
                        $item->id_mapel,

                    'nama_mapel' =>
                        $item->mapel?->nama_mapel ?? '',

                    'id_gtk' =>
                        $item->id_gtk,

                    'nama_gtk' =>
                        $item->guru?->nama_gtk ?? '',

                    'jml_jam' =>
                        $item->jml_jam,
                ];
            });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $nilai = Nilai::create($request->all());

        return response()->json([
            'success' => true,
            'msg'     => 'Nilai berhasil disimpan',
            'data'    => $nilai
        ]);
    }

   

    public function delete($id)
    {
        Nilai::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'msg'     => 'Nilai berhasil dihapus'
        ]);
    }

    public function show($id)
    {
        $nilai = Nilai::with([
            'siswa',
            'mapel',
            'guru',
            'jadwal'
        ])->findOrFail($id);

        return response()->json($nilai);
    }

    public function detIndex(Request $request,$id)
    {
        $query = Nilai::where('idjadwal', $id);
        $thn_ajaran =  TahunAjaran::where('isaktiv',1)->first();   
      //  $thn = $request->thn ? $request->thn : $thn_ajaran->id;
        $thn = $request->thn;

         if ($thn) {
             $query->where('i_thn', $thn);
         }
        
        if ($request->semester) {
            $query->where('semester', $request->semester);
        }

       
        $data = $query
            ->get()
            ->map(function ($item) {

                return [
                    'id'            => $item->id,
                    'idjadwal'      => $item->idjadwal,
                    'nipd'          => $item->nipd,
                    'nama_lengkap'  => $item->siswa->nama_lengkap ?? '',
                    'p_1'  => $item->p_1,
                    'p_2'  => $item->p_2,
                    'p_3'  => $item->p_3,
                    'p_4'  => $item->p_4,
                    'p_5'  => $item->p_5,
                    'p_6'  => $item->p_6,
                    'p_7'  => $item->p_7,
                    'p_8'  => $item->p_8,
                    'p_9'  => $item->p_9,
                    'p_10' => $item->p_10,
                    'p_11' => $item->p_11,
                    'p_12' => $item->p_12,
                    'p_13' => $item->p_13,

                    'k_1'  => $item->k_1,
                    'k_2'  => $item->k_2,
                    'k_3'  => $item->k_3,
                    'k_4'  => $item->k_4,
                    'k_5'  => $item->k_5,
                    'k_6'  => $item->k_6,
                    'k_7'  => $item->k_7,
                    'k_8'  => $item->k_8,
                    'k_9'  => $item->k_9,
                    'k_10' => $item->k_10,
                    'k_11' => $item->k_11,
                    'k_12' => $item->k_12,
                    'k_13' => $item->k_13,

                    's_1'  => $item->s_1,
                    's_2'  => $item->s_2,
                    's_3'  => $item->s_3,
                    's_4'  => $item->s_4,
                    's_5'  => $item->s_5,
                    's_6'  => $item->s_6,
                    's_7'  => $item->s_7,
                    's_8'  => $item->s_8,
                    's_9'  => $item->s_9,
                    's_10' => $item->s_10,
                    's_11' => $item->s_11,
                    's_12' => $item->s_12,
                    's_13' => $item->s_13,

                    'd_p' => $item->d_p,
                    'd_k' => $item->d_k,
                ];
            });

        return response()->json($data);
    }

    

    public function update(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {

                foreach ($request->rows as $row) {

                    $id = $row['id'];

                    unset($row['id']);

                    Nilai::where('id', $id)
                        ->update($row);
                }
            });

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'msg'     => 'Data telah tersimpan'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'title'   => 'Error',
                'msg'     => 'Gagal menyimpan data',
                'error'   => $e->getMessage(), // hapus saat production
            ], 500);
        }
    }
}
