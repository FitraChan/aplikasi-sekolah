<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KatItemBayar extends Model
{
    use SoftDeletes;

    protected $table = 'tb_kat_itembayar';

    protected $fillable = [
        'nama_kategori'
    ];

    // protected $primaryKey = 'id';
    // public $timestamps = false;
}