<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'tb_jurusan';

    protected $primaryKey = 'id';

   // public $timestamps = false;

    protected $fillable = [
        'nama_jurusan',
        'jumlah_siswa',
        'singkatan',
    ];

    public function calonSiswas()
    {
        return $this->hasMany(CalonSiswa::class, 'id_jurusan');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_jurusan');
    }
}