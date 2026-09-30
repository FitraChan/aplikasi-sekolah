<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmpTinggal extends Model
{
    protected $table = 'tb_tmp_tinggal';

    protected $primaryKey = 'id';

  //  public $timestamps = false;

    protected $fillable = [
        'nama_tmp_tinggal',
    ];

    public function calonSiswas()
    {
        return $this->hasMany(CalonSiswa::class, 'id_tinggal');
    }
}