<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'tb_bank';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_bank',
    ];
}