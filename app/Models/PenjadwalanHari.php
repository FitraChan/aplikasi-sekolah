<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjadwalanHari extends Model
{
    protected $table = 'tb_penjadwalan_hari';

    protected $primaryKey = 'id';


    protected $fillable = [
        'idpenjadwalan',
        'id_hari',
        'id_jam',
    ];

    public function jadwal()
    {
        return $this->belongsTo(
            MasterJadwal::class,
            'idpenjadwalan',
            'id'
        );
    }

     public function hari(): BelongsTo
    {
        return $this->belongsTo(
            Hari::class,
            'id_hari',
            'id'
        );
    }

   

    public function jam()
    {
        return $this->belongsTo(
            JamPelajaran::class,
            'id_jam',
            'id'
        );
    }
}