<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'tb_pengumuman';

    protected $fillable = [
        'kategori_id',
        'judul',
        'isi',
        'prioritas',
        'status',
        'publish_at',
        'expired_at',
        'is_pinned',
        'lampiran',
        'created_by',
    ];

    public function kategori()
    {
        return $this->belongsTo(
            KategoriPengumuman::class,
            'kategori_id'
        );
    }
    public function target()
    {
        return $this->hasOne(
            TargetPengumuman::class,
            'pengumuman_id'
        );
    }
}