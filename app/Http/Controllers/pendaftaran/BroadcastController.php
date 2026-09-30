<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
use App\Models\Gelombang;

use Illuminate\Support\Facades\DB;
use App\Models\LogModel;
use App\Jobs\KirimBroadcastEmail;

class BroadcastController extends Controller
{
    //
    public function index()
    {
        $side = 'broadcast';

        $konfig = konfig();

        $broadcast = Broadcast::orderBy('id', 'desc')->get();

        $gelombang = Gelombang::where('id_tahun',$konfig['id_thn_ppdb'])->orderBy('id', 'desc')->get();

        return view('pendaftaran.broadcast.index', compact(
            'side',
            'broadcast',
            'gelombang'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | DATA
    |--------------------------------------------------------------------------
    */

    public function data()
    {
        $data = Broadcast::latest('id')
            ->get()
            ->map(function ($item) {

                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'pesan' => $item->pesan,
                    'iduser' => $item->iduser,
                    'tgl_update' => optional($item->tgl_update)
                        ->format('d-m-Y H:i'),
                ];
            });

        return response()->json($data);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'judul' => 'required',

            'pesan' => 'required',

        ]);

        $broadcast = Broadcast::create([

            'judul' => $request->judul,

            'pesan' => $request->pesan,

            'iduser' => auth()->id(),

        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_broadcast',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($broadcast),
            'serial' => url('simpan')
        ]);

        return response()->json([

            'success' => true,

            'message' => 'Broadcast berhasil ditambahkan'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([

            'judul' => 'required',

            'pesan' => 'required',

        ]);

        $broadcast = Broadcast::findOrFail($id);

        $broadcast->update([

            'judul' => $request->judul,

            'pesan' => $request->pesan,

            'iduser' => auth()->id(),

        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_broadcast',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($broadcast),
            'serial' => url('ubah/' . $id)
        ]);

        return response()->json([

            'success' => true,

            'message' => 'Broadcast berhasil diupdate'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $broadcast = Broadcast::findOrFail($id);

        $broadcast->delete();

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_broadcast',
            'aksi' => 'delete',
            'user' => auth()->user()->id,
            'ip' => request()->ip(),
            'keterangan' => json_encode($broadcast),
            'serial' => url('hapus/' . $id)
        ]);

        return response()->json([

            'success' => true,

            'message' => 'Broadcast berhasil dihapus'

        ]);
    }

    public function kirimSemua(Request $request)
    {
        $request->validate([
            'id_broadcast' => ['required'],
            'id_gelombang' => ['required'],
        ]);

        $konfig = konfig();

        $broadcast = DB::table('tb_broadcast')
            ->where('id', $request->id_broadcast)
            ->first();

        if (!$broadcast) {
            return response()->json([
                'success' => false,
                'message' => 'Broadcast tidak ditemukan',
            ], 404);
        }

        $queryPenerima = DB::table('tb_tmp_siswa')
            ->where('id_thn_ajaran', $konfig['id_thn_ppdb'])
            ->whereNotNull('email')
            ->where('email', '!=', '');

        /*
    |--------------------------------------------------------------------------
    | Filter gelombang
    |--------------------------------------------------------------------------
    | Jika nilainya bukan "all", kirim hanya ke gelombang yang dipilih.
    */
        if ($request->id_gelombang !== 'all') {
            $queryPenerima->where(
                'id_gelombang',
                $request->id_gelombang
            );
        }

        $jumlahPenerima = (clone $queryPenerima)->count();

        if ($jumlahPenerima === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada calon siswa dengan email yang valid.',
                'jumlah_penerima' => 0,
            ], 422);
        }

        $delayDetik = 5;
        $urutan = 0;

        $queryPenerima
            ->select([
                'id',
                'nama_lengkap',
                'email',
            ])
            ->orderBy('id')
            ->chunkById(
                100,
                function ($siswa) use (
                    &$urutan,
                    $delayDetik,
                    $broadcast
                ) {
                    foreach ($siswa as $item) {
                        KirimBroadcastEmail::dispatch(
                            email: $item->email,
                            nama: $item->nama_lengkap ?? 'Siswa',
                            judul: $broadcast->judul,
                            isi: $broadcast->pesan
                        )->delay(
                            now()->addSeconds(
                                $urutan * $delayDetik
                            )
                        );

                        $urutan++;
                    }
                },
                'id'
            );

        $target = $request->id_gelombang === 'all'
            ? 'semua gelombang'
            : 'gelombang yang dipilih';


            DB::table('tb_broadcast_kirim')->insertGetId([
                'id_broadcast'  => $broadcast->id,
                'id_gelombang'  => $request->id_gelombang,
                'id_thn_ajaran' => $konfig['id_thn_ppdb'],
                'tanggal_kirim' => now(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => "Broadcast email untuk {$target} berhasil dimasukkan ke antrean.",
            'jumlah_penerima' => $jumlahPenerima,
        ]);
    }
}
