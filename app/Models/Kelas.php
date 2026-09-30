<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Kelas extends Model
{
    protected $table = 'tb_kelas';

    protected $primaryKey = 'id';

   // public $timestamps = false;

    protected $fillable = [
        'nama_kelas',
        'id_jurusan',
        'kelas',
        'alias',
        'idx',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function calonSiswas()
    {
        return $this->hasMany(CalonSiswa::class, 'id_kelas');
    }

    public static function getJumlahSiswa()
    {
        return static::query()
            ->from('tb_kelas')
            ->leftJoin('tb_tmp_siswa', 'tb_kelas.idx', '=', 'tb_tmp_siswa.id_kelas')
            ->leftJoin('tb_jurusan', 'tb_kelas.id_jurusan', '=', 'tb_jurusan.id')
            ->selectRaw(
                 'MAX(tb_kelas.id) as id, '
                . 'tb_kelas.idx, '
                . 'MAX(tb_kelas.nama_kelas) as nama_kelas, '
                . 'MAX(tb_jurusan.nama_jurusan) as nama_jurusan, '
                . 'COUNT(tb_tmp_siswa.no_daftar) as jml_siswa'
            )
            ->groupBy('tb_kelas.idx')
            ->reorder('id');
    }
}
