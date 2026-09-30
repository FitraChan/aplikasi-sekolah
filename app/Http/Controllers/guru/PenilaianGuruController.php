<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DetailQuiz;
use Illuminate\Http\Request;
use App\Models\MasterJadwal;
use App\Models\Gtk;
use App\Models\TransAjar;
use App\Models\Quiz;
use App\Models\LogModel;
use App\Models\JenisSoal;
use App\Models\Soal;
use App\Models\Nilai;
use App\Models\JawabanPeserta;
use App\Models\DetailJawabanPeserta;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class PenilaianGuruController extends Controller
{
    public function index()
    {
        $konfig = konfig();
        $smt = ($konfig['smt'] ?? 1) == 1 ? 'Ganjil' : 'Genap';
        return view('guru.pbm.index', [
            'side'  => 'pbm',
            'smt'   => $smt,
            'thn' => $konfig['id_tahun']

        ]);
    }

    public function data(Request $request)
    {

        $gtk = Gtk::where('user_id', auth()->user()->id)->first();

        $query = MasterJadwal::with([
            'tahun',
            'kelas',
            'mapel',
            'guru'
        ]);


        $query->where('id_tahun', konfig()['id_tahun']);

        $query->where('semester', konfig()['smt']);

        $query->where('id_gtk', $gtk->id);


        $data = $query
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) {

                return [
                    'id'            => $item->id,
                    'id_tahun'      => $item->id_tahun,
                    'semester'      => $item->semester,
                    'id_kelas'      => $item->id_kelas,
                    'id_mapel'      => $item->id_mapel,
                    'id_gtk'        => $item->id_gtk,
                    'jml_jam'       => $item->jml_jam,
                    'angkatan'      => $item->angkatan,
                    'tahun_ajaran'  => $item->tahun->thn_ajaran ?? '',
                    'nama_kelas'    => $item->nkelas->nama_kelas ?? '',
                    'kelas'         => $item->nkelas ?? '',
                    'nama_mapel'    => $item->mapel->nama_mapel ?? '',
                    'nama_gtk'      => $item->guru->nama_gtk ?? '',
                ];
            });

        return response()->json($data);
    }




    public function dataMateri(Request $request, $id = null)
    {
        $data['isi'] = TransAjar::withCount([
            'hadir as H',
            'izin as I',
            'sakit as S',
            'alfa as A',
        ])
            ->where('idjadwal', $id)
            ->orderBy('idpertemuan')
            ->orderBy('tgl')
            ->get()
            ->map(function ($item) {

                return [
                    'id'                  => $item->id,
                    'idjadwal'            => $item->idjadwal,
                    'idpertemuan'         => $item->idpertemuan,
                    'tgl'                 => $item->tgl
                        ? date('d-m-Y', strtotime($item->tgl))
                        : '',
                    'judul_materi'        => $item->judul_materi ?? '',
                    'nama_guru_pengganti' => $item->guruPengganti->nama_gtk ?? '',
                    'judul_tugas'         => $item->judul_tugas ?? '',
                    'keterangan'          => $item->keterangan ?? '',

                    'H' => $item->H,
                    'I' => $item->I,
                    'S' => $item->S,
                    'A' => $item->A,
                ];
            });

        $data['master'] = MasterJadwal::with(['kelas', 'mapel', 'guru'])
            ->where('id', $id)
            ->first();

        $data['guru'] = Gtk::select('id', 'nama_gtk')->get();

        $data['ujian'] = Quiz::where('master_kelas_id', $id)->get();
        $data['id'] = $id;

        return view('guru.materi_pbm.index', $data);

        //return response()->json($data);
    }

    public function dataAbsen(Request $request, $id = null)
    {
        $data['guru'] = Gtk::select('id', 'nama_gtk')->get();

        $data['master'] = TransAjar::with([
            'jadwal.kelas',
            'jadwal.mapel',
            'jadwal.guru',
            'guruPengganti'
        ])->findOrFail($id);

        $data['id'] = $id;


        $data['isi'] = Absensi::with([
            'siswa'
        ])
            ->where('idtransajar', $id)
            ->orderBy('nipd')
            ->get()
            ->map(function ($item) {

                return [
                    'id'         => $item->id,
                    'nipd'       => $item->nipd,
                    'nama_siswa' => $item->siswa->nama_lengkap ?? '',
                    'sts_hadir'  => $item->sts_hadir,
                    'keterangan' => $item->keterangan,
                ];
            });

        return view('guru.materi_pbm.materi.absen', $data);
    }

    public function editMateri($id)
    {
        $data['materi'] = TransAjar::findOrFail($id);

        $data['master'] = MasterJadwal::with(['kelas', 'mapel'])
            ->findOrFail($data['materi']->idjadwal);

        $data['guru'] = Gtk::select('id', 'nama_gtk')->get();

        $data['id'] = $data['materi']->idjadwal;

        return view('guru.materi_pbm.materi.tambah', $data);
    }

    public function tambahMateri($id)
    {
        $guru = Gtk::select('id', 'nama_gtk')->get();

        $master = MasterJadwal::with(['kelas', 'mapel', 'guru'])
            ->where('id', $id)
            ->first();



        return view('guru.materi_pbm.materi.tambah', [
            'side'  => 'pbm',
            'guru' => $guru,
            'master' => $master,
            'id' => $id,
            'materi' => null
        ]);
    }


    public function simpanMateri(Request $request)
    {
        DB::beginTransaction();

        try {

            $idjadwal = $request->idjadwal;
            $idpertemuan = $request->idpertemuan;

            $data = [
                'idjadwal'       => $request->idjadwal,
                'idpertemuan'    => $request->idpertemuan,
                'judul_materi'   => $request->judul_materi,
                'materi'         => $request->materi,
                'url_video'      => $request->url_video,
                'is_youtube'     => $request->is_youtube,
                'judul_tugas'    => $request->judul_tugas,
                'tugas'          => $request->tugas,
                'keterangan'     => $request->keterangan,
                'guru_pengganti' => $request->guru_pengganti,
                'tgl'            => date('Y-m-d', strtotime($request->tgl)),
                'tgl_batas_submit' => !empty($request->tgl_batas_submit)
                    ? date('Y-m-d H:i:s', strtotime($request->tgl_batas_submit))
                    : null,
                'jml_h'          => $request->jml_h,
                'jml_i'          => $request->jml_i,
                'jml_s'          => $request->jml_s,
                'jml_a'          => $request->jml_a,
                'created_at'     => now(),
                'updated_at'     => now(),
            ];

            // Materi 1
            if ($request->hasFile('url_materi_1')) {

                $file = $request->file('url_materi_1');

                $fileName = $idjadwal . '_' . $idpertemuan .
                    '_materi_1_' . date('dmY') . '.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/materi',
                    $fileName,
                    'public'
                );

                $data['url_materi_1'] =  'storage/app/public/uploads/materi/' . $fileName;
            }

            // Materi 2
            if ($request->hasFile('url_materi_2')) {

                $file = $request->file('url_materi_2');

                $fileName = $idjadwal . '_' . $idpertemuan .
                    '_materi_2_' . date('dmY') . '.' .
                    $file->getClientOriginalExtension();

                // $file->move($uploadPath, $fileName);

                $file->storeAs(
                    'uploads/materi',
                    $fileName,
                    'public'
                );

                $data['url_materi_2'] =  'storage/app/public/uploads/materi/' . $fileName;
            }

            // Materi 3
            if ($request->hasFile('url_materi_3')) {

                $file = $request->file('url_materi_3');

                $fileName = $idjadwal . '_' . $idpertemuan .
                    '_materi_3_' . date('dmY') . '.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/materi',
                    $fileName,
                    'public'
                );

                $data['url_materi_3'] =  'storage/app/public/uploads/materi/' . $fileName;
            }

            // Tugas
            if ($request->hasFile('url_tugas')) {

                $file = $request->file('url_tugas');

                $fileName = $idjadwal . '_' . $idpertemuan .
                    '_tugas_' . date('dmY') . '.' .
                    $file->getClientOriginalExtension();


                $file->storeAs(
                    'uploads/materi',
                    $fileName,
                    'public'
                );

                $data['url_tugas'] =  'storage/app/public/uploads/materi/' . $fileName;
            }

            // Insert tb_trans_ajar
            $idt = DB::table('tb_trans_ajar')->insertGetId($data);

            // Insert tb_hadir_siswa
            DB::statement("
                INSERT INTO tb_hadir_siswa(idtransajar, nipd)
                SELECT ?, tb_nilai.nipd
                FROM tb_nilai
                WHERE tb_nilai.idjadwal = ?
                ORDER BY tb_nilai.nipd
            ", [$idt, $idjadwal]);


            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_trans_ajar',
                'aksi' => 'create',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($data),
                'serial' => url('pbm/simpanMateri')
            ]);


            DB::commit();

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Data berhasil disimpan'
                );

            //  return response()->json([
            //     'success' => true,
            //     'data' => $data,
            //     'msg' => 'Data berhasil dihapus'
            // ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    public function hapusMateri($id)
    {
        try {

            DB::table('tb_trans_ajar')
                ->where('id', $id)
                ->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function updateMateri(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $materi = DB::table('tb_trans_ajar')
                ->where('id', $id)
                ->first();

            if (!$materi) {
                return redirect()
                    ->back()
                    ->with('error', 'Data tidak ditemukan');
            }

            $idjadwal = $request->idjadwal;
            $idpertemuan = $request->idpertemuan;

            $data = [
                'idjadwal'       => $request->idjadwal,
                'idpertemuan'    => $request->idpertemuan,
                'judul_materi'   => $request->judul_materi,
                'materi'         => $request->materi,
                'url_video'      => $request->url_video,
                'is_youtube'     => $request->is_youtube,
                'judul_tugas'    => $request->judul_tugas,
                'tugas'          => $request->tugas,
                'keterangan'     => $request->keterangan,
                'guru_pengganti' => $request->guru_pengganti,
                'tgl'            => date('Y-m-d', strtotime($request->tgl)),
                'tgl_batas_submit' => !empty($request->tgl_batas_submit)
                    ? date('Y-m-d H:i:s', strtotime($request->tgl_batas_submit))
                    : null,
                'jml_h'          => $request->jml_h,
                'jml_i'          => $request->jml_i,
                'jml_s'          => $request->jml_s,
                'jml_a'          => $request->jml_a,
                'updated_at'     => now(),
            ];

            // =====================
            // Materi 1
            // =====================
            if ($request->hasFile('url_materi_1')) {

                $file = $request->file('url_materi_1');

                $fileName = $idjadwal . '_' . $idpertemuan .
                    '_materi_1_' . date('dmY') . '.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/materi',
                    $fileName,
                    'public'
                );

                $data['url_materi_1'] = 'storage/app/public/uploads/materi/' . $fileName;
            }

            // =====================
            // Materi 2
            // =====================
            if ($request->hasFile('url_materi_2')) {

                $file = $request->file('url_materi_2');

                $fileName = $idjadwal . '_' . $idpertemuan .
                    '_materi_2_' . date('dmY') . '.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/materi',
                    $fileName,
                    'public'
                );

                $data['url_materi_2'] = 'storage/app/public/uploads/materi/' . $fileName;
            }

            // =====================
            // Materi 3
            // =====================
            if ($request->hasFile('url_materi_3')) {

                $file = $request->file('url_materi_3');

                $fileName = $idjadwal . '_' . $idpertemuan .
                    '_materi_3_' . date('dmY') . '.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/materi',
                    $fileName,
                    'public'
                );

                $data['url_materi_3'] = 'storage/app/public/uploads/materi/' . $fileName;
            }

            // =====================
            // Tugas
            // =====================
            if ($request->hasFile('url_tugas')) {

                $file = $request->file('url_tugas');

                $fileName = $idjadwal . '_' . $idpertemuan .
                    '_tugas_' . date('dmY') . '.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/materi',
                    $fileName,
                    'public'
                );

                $data['url_tugas'] = 'storage/app/public/uploads/materi/' . $fileName;
            }

            DB::table('tb_trans_ajar')
                ->where('id', $id)
                ->update($data);


            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_trans_ajar',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($data),
                'serial' => url('pbm/updateMateri')
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function simpanUjian(Request $request)
    {
        // $request->validate([
        //     'judul'            => 'required|string|max:255',
        //     'master_kelas_id'  => 'required',
        //     'tgl_quiz'         => 'required|date',
        //     'tgl_mulai'        => 'required|date',
        //     'tgl_selesai'      => 'required|date',
        //     'durasi'           => 'required|integer|min:1',
        // ]);

        try {

            $quiz =   Quiz::create([
                'created_by'      => auth()->user()->id,
                'judul'           => $request->judul,
                'master_kelas_id' => $request->master_kelas_id,
                'tgl_quiz'        => date('Y-m-d', strtotime($request->tgl_quiz)),
                'tgl_mulai'       => date('Y-m-d H:i:s', strtotime($request->tgl_mulai)),
                'tgl_selesai'     => date('Y-m-d H:i:s', strtotime($request->tgl_selesai)),
                'durasi'          => $request->durasi,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ]);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_trans_ajar',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($quiz),
                'serial' => url('pbm/updateMateri')
            ]);

            return redirect()
                ->back()
                ->with('success', 'Data berhasil ditambah');
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'title'   => 'Peringatan',
                'msg'     => 'Gagal menyimpan data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }


    public function deleteUjian(Request $request, $id)
    {
        try {

            $quiz = Quiz::findOrFail($id);

            // Simpan data sebelum dihapus
            $data = $quiz->toArray();

            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'quizs',
                'aksi'       => 'delete',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'keterangan' => json_encode($data),
                'serial'     => url('ujian/' . $id),
            ]);

            $quiz->delete();

            return response()->json([
                'success' => true,
                'msg'     => 'Data berhasil dihapus.'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'msg'     => 'Data gagal dihapus.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function dataDetQuiz(Request $request, $id = null)
    {
        $data['jenis_soal'] = JenisSoal::get();

        $konfig = konfig();

        $data['id'] = $id;


        $data['soals'] = DetailQuiz::with([
            'quiz',
            'soal'
        ])
            ->where('quiz_id', $id)
            ->orderBy('soal_id')
            ->get()
            ->map(function ($item) {

                return [
                    'id'              => $item->id,
                    'soal_id'         => $item->soal_id,

                    'soal'            => $item->soal->soal,
                    'jenis_soal_id'   => $item->soal->jenis_soal_id,
                    'jawaban_a'       => $item->soal->jawaban_a,
                    'jawaban_b'       => $item->soal->jawaban_b,
                    'jawaban_c'       => $item->soal->jawaban_c,
                    'jawaban_d'       => $item->soal->jawaban_d,
                    'jawaban_e'       => $item->soal->jawaban_e,
                    'jawaban_benar'   => $item->soal->jawaban_benar,
                ];
            });

        // Data ujian
        $data['ujian'] = Quiz::findOrFail($id);

        // Data master jadwal
        $data['idmapel'] = MasterJadwal::find($data['ujian']->master_kelas_id);

        // Jadwal guru
        $data['mapel'] = MasterJadwal::select(
            'id',
            'id_mapel',
            'id_gtk'
        )->with(['mapel', 'kelas'])
            ->where('id_gtk', auth()->id())
            ->where('id_tahun', $konfig['id_tahun'])
            ->where('semester', $konfig['smt'])
            ->get();

        $gtk = Gtk::where('user_id',auth()->id())->first();    

        // Master soal
            $data['mastersoal'] = Soal::with([
                'mapel',
                'jenisSoal'
            ])
            ->where('lecture_id', $gtk->id)
            ->get()
            ->map(function ($row) {

                return [
                    'id'             => $row->id,
                    'judul_soal'     => $row->judul_soal,
                    'soal'           => $row->soal,
                    'smt'            => $row->smt,
                    'jenis_soal'     => $row->jenisSoal->jenis_soal ?? '-',
                    'nama_mapel'     => $row->mapel->nama_mapel ?? '-',
                    'jawaban_benar'  => $row->jawaban_benar,
                    'created_at'     => $row->created_at,
                ];

            });
       
        // Jawaban siswa
        $data['jawabansiswa'] = Nilai::with([
            'siswa.jawabanPesertas' => function ($q) use ($id) {
                $q->where('quiz_id', $id);
            }
        ])
        ->where('idjadwal', $data['ujian']->master_kelas_id)
        ->get()
        ->map(function ($row) {

            $jawaban = $row->siswa->jawabanPesertas->first();

            return [
                'id'               => $row->id,
                'id_jawaban'       =>  optional($jawaban)->id,
                'nipd'              => $row->siswa->nipd ?? '',
                'nama_lengkap'       => $row->siswa->nama_lengkap ?? '',
                'tgl_mulai_quiz'   =>  date('d-m-Y H:i:s', strtotime(optional($jawaban)->tgl_mulai_quiz)),
                'tgl_selesai_quiz' => date('d-m-Y H:i:s', strtotime(optional($jawaban)->tgl_selesai_quiz)),
                'jwb_benar'        => optional($jawaban)->jwb_benar ?? 0,
                'jwb_salah'        => optional($jawaban)->jwb_salah ?? 0,
                'total_skor'       => optional($jawaban)->total_skor ?? 0,
            ];

        });



        return view('guru.materi_pbm.ujian.detail-ujian.index', $data);
    }

    public function cariSoal($id)
    {
        $row = Soal::where('id', $id)->first();

        $jenis_soal = JenisSoal::all();

        $mapel = MasterJadwal::with(['mapel', 'guru'])
            ->whereHas('guru', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->select('id_mapel', 'id_gtk')
            ->distinct()
            ->get();



        return response()->json([
            'row' => $row,
            'soal_id' => $id,
            'jenis_soal' => $jenis_soal,
            'mapel' => $mapel,
        ]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $file = $request->file('upload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
           
            $file->storeAs(
                'uploads/materi',
                $filename,
                'public'
            );

            // $data['url_tugas'] =  'uploads/materi/' . $filename;
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/app/public/uploads/materi/' . $filename);

            $msg = 'File berhasil diupload. Size: ' .
                number_format($file->getSize() / 1024, 2) . ' KB';
            return response(
                "<script>
            window.parent.CKEDITOR.tools.callFunction(
                {$CKEditorFuncNum},
                '{$url}',
                '{$msg}'
            );
        </script>"
            )->header('Content-Type', 'text/html; charset=utf-8');
        }

        return response()->json([
            'uploaded' => 0,
        ]);
    }

    public function updateSoal(Request $request)
    {
      
        DB::beginTransaction();

        try {

            $soal = Soal::findOrFail($request->id);



            // ===========================
            // Update data
            // ===========================
            $soal->update([

                'lecture_id'      => auth()->user()->id,

                'judul_soal'      => $request->judul_soal,
                'soal'            => $request->soal,
                'mapel_id'        => $request->mapel_id,
                'jenis_soal_id'   => $request->jenis_soal_id,
                'smt'             => $request->smt,

                'jawaban_benar'   => $request->jawaban_benar,

                'jawaban_a'       => $request->jawaban_a,
                'jawaban_b'       => $request->jawaban_b,
                'jawaban_c'       => $request->jawaban_c,
                'jawaban_d'       => $request->jawaban_d,
                'jawaban_e'       => $request->jawaban_e,

            ]);

            DB::commit();

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'master_soals',
                'aksi' => 'create',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($soal),
                'serial' => url('pbm/updateSoal')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Data gagal disimpan',
                // aktifkan hanya saat development
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function storeSoal(Request $request,$quizid)
    {
        DB::beginTransaction();

        try {

            $soal = new Soal();

            $soal->lecture_id      = auth()->id();
            $soal->judul_soal      = $request->judul_soal;
            $soal->soal            = $request->soal;
            $soal->mapel_id        = $request->mapel_id;
            $soal->jenis_soal_id   = $request->jenis_soal_id;
            $soal->smt             = $request->smt;

            $soal->jawaban_benar   = $request->jawaban_benar;

            $soal->jawaban_a       = $request->jawaban_a;
            $soal->jawaban_b       = $request->jawaban_b;
            $soal->jawaban_c       = $request->jawaban_c;
            $soal->jawaban_d       = $request->jawaban_d;
            $soal->jawaban_e       = $request->jawaban_e;

                
            $soal->save();

            $this->createDetQuiz2($quizid, $soal->id);

            DB::commit();

            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'master_soals',
                'aksi'       => 'create',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'keterangan' => json_encode($soal),
                'serial'     => url('pbm/storeSoal')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambahkan'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Data gagal ditambahkan',
                'error'   => $e->getMessage(),
            ], 500);
        }

        
    }

    public function createDetQuiz2($quizid, $soalid)
    {
        DB::beginTransaction();

        try {

            $noUrut = DetailQuiz::where('quiz_id', $quizid)
                        ->max('no_urut');

            $detail = DetailQuiz::create([
                'quiz_id'    => $quizid,
                'soal_id'    => $soalid,
                'no_urut'    => ($noUrut ?? 0) + 1,
            ]);

            DB::commit();

            return $detail;

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function dataMasterSoal()
    {
        $jenis_soal = JenisSoal::all();

        $mapel = MasterJadwal::with(['mapel', 'guru'])
            ->whereHas('guru', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->select('id_mapel', 'id_gtk')
            ->distinct()
            ->get();

        return response()->json([
            'jenis_soal' => $jenis_soal,
            'mapel'       => $mapel,
        ]);
    }

    public function deleteDetUjian(Request $request)
    {
        DB::beginTransaction();

        try {

            $detailQuiz = DetailQuiz::findOrFail($request->id);

            // Simpan log sebelum data dihapus
            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'detail_quizs',
                'aksi'       => 'delete',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'keterangan' => json_encode($detailQuiz),
                'serial'     => $request->userAgent(),
            ]);

            $detailQuiz->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'title'   => 'Success',
                'message' => 'Proses berhasil dilakukan',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'title'   => 'Gagal',
                'message' => 'Proses gagal dilakukan',
                // Aktifkan hanya saat development
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function createDetQuiz(Request $request, $quizid)
    {
        $request->validate([
            'soal_id' => 'required|exists:master_soals,id',
        ]);

        DB::beginTransaction();

        try {

            // Ambil no urut terakhir
            $nourut = DetailQuiz::where('quiz_id', $quizid)
                ->max('no_urut');

            $nourut = $nourut ?? 0;

            // Simpan
            $detail = DetailQuiz::create([
                'quiz_id'    => $quizid,
                'soal_id'    => $request->soal_id,
                'no_urut'    => $nourut + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Simpan log (opsional)
            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'detail_quizs',
                'aksi'       => 'create',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'serial'     => $request->userAgent(),
                'keterangan' => json_encode($detail),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data telah tersimpan.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data.',
                'error'   => $e->getMessage(), // hapus saat production
            ], 500);

        }
    }

    public function nilai($id = null)
    {
      $mapel=MasterJadwal::with(['kelas','mapel'])->where('id',$id)->first();

        return view('guru.pbm.nilai', [
            'side'  => 'pbm',
            'mapel' => $mapel

            

        ]);
    }

    public function detUjianSiswa($id)
    {
        $konfig = konfig();

        $idGtk = Gtk::where('user_id', auth()->id())->first();

        $jawabanPeserta = JawabanPeserta::find($id);

        if (!$jawabanPeserta) {
            return view('errornya');
        }

        $siswa = JawabanPeserta::with('siswa')
            ->where('id', $id)
            ->first();

        $ujian = Quiz::with('masterJadwal')
            ->find($jawabanPeserta->quiz_id);

        $idMapel = MasterJadwal::find($ujian->master_kelas_id);

        $jawabanSiswa = DetailJawabanPeserta::with([
            'detailQuiz.soal'
        ])
        ->where('jawaban_peserta_id', $id)
        ->get();

        return view('guru.materi_pbm.ujian.detail-ujian.detail_jawaban', [

            'side' => 'quiz',

            'thn' => $konfig['id_tahun'],

            'smt' => $konfig['smt'] == 1 ? 'Ganjil' : 'Genap',

            'nama_gtk' => $idGtk->nama_gtk,

            'jawabanpeserta' => $jawabanPeserta,

            'siswa' => $siswa,

            'ujian' => $ujian,

            'idmapel' => $idMapel,

            'jawabansiswa' => $jawabanSiswa,

        ]);
    }

}
