<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamPelajaran extends Model
{
    protected $table = 'tb_jam_pelajaran';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'jam_ke',
        'jam_awal',
        'jam_akhir',
        'jam_awal_2',
        'jam_akhir_2',
    ];

    public function penjadwalanHari()
    {
        return $this->hasMany(
            PenjadwalanHari::class,
            'id_jam',
            'id'
        );
    }
}