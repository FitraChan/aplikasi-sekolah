<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens; // <-- 1. Pastikan ini ada


class Siswa extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'tb_siswa';
    protected $primaryKey = 'id';
    protected $appends = ['jenis_kelas'];
    var $tahun, $smt;


      

    public function getJenisKelasAttribute()
    {
        return match ($this->jns_kelas) {
            1 => 'Reguler',
            2 => 'Laptop',
            default => '-'
        };
    }
    public $timestamps = true;

    protected $fillable = [
        'id_cawa',
        'no_daftar',
        'nipd',
        'no_registrasi_ulang',
        'no_kwitansi',
        'tmp_daftar',
        'id_petugas',
        'nama_lengkap',
        'nama_panggilan',
        'jk',
        'nisn',
        'nik',
        'tmp_lahir',
        'tgl_lahir',
        'id_agama',
        'alamat',
        'desa',
        'kecamatan',
        'kota',
        'provinsi',
        'no_hp',
        'email',
        'nama_ayah',
        'id_kerja_ayah',
        'alamat_ayah',
        'hp_ayah',
        'nama_ibu',
        'id_kerja_ibu',
        'alamat_ibu',
        'hp_ibu',
        'nama_wali',
        'id_kerja_wali',
        'alamat_wali',
        'hp_wali',
        'tgl_masuk',
        'id_jurusan',
        'nama_sekolah_asal',
        'tgl_registrasi',
        'id_template_bayar',
        'id_kelas',
        'kelas_id',
        'id_gelombang',
        'jns_kelas',
        'password',
        'remember_token',
        'image',
        'id_periode',
        'sts_siswa',
        'id_user',
        'id_thn_ajaran',
        'is_aktif',
        'foto_siswa',
        'kk',
        'akta_kelahiran',
        'ijazah',
        'raport',
        'ktp_ayah',
        'ktp_ibu',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'password2',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'tgl_masuk' => 'date',
        'tgl_registrasi' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class, 'id_gelombang');
    }

    public function templateBayar()
    {
        return $this->belongsTo(TemplateBayar::class, 'id_template_bayar');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_thn_ajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'idx');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jawabanPesertas()
    {
        return $this->hasMany(JawabanPeserta::class, 'peserta_id', 'nipd');
    }

     public function statusSiswa()
    {
        return $this->belongsTo(StsSiswa::class, 'sts_siswa', 'id');
    }
}
