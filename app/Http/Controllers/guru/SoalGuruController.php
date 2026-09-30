<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gtk;
use App\Models\Soal;
use App\Models\JenisSoal;
use App\Models\MasterJadwal;
use App\Models\LogModel;
use Illuminate\Support\Facades\DB;

class SoalGuruController extends Controller
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

        return view('guru.soal.index', [
            'side'       => 'soalGuru',
            'thn'        => $id_tahun,
            'smt'        => $smt == 1 ? 'Ganjil' : 'Genap',
            'nama_gtk'   => $idGtk->nama_gtk,
            'jenis_soal' => $jenisSoal,
            'mapel'      => $mapel,
        ]);
    }

    public function data()
    {

        $idGtk = Gtk::where('user_id', auth()->id())->first();

        $data = Soal::with([
            'mapel',
            'jenisSoal'
        ])
            ->where('lecture_id', $idGtk->id)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) {

                return [
                    'id'              => $item->id,
                    'judul_soal'      => $item->judul_soal,
                    'soal'            => $item->soal,
                    'semester'        => $item->smt,
                    'jenis_soal'      => $item->jenisSoal?->jenis_soal,
                    'nama_mapel'      => $item->mapel?->nama_mapel,
                    'jawaban_benar'   => $item->jawaban_benar,
                    'created_at'      => optional($item->created_at)->format('d-m-Y H:i'),
                    'updated_at'      => optional($item->updated_at)->format('d-m-Y H:i'),
                ];
            });

        return response()->json($data);
    }

    public function create()
    {

        $konfig = konfig();

        $smt = $konfig['smt'];
        $id_tahun = $konfig['id_tahun'];

        $idGtk = Gtk::where('user_id', auth()->id())->first();
        $jenisSoal = JenisSoal::orderBy('id')->get();
        $mapel = MasterJadwal::with(['mapel', 'kelas'])
            ->where('id_gtk', $idGtk->id)
            // ->where('id_tahun', $id_tahun)
            // ->where('semester', $smt)
            ->get()
            ->map(function ($item) {
                return [
                    'id'          => $item->id,
                    'id_mapel'    => $item->id_mapel,
                    'nama_mapel'  => $item->mapel->nama_mapel,
                    'id_gtk'      => $item->id_gtk,
                    // 'kelas'       => $item->kelas->kelas,
                    // 'nama_kelas'  => $item->kelas->nama_kelas,
                ];
            });

        return view('guru.soal.tambah', [
            'side'       => 'soalGuru',
            'thn'        => $id_tahun,
            'smt'        => $smt == 1 ? 'Ganjil' : 'Genap',
            'nama_gtk'   => $idGtk->nama_gtk,
            'jenis_soal' => $jenisSoal,
            'mapel'      => $mapel,
            'row'      => null,
        ]);
    }

    public function edit($id)
    {
        $konfig = konfig();

        $smt = $konfig['smt'];
        $id_tahun = $konfig['id_tahun'];

        $idGtk = Gtk::where('user_id', auth()->id())->first();
        $jenisSoal = JenisSoal::orderBy('id')->get();
        $mapel = MasterJadwal::with(['mapel', 'kelas'])
            ->where('id_gtk', $idGtk->id)
            ->get()
            ->map(function ($item) {
                return [
                    'id'          => $item->id,
                    'id_mapel'    => $item->id_mapel,
                    'nama_mapel'  => $item->mapel->nama_mapel,
                    'id_gtk'      => $item->id_gtk,
                    // 'kelas'       => $item->kelas->kelas,
                    // 'nama_kelas'  => $item->kelas->nama_kelas,
                ];
            });

        $hasil = Soal::with([
            'mapel',
            'jenisSoal'
        ])->find($id);

        return view('guru.soal.tambah', [
            'side'       => 'soalGuru',
            'thn'        => $id_tahun,
            'smt'        => $smt == 1 ? 'Ganjil' : 'Genap',
            'nama_gtk'   => $idGtk->nama_gtk,
            'jenis_soal' => $jenisSoal,
            'mapel'      => $mapel,
            'row'      => $hasil,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'soal'          => 'required',
            'jenis_soal_id' => 'required',
            'mapel_id'      => 'required',
            'jawaban_benar' => 'required',
        ]);

        DB::beginTransaction();

        $idGtk = Gtk::where('user_id', auth()->id())->first();

        try {

            $data = $request->only([
                'judul_soal',
                'soal',
                'jenis_soal_id',
                'mapel_id',
                'smt',
                'jawaban_a',
                'jawaban_b',
                'jawaban_c',
                'jawaban_d',
                'jawaban_e',
                'jawaban_benar'
            ]);

            $data['lecture_id'] = $idGtk->id;

            Soal::create($data);

            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'master_soals',
                'aksi'       => 'create',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'keterangan' => json_encode($data),
                'serial'     => url('soalGuru/store'),
            ]);

            DB::commit();

            return redirect()
                ->route('soalGuru.index')
                ->with('success', 'Soal berhasil disimpan.');
        } catch (\Throwable $e) {

            DB::rollBack();


            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_soal'     => 'required',
            'soal'           => 'required',
            'jenis_soal_id'  => 'required',
            'mapel_id'       => 'required',
            'jawaban_benar'  => 'required',
        ]);

        DB::beginTransaction();

        try {

            $soal = Soal::findOrFail($id);

            $data = $request->only([
                'judul_soal',
                'soal',
                'jenis_soal_id',
                'mapel_id',
                'smt',
                'jawaban_a',
                'jawaban_b',
                'jawaban_c',
                'jawaban_d',
                'jawaban_e',
                'jawaban_benar'
            ]);

            $soal->update($data);

            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'master_soals',
                'aksi'       => 'update',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'keterangan' => json_encode($data),
                'serial'     => url('soalGuru/update/' . $id),
            ]);

            DB::commit();

            return redirect()
                ->route('soalGuru.index')
                ->with('success', 'Soal berhasil diupdate.');
        } catch (\Throwable $e) {

            DB::rollBack();



            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $soal = Soal::findOrFail($id);

            $log = $soal->toArray();

            $soal->delete();

            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'master_soals',
                'aksi'       => 'delete',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'keterangan' => json_encode($log),
                'serial'     => url('soalGuru/' . $id),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'msg'     => 'Soal berhasil dihapus.'
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'title'   => 'Error',
                'msg'     => $e->getMessage()
            ], 500);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required',
            'filename' => 'required|file|mimes:csv,txt',
        ]);

        DB::beginTransaction();

        try {

            $file = $request->file('filename');

            // $file->move(storage_path('app/temp'), $namaFile);

            //$path = storage_path('app/temp/' . $namaFile);

            $path = $file->getRealPath();

            $idGtk = Gtk::where('user_id', auth()->id())->first();


            if (($handle = fopen($path, 'r')) !== false) {

                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    // dd($data);

                    // Lewati baris kosong
                    if (count($data) < 10) {
                        continue;
                    }

                    // Lewati header
                    if (!is_numeric($data[0])) {
                        continue;
                    }

                    if ($data[0] > 0) {
                      //  dd($data[0]);
                        $dataInsert = [
                            'judul_soal'    => null,
                            'soal'          => $data[1],
                            'jenis_soal_id' => 1,
                            'jawaban_a'     => $data[3],
                            'jawaban_b'     => $data[4],
                            'jawaban_c'     => $data[5],
                            'jawaban_d'     => $data[6],
                            'jawaban_e'     => $data[7],
                            'jawaban_benar' => $data[8],
                            'smt'           => $data[9],
                            'lecture_id'    => $idGtk->id,
                            'mapel_id'      => $request->mapel_id,
                        ];

                        $soal = Soal::create($dataInsert);

                      //  dd($dataInsert);
                    }
                }

                fclose($handle);
            }



            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'master_soals',
                'aksi'       => 'import',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'keterangan' => 'Import soal CSV',
                'serial'     => url('soalGuru/import'),
            ]);

            DB::commit();

            return redirect()
                ->route('soalGuru.index')
                ->with('success', 'Soal berhasil diimport.');
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
