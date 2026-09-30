<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPengumuman extends Model
{
    protected $table = 'tb_kategori_pengumuman';

    protected $fillable = [
        'nama',
        'slug',
        'icon',
        'warna',
        'is_active',
    ];
}