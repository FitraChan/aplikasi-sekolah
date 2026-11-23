<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusTransaksi extends Model
{
    use HasFactory;

    protected $table = 'tb_status_transaksi';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
    ];
}