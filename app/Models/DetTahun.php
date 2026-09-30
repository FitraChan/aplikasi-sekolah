<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetTahun extends Model
{
    use HasFactory;

    protected $table = 'tb_det_tahun';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id_thn_ajaran',
        'id_jurusan',
        'target',
        'pencapaian',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(
            TahunAjaran::class,
            'id_thn_ajaran',
            'id'
        );
    }

    public function jurusan()
    {
        return $this->belongsTo(
            Jurusan::class,
            'id_jurusan',
            'id'
        );
    }

    public function calonSiswa()
    {
        return $this->hasMany(
            CalonSiswa::class,
            'id_thn_ajaran',
            'id_thn_ajaran'
        );
    }
}