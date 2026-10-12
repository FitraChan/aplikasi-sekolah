<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilWawancara extends Model
{
    protected $table = 'tb_hasil_wawancara';

    protected $fillable = [
        'id_calon_siswa',
        'id_gtk',
        'id_jadwal_wawancara',

        'nilai_organisasi',
        'nilai_prestasi',

        'penyakit_kronis',
        'nilai_penyakit',
        'riwayat_penyakit',

        'buta_warna',
        'nilai_buta_warna',

        'pekerjaan_ayah',
        'pekerjaan_ibu',

        'nilai_attitude',
        'nilai_wawasan',
        'nilai_kemampuan',

        'hobi',
        'pengalaman_kerja',

        'nilai_akhir',

        'status_lulus',
        'id_jurusan_rekomendasi',

        'catatan',

        'tanggal_wawancara',
        'jam_wawancara',

        'status',
    ];

    protected $casts = [
        'nilai_organisasi' => 'float',
        'nilai_prestasi' => 'float',
        'nilai_penyakit' => 'float',
        'nilai_buta_warna' => 'float',
        'nilai_attitude' => 'float',
        'nilai_wawasan' => 'float',
        'nilai_kemampuan' => 'float',
        'nilai_akhir' => 'float',

        'tanggal_wawancara' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function calonSiswa()
    {
        return $this->belongsTo(
            CalonSiswa::class,
            'id_calon_siswa'
        );
    }

    public function gtk()
    {
        return $this->belongsTo(
            Gtk::class,
            'id_gtk'
        );
    }

    public function jadwalWawancara()
    {
        return $this->belongsTo(
            JadwalWawancara::class,
            'id_jadwal_wawancara'
        );
    }

    public function jurusan()
    {
        return $this->belongsTo(
            Jurusan::class,
            'id_jurusan_rekomendasi'
        );
    }
}