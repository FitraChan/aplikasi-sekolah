<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = 'tb_agama';

    protected $primaryKey = 'id';

   // public $timestamps = false;

    protected $fillable = [
        'nama_agama',
    ];

    public function calonSiswas()
    {
        return $this->hasMany(CalonSiswa::class, 'id_agama');
    }
}