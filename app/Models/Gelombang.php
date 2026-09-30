<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gelombang extends Model
{
    protected $table = 'tb_gelombang';

    protected $primaryKey = 'id';

 //   public $timestamps = false;

    protected $fillable = [
        'id_tahun',
        'nama_gelombang',
        'awal',
        'akhir',
        'is_current',
        'idx',
    ];

    protected $casts = [
        'awal' => 'date',
        'akhir' => 'date',
    ];

    public function calonSiswas()
    {
        return $this->hasMany(CalonSiswa::class, 'id_gelombang');
    }

    public function ujianCalon(): HasMany
    {
        return $this->hasMany(UjianCalon::class, 'id_gelombang', 'id');
    }
}