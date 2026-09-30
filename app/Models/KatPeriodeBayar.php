<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KatPeriodeBayar extends Model
{
    protected $table = 'tb_kat_periodebayar';

    protected $fillable = [
        'nama_kategori'
    ];

   // public $timestamps = false;
}