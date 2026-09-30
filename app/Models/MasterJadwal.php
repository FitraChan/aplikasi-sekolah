<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class MasterJadwal extends Model
{
    protected $table = 'tb_master_jadwal';

    protected $fillable = [
        'id_tahun',
        'semester',
        'id_kelas',
        'id_mapel',
        'jml_jam',
        'id_gtk',
        'angkatan',
    ];

      protected $appends = ['nkelas'];

    protected function nkelas(): Attribute
    {
        return Attribute::make(
            get: function () {

                $selisih = $this->id_tahun - $this->angkatan;

                return match ($selisih) {
                    0 => 'X',
                    1 => 'XI',
                    default => 'XII',
                };
            }
        );
    }

    public function kelas()
    {
        return $this->belongsTo(
            Kelas::class,
            'id_kelas',
            'idx'
        );
    }

    public function mapel()
    {
        return $this->belongsTo(
            Mapel::class,
            'id_mapel',
            'id'
        );
    }

    public function guru()
    {
        return $this->belongsTo(
            Gtk::class,
            'id_gtk',
            'id'
        );
    }

    public function transAjar(){

    return $this->hasMany(
        TransAjar::class,
        'idjadwal', // foreign key di tb_trans_ajar
        'id'        // primary key di tb_master_jadwal
    );
    }

    public function tahun()
    {
        return $this->belongsTo(
            TahunAjaran::class,
            'id_tahun',
            'id'
        );
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'master_kelas_id');
    }

    public function penjadwalanHari()
    {
        return $this->hasMany(
            PenjadwalanHari::class,
            'idpenjadwalan',
            'id'
        );
    }

    
}