<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PengumumanCalonController extends Controller
{
    public function index(): View
    {
        $side = 'pengumumanCalon';

        $calonSiswa = DB::table('tb_tmp_siswa')
            ->where('id_user', auth()->id())
            ->first();

        abort_if(
            !$calonSiswa,
            404,
            'Data calon siswa tidak ditemukan.'
        );

        $pengumuman = DB::table('tb_broadcast_kirim as bk')
            ->join(
                'tb_broadcast as b',
                'b.id',
                '=',
                'bk.id_broadcast'
            )
            ->where(
                'bk.id_thn_ajaran',
                $calonSiswa->id_thn_ajaran
            )
            ->where(function ($query) use ($calonSiswa) {
                $query
                    ->whereNull('bk.id_gelombang')
                    ->orWhere(
                        'bk.id_gelombang',
                        $calonSiswa->id_gelombang
                    );
            })
            ->select([
                'bk.id',
                'bk.tanggal_kirim',
                'bk.id_gelombang',
                'b.judul',
                'b.pesan',
            ])
            ->orderByDesc('bk.tanggal_kirim')
            ->paginate(10);

        return view(
            'pendaftaran.calon_siswa.pengumuman-calon',
            compact('side', 'pengumuman')
        );
    }

    public function show($id): View
    {
        $side = 'pengumuman';

        $calonSiswa = DB::table('tb_tmp_siswa')
            ->where('id_user', auth()->id())
            ->first();

        abort_if(
            !$calonSiswa,
            404,
            'Data calon siswa tidak ditemukan.'
        );

        $pengumuman = DB::table('tb_broadcast_kirim as bk')
            ->join(
                'tb_broadcast as b',
                'b.id',
                '=',
                'bk.id_broadcast'
            )
            ->where('bk.id', $id)
            ->where(
                'bk.id_thn_ajaran',
                $calonSiswa->id_thn_ajaran
            )
            ->where(function ($query) use ($calonSiswa) {
                $query
                    ->whereNull('bk.id_gelombang')
                    ->orWhere(
                        'bk.id_gelombang',
                        $calonSiswa->id_gelombang
                    );
            })
            ->select([
                'bk.id',
                'bk.tanggal_kirim',
                'b.judul',
                'b.pesan',
                'bk.id_gelombang'
            ])
            ->first();

        abort_if(
            !$pengumuman,
            404,
            'Pengumuman tidak ditemukan atau bukan untuk gelombang Anda.'
        );

        return view(
            'pendaftaran.calon_siswa.detail-pengumuman',
            compact('side', 'pengumuman')
        );
    }
}
