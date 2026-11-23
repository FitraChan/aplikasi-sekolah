<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use SoftDeletes;
    protected $table = 'tb_mapel';



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