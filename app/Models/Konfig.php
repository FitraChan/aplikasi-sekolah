<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Konfig extends Model
{
    protected $table = 'tb_konfig';

    protected $fillable = [
        'id_tahun',
        'id_gelombang',
        'smt',
        'id_thn_ppdb'
    ];

    public $timestamps = false;

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('konfig');
        });

        static::deleted(function () {
            Cache::forget('konfig');
        });
    }
}
