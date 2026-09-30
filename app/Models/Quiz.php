<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizs';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'judul',
        'deskripsi',
        'master_kelas_id',
        'tgl_quiz',
        'durasi',
        'tgl_mulai',
        'tgl_selesai',
        'created_by',
    ];

    protected $dates = [
        'tgl_quiz',
        'tgl_mulai',
        'tgl_selesai',
        'created_at',
        'updated_at',
    ];

    public function masterJadwal()
    {
        return $this->belongsTo(MasterJadwal::class, 'master_kelas_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function detailSoal()
    {
        return $this->hasMany(DetailQuiz::class, 'quiz_id');
    }

     public function jawabanPeserta()
    {
        return $this->hasMany(JawabanPeserta::class, 'quiz_id');
    }
}