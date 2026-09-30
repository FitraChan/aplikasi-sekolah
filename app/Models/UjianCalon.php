<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UjianCalon extends Model
{
    protected $table = 'tb_ujian_calon';

    protected $fillable = [
        'nama_ujian',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi',
        'nilai_minimal',
        'acak_soal',
        'tampil_hasil',
        'status',
        'id_gelombang'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'acak_soal' => 'boolean',
        'tampil_hasil' => 'boolean',
        'status' => 'boolean',
        'nilai_minimal' => 'decimal:2',
    ];

    public function soal(): HasMany
    {
        return $this->hasMany(UjianSoalCalon::class, 'id_ujian');
    }

    public function peserta(): HasMany
    {
        return $this->hasMany(UjianPesertaCalon::class, 'id_ujian');
    }


    public function gelombang(): BelongsTo
    {
        return $this->belongsTo(Gelombang::class, 'id_gelombang', 'id');
    }
}