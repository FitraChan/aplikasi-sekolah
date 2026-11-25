<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BayarCalonSiswa extends Model
{
     use SoftDeletes; // aktifkan jika ada deleted_at

    protected $table = 'tb_bayar_regis';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_tahun',
        'id_bulan',
        'no_kwitansi',
        'tgl_bayar',
        'jam_bayar',
        'id_kasir',
        'id_calon_siswa',
        'keterangan',
        'tot_bayar',
        'total_kwajiban',
        'no_daftar',
        'nipd',
        'bukti_bayar',
        'sts_trans', //1. menunggu konfirmasi; 2.Lunas; 3.belum lunas 
        'bank_pengirim',
        'bank_penerima'
    ];

    protected $casts = [
        'tgl_bayar' => 'date',
        'jam_bayar' => 'datetime:H:i:s',
    ];

    /**
     * Tahun Ajaran
     */
    public function tahunAjaran()
    {
        return $this->belongsTo(
            TahunAjaran::class,
            'id_tahun'
        );
    }

    /**
     * Bulan
     */
   

    /**
     * Kasir
     */
    public function kasir()
    {
        return $this->belongsTo(
            User::class,
            'id_kasir'
        );
    }

    /**
     * Calon Siswa
     */
    public function calonSiswa()
    {
        return $this->belongsTo(
            CalonSiswa::class,
            'id_calon_siswa',
            'no_daftar'
        );
    }

    /**
     * Siswa
     */
   

    /**
     * Detail pembayaran registrasi
     */
    public function detail()
    {
        return $this->hasMany(
            DetBayarCalonSiswa::class,
            'id_bayar'
        );
    }

    public static function updateBayar($id)
    {
        $total = DetBayarCalonSiswa::where('id_bayar', $id)->sum('jml_bayar');

        static::where('id', $id)
            ->update([
                'tot_bayar' => $total
            ]);
    }

    public static function updateKewajiban($id)
    {
        $total = DetBayarCalonSiswa::where('id_bayar', $id)
            ->selectRaw('COALESCE(SUM(kwajiban_bayar),0)-COALESCE(SUM(potongan),0) total')
            ->value('total');

        static::where('id', $id)
            ->update([
                'total_kwajiban' => $total
            ]);
    }

    public function bankPenerima()
    {
        return $this->belongsTo(
            Bank::class,
            'bank_penerima',
            'id'
        );
    }

    public function bankPengirim()
    {
        return $this->belongsTo(
            Bank::class,
            'bank_pengirim',
            'id'
        );
    }

    public function statusTransaksi()
    {
        return $this->belongsTo(
            StatusTransaksi::class,
            'sts_trans',
            'id'
        );
    }
}