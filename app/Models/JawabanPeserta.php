<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JawabanPeserta extends Model
{
    use HasFactory;

    protected $table = 'jawaban_pesertas';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'peserta_id',
        'quiz_id',
        'tgl_mulai_quiz',
        'tgl_selesai_quiz',
        'total_skor',
        'jwb_salah',
        'jwb_benar',
    ];

    protected $casts = [
        'tgl_mulai_quiz'   => 'datetime',
        'tgl_selesai_quiz' => 'datetime',
        'total_skor'       => 'integer',
        'jwb_salah'        => 'integer',
        'jwb_benar'        => 'integer',
    ];

    /**
     * Relasi ke Quiz
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    /**
     * Relasi ke Siswa
     * peserta_id mengacu ke tb_siswa.nipd
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'peserta_id', 'nipd');
    }
}