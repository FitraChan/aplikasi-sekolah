<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemBayar extends Model
{
    protected $table = 'tb_itembayar';

    protected $fillable = [
        'nama_item',
        'id_kategori',
        'id_kat_periode',
        'keterangan',
        'def_value'
    ];

   // public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(
            KatItemBayar::class,
            'id_kategori'
        );
    }

    public function periode()
    {
        return $this->belongsTo(
            KatPeriodeBayar::class,
            'id_kat_periode'
        );
    }
}