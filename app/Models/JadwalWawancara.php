<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalWawancara extends Model
{
    protected $table = 'jadwal_wawancara';

    protected $fillable = [
        'id_calon_siswa',
        'id_gtk',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'tempat',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(
            CalonSiswa::class,
            'id_calon_siswa',
            'id'
        );
    }

    public function gtk()
    {
        return $this->belongsTo(
            Gtk::class,
            'id_gtk',
            'id'
        );
    }
}