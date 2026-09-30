<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soal extends Model
{
    //
    use SoftDeletes;

    protected $table = 'master_soals';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'judul_soal',
        'soal',
        'jenis_soal_id',
        'mapel_id',
        'smt',
        'jawaban_a',
        'jawaban_b',
        'jawaban_c',
        'jawaban_d',
        'jawaban_e',
        'jawaban_benar',
        'url_soal',
        'lecture_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function jenisSoal()
    {
        return $this->belongsTo(JenisSoal::class, 'jenis_soal_id');
    }
}
