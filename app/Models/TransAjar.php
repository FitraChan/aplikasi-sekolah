<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; // <-- 1. Pastikan ini ada

class TransAjar extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'tb_trans_ajar';

    protected $primaryKey = 'id';

    protected $fillable = [
        'idjadwal',
        'idpertemuan',
        'tgl',
        'judul_materi',
        'judul_tugas',
        'materi',
        'tugas',
        'guru_pengganti',
        'keterangan',
        'url_materi_1',
        'url_materi_2',
        'url_materi_3',
        'url_tugas',
        'url_video',
        'is_youtube',
        'tgl_batas_submit',
        'jml_h',
        'jml_s',
        'jml_i',
        'jml_a',
    ];

    protected $casts = [
        'tgl' => 'datetime',
        'tgl_batas_submit' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'idtransajar');
    }

    public function jadwal()
    {
        return $this->belongsTo(MasterJadwal::class, 'idjadwal');
    }

 
    public function guruPengganti()
    {
        return $this->belongsTo(Gtk::class, 'guru_pengganti');
    }

    public function hadir()
    {
        return $this->hasMany(Absensi::class, 'idtransajar')
            ->where('sts_hadir', 'H');
    }

    public function sakit()
    {
        return $this->hasMany(Absensi::class, 'idtransajar')
            ->where('sts_hadir', 'S');
    }

    public function izin()
    {
        return $this->hasMany(Absensi::class, 'idtransajar')
            ->where('sts_hadir', 'I');
    }

    public function alfa()
    {
        return $this->hasMany(Absensi::class, 'idtransajar')
            ->where('sts_hadir', 'A');
    }
}