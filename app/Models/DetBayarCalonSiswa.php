<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetBayarCalonSiswa extends Model
{
    use SoftDeletes;

    protected $table = 'tb_det_bayar_regis';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_bayar',
        'id_item',
        'jml_bayar',
        'id_cicilan',
        'keterangan',
        'sisa_bayar',
        'kwajiban_bayar',
        'potongan',
        'id_bayar2',
    ];

    /**
     * Header pembayaran registrasi
     */
    public function bayarCalonSiswa()
    {
        return $this->belongsTo(
            BayarCalonSiswa::class,
            'id_bayar'
        );
    }

    /**
     * Item pembayaran
     */
    public function itemBayar()
    {
        return $this->belongsTo(
            ItemBayar::class,
            'id_item'
        );
    }

    /**
     * Referensi pembayaran siswa (jika digunakan)
     */
    // public function bayar()
    // {
    //     return $this->belongsTo(
    //         Bayar::class,
    //         'id_bayar2'
    //     );
    // }
}