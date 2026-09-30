<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetTransAjar extends Model
{
    protected $table = 'tb_det_trans_ajar';

    public $timestamps = false;

    protected $fillable = [
        'idtransajar',
        'nipd',
        'sts_hadir',
        'ket_hadir',
        'jawaban_tugas',
        'url_jawaban_1',
        'url_jawaban_2',
        'tgl_submit',
        'skor',
    ];

    protected $casts = [
        'tgl_submit' => 'datetime',
        'skor'       => 'integer',
    ];

    /**
     * Relasi ke transaksi ajar.
     */
    public function transAjar(): BelongsTo
    {
        return $this->belongsTo(
            TransAjar::class,
            'idtransajar',
            'id'
        );
    }

    /**
     * Relasi ke siswa berdasarkan NIPD.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(
            Siswa::class,
            'nipd',
            'nipd'
        );
    }
}