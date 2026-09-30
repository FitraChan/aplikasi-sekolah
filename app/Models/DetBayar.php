<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class DetBayar extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'tb_det_bayar';

    protected $primaryKey = 'id';

    //public $timestamps = false;

    protected $fillable = [
        'id_bayar',
        'id_item',
        'jml_bayar',
        'id_cicilan',
        'keterangan',
        'sisa_bayar',
        'kwajiban_bayar',
        'potongan',
        'id_tmp_bayar',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function bayar()
    {
        return $this->belongsTo(
            Bayar::class,
            'id_bayar',
            'id'
        );
    }

    public function itemBayar()
    {
        return $this->belongsTo(
            ItemBayar::class,
            'id_item',
            'id'
        );
    }

   
}