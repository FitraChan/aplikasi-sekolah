<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusDaftar extends Model
{
    protected $table = 'tb_sts_daftar';

    protected $primaryKey = 'id';

   // public $timestamps = false;

    protected $fillable = [
        'keterangan',
    ];

    public function calonSiswas()
    {
        return $this->hasMany(CalonSiswa::class, 'status_daftar');
    }
}