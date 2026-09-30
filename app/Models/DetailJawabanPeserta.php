<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailJawabanPeserta extends Model
{
    protected $table = 'detail_jawaban_pesertas';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'jawaban_peserta_id',
        'detail_quiz_id',
        'jawaban',
        'jawaban_benar',
        'skor',
    ];

    /**
     * Relasi ke jawaban peserta
     */
    public function jawabanPeserta()
    {
        return $this->belongsTo(JawabanPeserta::class, 'jawaban_peserta_id');
    }

    /**
     * Relasi ke detail quiz
     */
    public function detailQuiz()
    {
        return $this->belongsTo(DetailQuiz::class, 'detail_quiz_id');
    }
}