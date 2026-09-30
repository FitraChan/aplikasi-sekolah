<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpaymuBayar extends Model
{
    protected $table = 'tb_ipaymu_bayar';

    protected $fillable = [
        'id_calon_siswa',
        'id_tahun',
        'id_bulan',
        'tgl_bayar',
        'id_kasir',
        'via',
        'sts_bayar',
        'no_kwitansi',
        'keterangan',
    ];

    public function detailBayar()
    {
        return $this->hasMany(
            IpaymuDetBayar::class,
            'id_bayar',
            'id'
        );
    }

    public function calonSiswa()
    {
        return $this->belongsTo(
            CalonSiswa::class,
            'id_calon_siswa',
            'id'
        );
    }
}