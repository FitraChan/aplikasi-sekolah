<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailQuiz extends Model
{
    protected $table = 'detail_quizs';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'quiz_id',
        'soal_id',
        'no_urut',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }
}