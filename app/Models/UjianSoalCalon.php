<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UjianSoalCalon extends Model
{
    protected $table = 'tb_ujian_soal_calon';

    protected $fillable = [
        'id_ujian',
        'pertanyaan',
        'gambar',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'jawaban_benar',
        'bobot',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'bobot' => 'decimal:2',
    ];

    // public function ujian(): BelongsTo
    // {
    //     return $this->belongsTo(UjianCalon::class, 'id_ujian');
    // }

    public function ujian()
    {
        return $this->belongsTo(
            UjianCalon::class,
            'id_ujian',
            'id'
        );
    }
}