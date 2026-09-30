<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'tb_mapel';

  //  public $timestamps = false;

    protected $fillable = [
        'nama_mapel',
        'id_jurusan',
        'id_kategori_mapel',
        'kurikulum',
        'smt1',
        'smt2',
        'smt3',
        'smt4',
        'smt5',
        'smt6',
        'ket',
    ];

    public function jurusan()
    {
        return $this->belongsTo(
            Jurusan::class,
            'id_jurusan',
            'id'
        );
    }

    public function kategoriMapel()
    {
        return $this->belongsTo(
            KategoriMapel::class,
            'id_kategori_mapel',
            'id'
        );
    }
}