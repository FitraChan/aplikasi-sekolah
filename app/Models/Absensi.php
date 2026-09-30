<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; // <-- 1. Pastikan ini ada


class Absensi extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'tb_hadir_siswa';

    protected $primaryKey = 'id';

   // public $timestamps = false;

    protected $fillable = [
        'idtransajar',
        'nipd',
        'sts_hadir',
        'ket_hadir',
    ];

    protected $attributes = [
        'sts_hadir' => 'H',
    ];

    public function transAjar()
    {
        return $this->belongsTo(TransAjar::class, 'idtransajar');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nipd', 'nipd');
    }
}