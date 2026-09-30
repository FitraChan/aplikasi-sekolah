<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetPengumuman extends Model
{
    protected $table = 'tb_target_pengumuman';

    protected $fillable = [
        'pengumuman_id',
        'target_type',
        'target_id',
        'target_value',
    ];
}