<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TahunAjaran extends Model
{

    use SoftDeletes;

    protected $table = 'tb_thn_ajaran';

    protected $primaryKey = 'id';

   // public $timestamps = false;

    protected $fillable = [
        'thn_ajaran',
        'isaktiv',
    ];

    public function calonSiswas()
    {
        return $this->hasMany(CalonSiswa::class, 'id_thn_ajaran');
    }

    public function gelombangs()
    {
        return $this->hasMany(Gelombang::class, 'id_tahun');
    }
}