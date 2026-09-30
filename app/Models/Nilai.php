<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'tb_nilai';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'idjadwal',
        'i_thn',
        'i_smt',
        'semester',
        'i_mapel',
        'mata_pelajaran',
        'i_gtk',
        'nipd',
        'p_1','s_1','k_1',
        'p_2','s_2','k_2',
        'p_3','s_3','k_3',
        'p_4','s_4','k_4',
        'p_5','s_5','k_5',
        'p_6','s_6','k_6',
        'p_7','s_7','k_7',
        'p_8','s_8','k_8',
        'p_9','s_9','k_9',
        'p_10','s_10','k_10',
        'p_11','s_11','k_11',
        'p_12','s_12','k_12',
        'p_13','s_13','k_13',
        'd_p',
        'd_k',
    ];

    public function jadwal()
    {
        return $this->belongsTo(
            MasterJadwal::class,
            'idjadwal',
            'id'
        );
    }

    public function siswa()
    {
        return $this->belongsTo(
            Siswa::class,
            'nipd',
            'nipd'
        );
    }

    public function guru()
    {
        return $this->belongsTo(
            Gtk::class,
            'i_gtk',
            'id'
        );
    }

    public function mapel()
    {
        return $this->belongsTo(
            Mapel::class,
            'i_mapel',
            'id'
        );
    }
}