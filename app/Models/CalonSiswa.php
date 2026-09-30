<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\Kelas;
use App\Models\Agama;
use App\Models\TahunAjaran;
use App\Models\TmpTinggal;
use App\Models\StatusDaftar;

class CalonSiswa extends Model
{
    protected $table = 'tb_tmp_siswa';

    protected $primaryKey = 'id';

   // public $timestamps = false;

    protected $guarded = [];

     protected $fillable = [
       
     'nipd', 'id_cawa', 'no_daftar', 'no_urut', 'no_registrasi_ulang', 'no_kwitansi', 'tmp_daftar', 'id_petugas', 'nama_lengkap', 'nama_panggilan', 'jk', 'nisn', 'nik', 'tmp_lahir', 'tgl_lahir', 'no_akta_lahir', 'id_agama', 'kewarganegaraan', 'alamat', 'dusun', 'rt', 'rw', 'desa', 'kecamatan', 'kode_pos', 'kota', 'provinsi', 'berat', 'tinggi', 'no_telp', 'no_hp', 'email', 'username', 'bujur', 'lintang', 'id_kebutuhan_khusus', 'id_tinggal', 'id_transport', 'no_kks', 'anak_ke', 'penerima_kks', 'terima_kps', 'layak_pip', 'alasan_layak_pip', 'no_kps', 'no_kip', 'nama_kip', 'bank', 'no_rekening', 'rekening_atas_nama', 'nama_ayah', 'terima_kartu_kip', 'nik_ayah', 'thn_lahir_ayah', 'id_kerja_ayah', 'id_penghasilan_ayah', 'hp_ayah', 'nama_ibu', 'nik_ibu', 'thn_lahir_ibu', 'id_kerja_ibu', 'id_penghasilan_ibu', 'hp_ibu', 'nama_wali', 'nik_wali', 'thn_lahir_wali', 'id_kerja_wali', 'id_penghasilan_wali', 'hp_wali', 'tinggi_badan', 'berat_badan', 'jarak', 'waktu_tempuh', 'waktu_tempuh_jam', 'waktu_tempuh_menit', 'jml_saudara', 'beasiswa_prestasi', 'penyelenggara', 'thn_terima_beasiswa', 'jns_daftar', 'tgl_masuk', 'id_jurusan', 'tgl_penelusuran_kemb', 'jam_penelusuran_kemb', 'nama_sekolah_asal', 'no_un_smp', 'no_ijazah_smp', 'no_shun_smp', 'tgl_registrasi', 'id_template_bayar', 'id_kelas', 'kelas_id', 'id_thn_ajaran', 'alamat_sekolah_asal', 'kab_sekolah', 'prov_sekolah', 'info_smkti', 'tgl_update', 'id_gelombang', 'jns_kelas', 'password', 'password2', 'pendidikan_ibu', 'pendidikan_wali', 'pendidikan_ayah', 'id_kebutuhan_khusus_ibu', 'id_kebutuhan_khusus_ayah', 'kilometer', 'keahlian', 'id_jenis_pendaftaran', 'keluar_karena', 'tgl_keluar', 'alasan_keluar', 'tgl_daftar', 'skhus', 'id_area', 'no_peserta_ujian', 'skhun', 'is_aktif', 'status_daftar', 'id_rombel', 'loc_foto', 'status_dalam_keluarga', 'alamat_ayah', 'id_jalur_pendaftaran', 'kode_gratis_daftar','foto_siswa', 'kk', 'akta_kelahiran', 'ijazah', 'raport', 'ktp_ayah', 'ktp_ibu','id_user','kartu_ujian_terbit','tanggal_kartu_ujian'
    ];


    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class, 'id_gelombang');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas','idx');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_thn_ajaran');
    }

    public function tmpTinggal()
    {
        return $this->belongsTo(TmpTinggal::class, 'id_tinggal');
    }

    public function statusDaftar()
    {
        return $this->belongsTo(StatusDaftar::class, 'status_daftar');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'id_kerja_ayah');
    }

    public function buktiPembayaran()
    {
        return $this->hasMany(
            BuktiBayarCalon::class,
            'id_calon_siswa',
            'id'
        );
    }

    public function pembayaranIpaymu()
    {
        return $this->hasMany(
            IpaymuBayar::class,
            'id',
            'id_calon_siswa'
        );
    }
}