<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSoal extends Model
{
    protected $table = 'jenis_soals';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'jenis_soal',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
