<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    use HasFactory;

    protected $table = 'tb_log';

    protected $fillable =[
        'tanggal',
        'tabel',
        'aksi',
        'user',
        'ip',
        'keterangan',
        'serial',
    ];
}