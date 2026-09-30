<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateBayar extends Model
{
    protected $table = 'tb_template_bayar';

    protected $fillable = [
        'id_tahun',
        'id_jurusan',
        'keterangan',
        'jns_kelas',
        'id_gelombang',
        'sts'
    ];

   // public $timestamps = false;

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function tahunAjaran()
    {
        return $this->belongsTo(
            TahunAjaran::class,
            'id_tahun',
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

    public function gelombang()
    {
        return $this->belongsTo(
            Gelombang::class,
            'id_gelombang',
            'id'
        );
    }
}