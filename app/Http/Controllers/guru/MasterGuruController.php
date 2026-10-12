<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Gtk;
use App\Models\Agama;

use App\Models\LogModel;
use Illuminate\Http\Request;

class MasterGuruController extends Controller
{
    public function index()
    {
        return view('guru.master.index', [
            'side' => 'master-guru'
        ]);
    }

    public function data()
    {
        $data = Gtk::orderBy('nama_gtk', 'asc')
            ->orderBy('nama_gtk', 'asc')
            ->get()
            ->map(function ($item) {

                return [
                    'id' => $item->id,

                    'nama_gtk' => $item->nama_gtk,

                    'nik' => $item->nik,

                    'tmp_lahir' => $item->tmp_lahir,

                    'tgl_lahir' => $item->tgl_lahir,

                    'jk' => $item->jk,

                    'nip' => $item->nip,

                    'niy' => $item->niy,

                    'nuptk' => $item->nuptk,

                    'no_hp' => $item->no_hp,

                    'email' => $item->email,

                    'alamat' => $item->alamat,

                    'idkepegawaian' => $item->idkepegawaian,

                    'idptk' => $item->idptk,

                    'is_sekolah_induk' => $item->issekolah_induk,

                    'foto' => $item->foto,

                    'role' => $item->role,

                    'user_id' => $item->user_id,
                ];
            });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $gtk = Gtk::create([
            'nama_gtk' => $request->nama_gtk,
            'nik' => $request->nik,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'nama_ibu' => $request->nama_ibu,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'dusun' => $request->dusun,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'lintang' => $request->lintang,
            'bujur' => $request->bujur,
            'kodepos' => $request->kodepos,
            'idagama' => $request->idagama,
            'npwp' => $request->npwp,
            'nama_wp' => $request->nama_wp,
            'iswni' => $request->iswni,
            'wna' => $request->wna,
            'idkawin' => $request->idkawin,
            'nama_pasangan' => $request->nama_pasangan,
            'nip_pasangan' => $request->nip_pasangan,
            'idkerja_pasangan' => $request->idkerja_pasangan,
            'idkepegawaian' => $request->idkepegawaian,
            'nip' => $request->nip,
            'niy' => $request->niy,
            'nuptk' => $request->nuptk,
            'idptk' => $request->idptk,
            'sk_pengangkatan' => $request->sk_pengangkatan,
            'tmt_pengankatan' => $request->tmt_pengankatan,
            'idlembaga_pengankat' => $request->idlembaga_pengankat,
            'sk_cpns' => $request->sk_cpns,
            'tmt_cpns' => $request->tmt_cpns,
            'tmt_pns' => $request->tmt_pns,
            'pangkat' => $request->pangkat,
            'idsumber_gaji' => $request->idsumber_gaji,
            'kartu_pegawai' => $request->kartu_pegawai,
            'kartu_pasangan' => $request->kartu_pasangan,
            'is_lisensi_kepsek' => $request->is_lisensi_kepsek,
            'idkeahlian_lab' => $request->idkeahlian_lab,
            'idkemampuan_khusus' => $request->idkemampuan_khusus,
            'is_braile' => $request->is_braile,
            'is_bhs_isyarat' => $request->is_bhs_isyarat,
            'no_telp_rumah' => $request->no_telp_rumah,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'idbank' => $request->idbank,
            'no_rek' => $request->no_rek,
            'nama_rek' => $request->nama_rek,
            'no_surat_tugas' => $request->no_surat_tugas,
            'tgl_surat_tugas' => $request->tgl_surat_tugas,
            'tmt_tugas' => $request->tmt_tugas,
            'issekolah_induk' => $request->issekolah_induk,
            'alasan_keluar' => $request->alasan_keluar,
            'tgl_keluar' => $request->tgl_keluar,
            'akun_ptk' => $request->akun_ptk,
            'pass_ptk' => $request->pass_ptk,
            'jk' => $request->jk,
            'nama_wajib_pajak' => $request->nama_wajib_pajak,
            'status_kawin' => $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'idpetugas' => $request->idpetugas,
            'no_guru' => $request->no_guru,
            'nipd' => $request->nipd,
            'foto' => $request->foto,
            'password' => $request->password,
            'password2' => $request->password2,
            'role' => $request->role,
            'user_id' => $request->user_id,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_gtk',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($gtk),
            'serial' => url('simpan')
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        $gtk = Gtk::findOrFail($id);

        $gtk->update([
            'nama_gtk' => $request->nama_gtk,
            'nik' => $request->nik,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'nama_ibu' => $request->nama_ibu,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'dusun' => $request->dusun,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'lintang' => $request->lintang,
            'bujur' => $request->bujur,
            'kodepos' => $request->kodepos,
            'idagama' => $request->idagama,
            'npwp' => $request->npwp,
            'nama_wp' => $request->nama_wp,
            'iswni' => $request->iswni,
            'wna' => $request->wna,
            'idkawin' => $request->idkawin,
            'nama_pasangan' => $request->nama_pasangan,
            'nip_pasangan' => $request->nip_pasangan,
            'idkerja_pasangan' => $request->idkerja_pasangan,
            'idkepegawaian' => $request->idkepegawaian,
            'nip' => $request->nip,
            'niy' => $request->niy,
            'nuptk' => $request->nuptk,
            'idptk' => $request->idptk,
            'sk_pengangkatan' => $request->sk_pengangkatan,
            'tmt_pengankatan' => $request->tmt_pengankatan,
            'idlembaga_pengankat' => $request->idlembaga_pengankat,
            'sk_cpns' => $request->sk_cpns,
            'tmt_cpns' => $request->tmt_cpns,
            'pangkat' => $request->pangkat,
            'idsumber_gaji' => $request->idsumber_gaji,
            'kartu_pegawai' => $request->kartu_pegawai,
            'kartu_pasangan' => $request->kartu_pasangan,
            'is_lisensi_kepsek' => $request->is_lisensi_kepsek,
            'idkeahlian_lab' => $request->idkeahlian_lab,
            'idkemampuan_khusus' => $request->idkemampuan_khusus,
            'is_braile' => $request->is_braile,
            'is_bhs_isyarat' => $request->is_bhs_isyarat,
            'no_telp_rumah' => $request->no_telp_rumah,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'idbank' => $request->idbank,
            'no_rek' => $request->no_rek,
            'nama_rek' => $request->nama_rek,
            'no_surat_tugas' => $request->no_surat_tugas,
            'tgl_surat_tugas' => $request->tgl_surat_tugas,
            'tmt_tugas' => $request->tmt_tugas,
            'issekolah_induk' => $request->issekolah_induk,
            'alasan_keluar' => $request->alasan_keluar,
            'tgl_keluar' => $request->tgl_keluar,
            'akun_ptk' => $request->akun_ptk,
            'pass_ptk' => $request->pass_ptk,
            'jk' => $request->jk,
            'nama_wajib_pajak' => $request->nama_wajib_pajak,
            'status_kawin' => $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'idpetugas' => $request->idpetugas,
            'no_guru' => $request->no_guru,
            'nipd' => $request->nipd,
            'foto' => $request->foto,
            'password' => $request->password,
            'password2' => $request->password2,
            'role' => $request->role,
            'user_id' => $request->user_id,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_gtk',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($gtk),
            'serial' => url('ubah/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $gtk = Gtk::findOrFail($id);

        $gtk->delete();

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_gtk',
            'aksi' => 'delete',
            'user' => auth()->user()->id,
            'ip' => request()->ip(),
            'keterangan' => json_encode($gtk),
            'serial' => url('hapus/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    
    public function profile()
    {

   /// $user = ;
        $gtk = Gtk::where('user_id', auth()->user()->id)->first();

        $agama = Agama::orderBy('nama_agama')->get();

        return view('guru.master.profile', [
            'side' => 'master-guru-profile',
            'gtk'  => $gtk,
            'agama' => $agama,
        ]);
    }


}
