<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $table = 'tb_broadcast';

    protected $primaryKey = 'id';

    //public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'tgl_update' => 'datetime',
    ];
}