<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hari extends Model
{
    protected $table = 'tb_hari';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_hari',
        'urutan',
        'status',
    ];

    protected $casts = [
        'urutan' => 'integer',
        'status' => 'boolean',
    ];

    public function penjadwalanHari(): HasMany
    {
        return $this->hasMany(
            PenjadwalanHari::class,
            'id_hari',
            'id'
        );
    }
}