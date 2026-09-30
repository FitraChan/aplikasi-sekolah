<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KatItemBayar extends Model
{
    protected $table = 'tb_kat_itembayar';

    protected $fillable = [
        'nama_kategori'
    ];

 //   public $timestamps = false;
}