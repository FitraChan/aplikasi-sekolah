<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StsSiswa extends Model
{
    protected $table = 'tb_sts_siswa';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'status_siswa',
    ];
}