<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriMapel extends Model
{
    protected $table = 'tb_kategori_mapel';

   // public $timestamps = false;

    protected $fillable = [
        'nama_kategori_mapel',
        'subid',
        'no_kat',
    ];

    public function mapel()
    {
        return $this->hasMany(
            Mapel::class,
            'id_kategori_mapel',
            'id'
        );
    }
}