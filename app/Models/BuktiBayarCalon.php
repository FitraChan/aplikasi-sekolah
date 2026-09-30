<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuktiBayarCalon extends Model
{
   
    protected $table = 'tb_bukti_bayar_calon';

    protected $fillable = [
        'id_calon_siswa',
        'bukti_transfer',
        'status'
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(
            CalonSiswa::class,
            'id_calon_siswa',
            'id'
        );
    }
}