<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gtk extends Model
{
    protected $table = 'tb_gtk';

   // public $timestamps = false;

    protected $fillable = [
        'nama_gtk',
        'nik',
        'tmp_lahir',
        'tgl_lahir',
        'nama_ibu',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'desa',
        'kecamatan',
        'lintang',
        'bujur',
        'kodepos',
        'idagama',
        'npwp',
        'nama_wp',
        'iswni',
        'wna',
        'idkawin',
        'nama_pasangan',
        'nip_pasangan',
        'idkerja_pasangan',
        'idkepegawaian',
        'nip',
        'niy',
        'nuptk',
        'idptk',
        'sk_pengangkatan',
        'tmt_pengankatan',
        'idlembaga_pengankat',
        'sk_cpns',
        'tmt_cpns',
        'tmt_pns',
        'pangkat',
        'idsumber_gaji',
        'kartu_pegawai',
        'kartu_pasangan',
        'is_lisensi_kepsek',
        'idkeahlian_lab',
        'idkemampuan_khusus',
        'is_braile',
        'is_bhs_isyarat',
        'no_telp_rumah',
        'no_hp',
        'email',
        'idbank',
        'no_rek',
        'nama_rek',
        'no_surat_tugas',
        'tgl_surat_tugas',
        'tmt_tugas',
        'issekolah_induk',
        'alasan_keluar',
        'tgl_keluar',
        'akun_ptk',
        'pass_ptk',
        'jk',
        'nama_wajib_pajak',
        'status_kawin',
        'kewarganegaraan',
        'idpetugas',
        'no_guru',
        'nipd',
        'foto',
        'password',
        'password2',
        'role',
        'user_id'
    ];

    /**
     * Relasi jadwal mengajar
     */
    public function jadwal()
    {
        return $this->hasMany(
            MasterJadwal::class,
            'id_gtk',
            'id'
        );
    }
}