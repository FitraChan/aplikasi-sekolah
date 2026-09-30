<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpaymuDetBayar extends Model
{
    protected $table = 'tb_ipaymu_det_bayar';

    public $timestamps = false;

    protected $fillable = [
        'id_bayar',
        'nama_item',
        'jml_bayar',
        'id_cicilan',
        'keterangan',
        'sisa_bayar',
        'kwajiban_bayar',
        'potongan',
        'id_tmp_bayar',
        'id_user',
    ];

    public function bayar()
    {
        return $this->belongsTo(
            IpaymuBayar::class,
            'id_bayar',
            'id'
        );
    }
}