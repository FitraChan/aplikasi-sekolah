<?php


use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Home;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KonfigController;
use App\Http\Controllers\IpaymuController;


// use App\Http\Controllers\GelombangController;

use App\Http\Controllers\pendaftaran\GelombangController;
use App\Http\Controllers\pendaftaran\CalonSiswaController;
use App\Http\Controllers\pendaftaran\SetKelasController;
use App\Http\Controllers\pendaftaran\BroadcastController;
use App\Http\Controllers\pendaftaran\TargetController;
use App\Http\Controllers\pendaftaran\TemplatePendaftaranController;

use App\Http\Controllers\keuangan\KatItemBayarController;
use App\Http\Controllers\keuangan\KatPeriodeBayarController;
use App\Http\Controllers\keuangan\ItemBayarController;
use App\Http\Controllers\keuangan\TemplateBayarController;
use App\Http\Controllers\keuangan\BayarController;
use App\Http\Controllers\keuangan\DetBayarController;
use App\Http\Controllers\keuangan\BayarCalonSiswaController;
use App\Http\Controllers\keuangan\DetBayarCalonSiswaController;
use App\Http\Controllers\akademik\KelasController;
use App\Http\Controllers\akademik\JurusanController;
use App\Http\Controllers\akademik\MapelController;
use App\Http\Controllers\akademik\MasterJadwalController;
use App\Http\Controllers\akademik\NilaiController;
use App\Http\Controllers\akademik\AbsensiController;
use App\Http\Controllers\akademik\SoalController;
use App\Http\Controllers\akademik\TahunAjaranController;

use App\Http\Controllers\guru\PenilaianGuruController;
use App\Http\Controllers\guru\JadwalController;
use App\Http\Controllers\guru\UjianController;
use App\Http\Controllers\guru\SoalGuruController;
use App\Http\Controllers\akademik\PengumumanController;

use App\Http\Controllers\pendaftaran\UjianCalonAdminController;
use App\Http\Controllers\pendaftaran\UjianSoalCalonController;
use App\Http\Controllers\pendaftaran\UjianCalonController as CalonSiswaUjianController;
use App\Http\Controllers\pendaftaran\PengumumanCalonController;

use App\Http\Controllers\siswa\SiswaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [AuthController::class, 'FormLogin'])->name('form-login');

Route::post('/login', [AuthController::class, 'Login'])->name('login');
Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');


Route::get('registerSiswa', [AuthController::class, 'registerSiswa'])->name('registerSiswa');
Route::get('registerGuru', [AuthController::class, 'registerGuru'])->name('registerGuru');
Route::post('/cekregister', [AuthController::class, 'cekregister'])->name('cekregister');
Route::post('/cekRegisterGuru', [AuthController::class, 'cekRegisterGuru'])->name('cekRegisterGuru');

Route::get('/successPembayaranIpaymu', [IpaymuController::class, 'success'])
    ->name('successPembayaranIpaymu');

Route::get('/cancelPembayaranIpaymu', [IpaymuController::class, 'cancel'])
    ->name('cancelPembayaranIpaymu');




Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/tahunAjaran', [TahunAjaranController::class, 'index'])
        ->name('tahunAjaran.index');

    Route::get('tahunAjaran/data', [TahunAjaranController::class, 'data'])
        ->name('tahunAjaran.data');

    Route::post('tahunAjaran/store', [TahunAjaranController::class, 'store'])
        ->name('tahunAjaran.store');

    Route::post('tahunAjaran/update/{id}', [TahunAjaranController::class, 'update'])
        ->name('tahunAjaran.update');

    Route::delete('tahunAjaran/delete/{id}', [TahunAjaranController::class, 'destroy'])
        ->name('tahunAjaran.destroy');

    Route::get('/role', [RoleController::class, 'index'])
        ->name('role.index');
    Route::get('/role/data', [RoleController::class, 'data'])
        ->name('role.data');
    Route::post('/role/store', [RoleController::class, 'storeRole'])->name('role.store');
    Route::get('/role/data-role', [RoleController::class, 'dataRole'])->name('role.dataRole');
    Route::post('/role/storeUser', [RoleController::class, 'storeUser'])->name('role.store');
    Route::get('/role/editUser/{id}', [RoleController::class, 'editUser'])->name('role.editUser');
    Route::post('/role/updateUser/{id}', [RoleController::class, 'updateUser'])->name('role.updateUser');
    Route::delete('/role/deleteRole/{id}', [RoleController::class, 'deleteRole'])->name('role.deleteRole');

    Route::get('kat-item-bayar', [KatItemBayarController::class, 'index'])
        ->name('kat-item-bayar.index');
    Route::get('kat-item-bayar/data', [KatItemBayarController::class, 'data'])
        ->name('kat-item-bayar.data');
    Route::post('kat-item-bayar/store', [KatItemBayarController::class, 'store'])
        ->name('kat-item-bayar.store');
    Route::get('kat-item-bayar/edit/{id}', [KatItemBayarController::class, 'edit'])
        ->name('kat-item-bayar.edit');
    Route::post('kat-item-bayar/update/{id}', [KatItemBayarController::class, 'update'])
        ->name('kat-item-bayar.update');
    Route::delete('kat-item-bayar/delete/{id}', [KatItemBayarController::class, 'destroy'])
        ->name('kat-item-bayar.delete');
    Route::get(
        '/kat-periode-bayar',
        [KatPeriodeBayarController::class, 'index']
    )->name('kat-periode-bayar.index');

    Route::get(
        '/kat-periode-bayar/data',
        [KatPeriodeBayarController::class, 'data']
    )->name('kat-periode-bayar.data');

    Route::post(
        '/kat-periode-bayar/store',
        [KatPeriodeBayarController::class, 'store']
    )->name('kat-periode-bayar.store');

    Route::post(
        '/kat-periode-bayar/update/{id}',
        [KatPeriodeBayarController::class, 'update']
    )->name('kat-periode-bayar.update');

    Route::delete(
        '/kat-periode-bayar/delete/{id}',
        [KatPeriodeBayarController::class, 'destroy']
    )->name('kat-periode-bayar.delete');

    Route::get(
        '/item-bayar',
        [ItemBayarController::class, 'index']
    )->name('item-bayar.index');

    Route::get(
        '/item-bayar/data',
        [ItemBayarController::class, 'data']
    )->name('item-bayar.data');

    Route::post(
        '/item-bayar/store',
        [ItemBayarController::class, 'store']
    )->name('item-bayar.store');

    Route::post(
        '/item-bayar/update/{id}',
        [ItemBayarController::class, 'update']
    )->name('item-bayar.update');

    Route::delete(
        '/item-bayar/delete/{id}',
        [ItemBayarController::class, 'destroy']
    )->name('item-bayar.delete');

    Route::get(
        '/template-bayar',
        [TemplateBayarController::class, 'index']
    )->name('template-bayar.index');

    Route::get(
        '/template-bayar/data',
        [TemplateBayarController::class, 'data']
    )->name('template-bayar.data');

    Route::post(
        '/template-bayar/store',
        [TemplateBayarController::class, 'store']
    )->name('template-bayar.store');

    Route::post(
        '/template-bayar/update/{id}',
        [TemplateBayarController::class, 'update']
    )->name('template-bayar.update');

    Route::delete(
        '/template-bayar/delete/{id}',
        [TemplateBayarController::class, 'delete']
    )->name('template-bayar.delete');

    Route::get(
        '/template-bayar/detail/{id}',
        [TemplateBayarController::class, 'detail']
    )->name('template-bayar.detail');

    Route::post(
        '/template-bayar/set-default/{id}',
        [TemplateBayarController::class, 'setDefault']
    )->name('template-bayar.set-default');

    Route::post(
        '/template-bayar-detail/storeDetail',
        [TemplateBayarController::class, 'storeDetail']
    )->name('template-bayar-detail.storeDetail');


    Route::post(
        '/template-bayar-detail/updateDetail/{id}',
        [TemplateBayarController::class, 'updateDetail']
    )->name('template-bayar-detail.updateDetail');

    Route::delete(
        '/template-bayar-detail/deleteDetail/{id}',
        [TemplateBayarController::class, 'deleteDetail']
    )->name('template-bayar-detail.deleteDetail');


    Route::get('/bayar', [BayarController::class, 'index'])
        ->name('bayar.index');

    Route::put('/bayar/{id}', [BayarController::class, 'update'])
        ->name('bayar.update');

    // Data siswa untuk DataTables/Ajax
    Route::get('/bayar/data', [BayarController::class, 'data'])
        ->name('bayar.data');

    // Detail pembayaran berdasarkan NIPD
    Route::get('/bayar/detail/{nipd}', [BayarController::class, 'detail'])
        ->name('bayar.detail');

    Route::get('/bayar/detailBayar/{nipd}', [BayarController::class, 'detailBayar'])
        ->name('bayar.detailBayar');

    Route::post('/bayar/setDefBulan', [BayarController::class, 'setDefBulan'])
        ->name('bayar.setDefBulan');

    Route::post('/bayar/set-lunas/{id}', [BayarController::class, 'setLunas'])
        ->name('bayar.set-lunas');

    Route::post('/bayar/simpanCicilan', [BayarController::class, 'simpanCicilan'])
        ->name('bayar.simpanCicilan');

    Route::get('/bayar/createReportPdf/{id}', [BayarController::class, 'createReportPdf'])
        ->name('bayar.createReportPdf');

    Route::post('/det-bayar/store', [DetBayarController::class, 'store'])
        ->name('det-bayar.store');

    Route::put('/det-bayar/{id}', [DetBayarController::class, 'update'])
        ->name('det-bayar.update');

    Route::delete('/det-bayar/{id}', [DetBayarController::class, 'destroy'])
        ->name('det-bayar.destroy');

    Route::post('/det-bayar/set-regis', [DetBayarController::class, 'setRegis'])
        ->name('det-bayar.set-regis');

    Route::delete('/bayar/{id}', [BayarController::class, 'destroy'])
        ->name('bayar.destroy');

    Route::get('/bayar-calon-siswa', [BayarCalonSiswaController::class, 'index'])
        ->name('bayar-calon-siswa.index');

    Route::put('/bayar-calon-siswa/{id}', [BayarCalonSiswaController::class, 'update'])
        ->name('bayar-calon-siswa.update');

    Route::delete('/bayar-calon-siswa/{id}', [BayarCalonSiswaController::class, 'destroy'])
        ->name('bayar-calon-siswa.destroy');

    Route::get('/bayar-calon-siswa/data', [BayarCalonSiswaController::class, 'data'])
        ->name('bayar-calon-siswa.data');

    Route::get('/bayar-calon-siswa/detail/{nipd}', [BayarCalonSiswaController::class, 'detail'])
        ->name('bayar-calon-siswa.detail');

    Route::get('/bayar-calon-siswa/detailBayar/{nipd}', [BayarCalonSiswaController::class, 'detailBayar'])
        ->name('bayar-calon-siswa.detailBayar');

    Route::post('/bayar-calon-siswa/setDefBulan', [BayarCalonSiswaController::class, 'setDefBulan'])
        ->name('bayar-calon-siswa.setDefBulan');

    Route::post('/bayar-calon-siswa/set-lunas/{id}', [BayarCalonSiswaController::class, 'setLunas'])
        ->name('bayar-calon-siswa.set-lunas');

    Route::post('/bayar-calon-siswa/simpanCicilan', [BayarCalonSiswaController::class, 'simpanCicilan'])
        ->name('bayar-calon-siswa.simpanCicilan');

    Route::get('/bayar-calon-siswa/createReportPdf/{id}', [BayarCalonSiswaController::class, 'createReportPdf'])
        ->name('bayar-calon-siswa.createReportPdf');

    Route::post('det-bayar-calon-siswa/store', [DetBayarCalonSiswaController::class, 'store'])
        ->name('det-bayar-calon-siswa.store');

    Route::put('det-bayar-calon-siswa/{id}', [DetBayarCalonSiswaController::class, 'update'])
        ->name('det-bayar-calon-siswa.update');

    Route::delete('det-bayar-calon-siswa/{id}', [DetBayarCalonSiswaController::class, 'destroy'])
        ->name('det-bayar-calon-siswa.destroy');





    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');

    Route::get('kelas/data', [KelasController::class, 'data'])->name('kelas.data');

    Route::post('kelas/store', [KelasController::class, 'store']);

    Route::post('kelas/update/{id}', [KelasController::class, 'update']);

    Route::delete('kelas/delete/{id}', [KelasController::class, 'destroy']);


    Route::get('/jurusan', [JurusanController::class, 'index'])
        ->name('jurusan.index');

    Route::get('jurusan/data', [JurusanController::class, 'data'])
        ->name('jurusan.data');

    Route::post('jurusan/store', [JurusanController::class, 'store']);

    Route::post('jurusan/update/{id}', [JurusanController::class, 'update']);

    Route::delete('jurusan/delete/{id}', [JurusanController::class, 'destroy']);

    Route::get('/mapel', [MapelController::class, 'index'])
        ->name('mapel.index');

    Route::get('mapel/data', [MapelController::class, 'data'])
        ->name('mapel.data');

    Route::post('mapel/store', [MapelController::class, 'store']);

    Route::post('mapel/update/{id}', [MapelController::class, 'update']);

    Route::delete('mapel/delete/{id}', [MapelController::class, 'destroy']);
    Route::get('/master-jadwal', [MasterJadwalController::class, 'index'])
        ->name('master-jadwal.index');

    Route::get('master-jadwal/data', [MasterJadwalController::class, 'data'])
        ->name('master-jadwal.data');

    Route::post('master-jadwal/store', [MasterJadwalController::class, 'store']);

    Route::post('master-jadwal/update/{id}', [MasterJadwalController::class, 'update']);

    Route::delete('master-jadwal/delete/{id}', [MasterJadwalController::class, 'destroy']);


    Route::post(
        'master-jadwal/update-guru',
        [MasterJadwalController::class, 'updateGuru']
    )->name('master-jadwal.update-guru');

    Route::get(
        '/detail-jadwal/data',
        [MasterJadwalController::class, 'dataDetail']
    )->name('detail-jadwal.data');

    Route::post(
        '/detail-jadwal/update',
        [MasterJadwalController::class, 'updateDetail']
    )->name('detail-jadwal.update');

    Route::post(
        '/master-jadwal/inisialisasi',
        [MasterJadwalController::class, 'inisialisasi']
    )->name('master-jadwal.inisialisasi');

    Route::post(
        '/master-jadwal/isi-nilai',
        [MasterJadwalController::class, 'isiNilai']
    )->name('master-jadwal.isi-nilai');

    Route::get(
        '/nilai',
        [NilaiController::class, 'index']
    )->name('nilai.index');

    Route::get(
        'nilai/data',
        [NilaiController::class, 'data']
    )->name('nilai.data');

    Route::post(
        'nilai/store',
        [NilaiController::class, 'store']
    )->name('store');

    // Route::post(
    //     'nilai/update/{id}',
    //     [NilaiController::class, 'update']
    // )->name('update');

    Route::delete(
        'nilai/delete/{id}',
        [NilaiController::class, 'delete']
    )->name('delete');

    Route::get(
        'nilai/show/{id}',
        [NilaiController::class, 'show']
    )->name('show');

    // Route::get(
    //     'nilai/detail/{id}',
    //     [NilaiController::class, 'detIndex']
    // )->name('detail');


    // Route::post('/nilai-harian/update', [NilaiController::class, 'update'])
    //     ->name('nilai-harian.update');


    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/data', [AbsensiController::class, 'data'])->name('absensi.data');

    Route::get('/absensi/dataDetailAbsensi/{id}', [AbsensiController::class, 'dataDetailAbsensi'])->name('dataDetailAbsensi');
    Route::get('/absensi/dataAbsensi/{id}', [AbsensiController::class, 'dataAbsensi'])->name('dataAbsensi');

    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');

    Route::post('/absensi/simpanDetailAbsensi', [AbsensiController::class, 'simpanDetailAbsensi'])->name('absensi.simpanDetailAbsensi');

    Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');

    Route::get('/soal/data', [SoalController::class, 'data'])->name('soal.data');


    Route::get('/soal/dataSoal/{id}', [SoalController::class, 'dataSoal'])->name('soal.dataSoal');
    Route::get('/soal/dataUjian/{id}', [SoalController::class, 'dataUjian'])->name('soal.dataUjian');

    Route::get('/konfig', [KonfigController::class, 'index'])->name('konfig.index');
    Route::get('konfig/data', [KonfigController::class, 'data'])->name('konfig.data');

    Route::post('konfig/update/{id}', [KonfigController::class, 'update'])->name('konfig.update');
    Route::get('/pengumuman', [
        PengumumanController::class,
        'index'
    ])->name('pengumuman.index');

    Route::get('/pengumuman/data', [
        PengumumanController::class,
        'data'
    ])->name('pengumuman.data');

    Route::post('/pengumuman/store', [
        PengumumanController::class,
        'store'
    ])->name('pengumuman.store');

    Route::put('/pengumuman/update/{id}', [
        PengumumanController::class,
        'update'
    ])->name('pengumuman.update');

    Route::delete('/pengumuman/delete/{id}', [
        PengumumanController::class,
        'destroy'
    ])->name('pengumuman.destroy');

    Route::resource('ujianCalonAdmin', UjianCalonAdminController::class);

    Route::delete(
    '/ujian-calon-admin/{id}/hapus',
    [UjianCalonAdminController::class, 'hapus']
)->name('ujianCalonAdmin.hapus');

    Route::get(
        'ujianCalonAdmin/{ujianCalonAdmin}/peserta',
        [UjianCalonAdminController::class, 'peserta']
    )->name('ujianCalonAdmin.peserta');

    Route::get(
        'ujianCalonAdmin/{ujianCalonAdmin}/peserta/{peserta}/jawaban',
        [UjianCalonAdminController::class, 'jawabanPeserta']
    )->name('ujianCalonAdmin.jawaban-peserta');


    Route::get(
        'ujianCalonAdmin/{ujianCalonAdmin}/peserta',
        [UjianCalonAdminController::class, 'peserta']
    )->name('ujianCalonAdmin.peserta');


    Route::get(
        'soalCalon/{id}',
        [UjianSoalCalonController::class, 'index']
    )->name('soalCalon.index');

    Route::get(
        'ujian/{ujian}/soalCalon/create',
        [UjianSoalCalonController::class, 'create']
    )->name('soalCalon.create');

    Route::post(
        'soalCalon',
        [UjianSoalCalonController::class, 'store']
    )->name('soalCalon.store');

    Route::put(
        'soalCalon/{soal}',
        [UjianSoalCalonController::class, 'update']
    )->name('soalCalon.update');

    Route::get(
        'soalCalon/{soal}/edit',
        [UjianSoalCalonController::class, 'edit']
    )->name('soalCalon.edit');


    Route::delete(
        'soalCalon/{soal}',
        [UjianSoalCalonController::class, 'destroy']
    )->name('soalCalon.destroy');


    Route::prefix('siswa')
        ->name('siswa.')
        ->controller(SiswaController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/data', 'data')
                ->name('data');

            Route::get('/create', 'create')
                ->name('create');

            Route::post('/store', 'store')
                ->name('store');

            Route::get('/edit/{id}', 'edit')
                ->name('edit');

            Route::post('/update/{id}', 'update')
                ->name('update');

            Route::delete('/delete/{id}', 'destroy')
                ->name('destroy');
        });

            Route::put('/siswa/{id?}/orang-tua', [
                SiswaController::class,
                'updateOrangTua'
            ])->name('siswa.update.orangtua');

            Route::post('/siswa/akademik/{id?}', [
                SiswaController::class,
                'updateAkademik'
            ])->name('siswa.update-akademik');

            Route::put('/siswa/{id?}/upload', [
                SiswaController::class,
                'updateUpload'
            ])->name('siswa.update.upload');


            Route::get('/siswaBaru', [
                SiswaController::class,
                'siswaBaru'
            ])->name('siswaBaru');

              Route::get('/dataSiswaBaru', [
                SiswaController::class,
                'dataSiswaBaru'
            ])->name('dataSiswaBaru');


             Route::post('/setNipd', [
                SiswaController::class,
                'setNipd'
            ])->name('setNipd');


        Route::get(
            'templatePendaftaran',
            [TemplatePendaftaranController::class, 'index']
        )->name('templatePendaftaran.index');  
        
        
        Route::get(
            'templatePendaftaran/data',
            [TemplatePendaftaranController::class, 'data']
        )->name('templatePendaftaran.data'); 





    // role admin
});


Route::middleware(['auth', 'role:admin|calon'])->group(function () {

    Route::post(
        '/calon-siswa/update/updateRegistrasiSiswa/{id?}',
        [CalonSiswaController::class, 'updateRegistrasiSiswa']
    )->name('calon-siswa.update.updateRegistrasiSiswa');
});




Route::middleware(['auth', 'role:admin|Akademik'])->group(function () {

    Route::get('/admin', [Home::class, 'index'])
        ->name('admin');

    Route::get('/gelombang', [GelombangController::class, 'index'])->name('gelombang.index');
    Route::get('/gelombang/data', [GelombangController::class, 'data'])->name('gelombang.data');
    Route::post('/gelombang/store', [GelombangController::class, 'store'])->name('gelombang.store');
    Route::post('/gelombang/update/{id}', [GelombangController::class, 'update'])->name('gelombang.update');
    Route::delete('/gelombang/delete/{id}', [GelombangController::class, 'destroy'])->name('gelombang.delete');
    Route::get('/calon-siswa', [CalonSiswaController::class, 'index'])
        ->name('calon-siswa.index');

    Route::get('/daftarSiswa', [CalonSiswaController::class, 'daftarSiswa'])
        ->name('daftarSiswa');

    Route::get('/calon-siswa/data', [CalonSiswaController::class, 'data'])
        ->name('calon-siswa.data');
    Route::post('/calon-siswa/store', [CalonSiswaController::class, 'store'])->name('calon-siswa.store');
    //  Route::post('/calon-siswa/update/{id}', [CalonSiswaController::class, 'update'])->name('calon-siswa.update');
    Route::get('/calon-siswa/edit/{id}', [CalonSiswaController::class, 'edit'])
        ->name('calon-siswa.edit');
    Route::get('/calon-siswa/create', [CalonSiswaController::class, 'create'])
        ->name('calon-siswa.create');
    Route::delete('/calon-siswa/delete/{id}', [CalonSiswaController::class, 'destroy'])->name('calon-siswa.delete');

     Route::get('/daftarCalonSiswa', [CalonSiswaController::class, 'daftarCalonSiswa'])
        ->name('daftarCalonSiswa');

    Route::post(
    '/calon-siswa/save-daftar-siswa',
    [CalonSiswaController::class, 'saveDaftarSiswa']
    )->name('calon-siswa.save-daftar-siswa');

    Route::get(
        '/calon-siswa/generate-nipd',
        [CalonSiswaController::class, 'generateNipd']
    )->name('calon-siswa.generate-nipd');


Route::get(
    '/listBuktiPembayaran',
    [CalonSiswaController::class, 'listBuktiPembayaran']
)->name('listBuktiPembayaran');



    Route::post(
        '/calon-siswa/update/orang-tua/{id}',
        [CalonSiswaController::class, 'updateOrangTua']
    )->name('calon-siswa.update.orangtua');


    Route::get('/ipaymu/{id}', [BayarController::class, 'dataIpaymu'])
        ->name('ipaymu.data');


    Route::post(
        '/calon-siswa/update/registrasi/{id}',
        [CalonSiswaController::class, 'updateRegistrasi']
    )->name('calon-siswa.update.registrasi');
    Route::post(
        '/calon-siswa/update-status/{id}',
        [CalonSiswaController::class, 'updateStatus']
    )->name('calon-siswa.update-status');
    // halaman
    Route::get('/set-kelas', [
        SetKelasController::class,
        'index'
    ])->name('set-kelas.index');
    // data tabulator
    Route::get('set-kelas/data', [
        SetKelasController::class,
        'data'
    ])->name('set-kelas.data');
    // update kelas
    Route::post('/set-kelas/updateKelas/{id}', [
        SetKelasController::class,
        'updateKelas'
    ])->name('set-kelas.update');
    Route::get('/rekapKelas', [
        SetKelasController::class,
        'rekapKelas'
    ])->name('rekapKelas');
    Route::get('/daftarSiswa', [
        CalonSiswaController::class,
        'daftarSiswa'
    ])->name('daftarSiswa');
    // Route::prefix('broadcast')->group(function () {
    Route::get('broadcast', [
        BroadcastController::class,
        'index'
    ])->name('broadcast.index');
    Route::get('broadcast/data', [
        BroadcastController::class,
        'data'
    ])->name('broadcast.data');
    Route::post('broadcast/store', [
        BroadcastController::class,
        'store'
    ])->name('broadcast.store');
    Route::post('broadcast/update/{id}', [
        BroadcastController::class,
        'update'
    ])->name('broadcast.update');
    Route::delete('broadcast/delete/{id}', [
        BroadcastController::class,
        'delete'
    ])->name('broadcast.delete');
    Route::post('broadcast/kirimSemua', [BroadcastController::class, 'kirimSemua']);
    Route::post('calon-siswa/upload/{id}', [CalonSiswaController::class, 'updateUpload'])->name('calon-siswa.update.upload');

    Route::get('/target', [TargetController::class, 'index'])
        ->name('target.index');

    Route::get('target/data', [TargetController::class, 'data'])
        ->name('target.data');

    Route::post('target/store', [TargetController::class, 'store'])
        ->name('target.store');

    Route::put('target/update/{id}', [TargetController::class, 'update'])
        ->name('target.update');

    Route::delete('target/delete/{id}', [TargetController::class, 'destroy'])
        ->name('target.destroy');
});


Route::middleware(['auth', 'role:calon'])->group(function () {


    Route::get(
        '/pembayaranCalonSiswa',
        [CalonSiswaController::class, 'pembayaranCalonSiswa']
    )->name('pembayaranCalonSiswa');

    Route::get(
        '/calon-siswa/profil',
        [CalonSiswaController::class, 'editCalonSiswa']
    )->name('calon-siswa.profil');


    Route::post(
        '/calon-siswa/update/orang-tua/{id}',
        [CalonSiswaController::class, 'updateOrangTua']
    )->name('calon-siswa.update.orangtua');
    Route::post(
        '/calon-siswa/update/registrasi/{id}',
        [CalonSiswaController::class, 'updateRegistrasi']
    )->name('calon-siswa.update.registrasi');
    // Route::post(
    //     '/calon-siswa/update-status/{id}',
    //     [CalonSiswaController::class, 'updateStatus']
    // )->name('calon-siswa.update-status');

    Route::post('/calon-siswa/upload/{id}', [CalonSiswaController::class, 'updateUpload'])->name('calon-siswa.update.upload');

    Route::post('/calon-siswa/ipaymu', [BayarCalonSiswaController::class, 'ipaymu'])
        ->name('calon-siswa.ipaymu');

    // Route::post('/ipaymu/callback', [CalonSiswaController::class, 'callback'])
    // ->name('ipaymu.callback');

    Route::get('/calon-siswa/successPembayaran', [BayarCalonSiswaController::class, 'successPembayaran'])
        ->name('calon-siswa.success-pembayaran');

    Route::get('/calon-siswa/cancelPembayaran', [BayarCalonSiswaController::class, 'cancelPembayaran'])
        ->name('calon-siswa.cancel-pembayaran');


    Route::post(
        '/calon-siswa/pembayaran/{id}',
        [CalonSiswaController::class, 'pembayaran']
    )->name('calon-siswa.pembayaran');


    Route::get(
        'ujianCalon',
        [CalonSiswaUjianController::class, 'index']
    )->name('ujianCalon.index');

    Route::post(
        'ujianCalon/{ujian}/mulai',
        [CalonSiswaUjianController::class, 'mulai']
    )->name('ujianCalon.mulai');

    Route::get(
        'ujianCalon/peserta/{peserta}/kerjakan',
        [CalonSiswaUjianController::class, 'kerjakan']
    )->name('ujianCalon.kerjakan');

    Route::post(
        'ujianCalon/peserta/{peserta}/submit',
        [CalonSiswaUjianController::class, 'submit']
    )->name('ujianCalon.submit');

    Route::get(
        'ujianCalon/peserta/{peserta}/hasil',
        [CalonSiswaUjianController::class, 'hasil']
    )->name('ujianCalon.hasil');


    Route::get(
        'pengumumanCalon',
        [PengumumanCalonController::class, 'index']
    )->name('pengumumanCalon.index');

    Route::get(
        'pengumumanCalon/{id}',
        [PengumumanCalonController::class, 'show']
    )->name('pengumumanCalon.show');
});

Route::middleware(['auth', 'role:guru'])->group(function () {

    Route::get('/dashboard', [Home::class, 'index'])
        ->name('dashboard');

    Route::get(
        '/pbm',
        [PenilaianGuruController::class, 'index']
    )->name('pbm.index');

    Route::get('pbm/data', [PenilaianGuruController::class, 'data'])->name('pbm.data');
    Route::get('pbm/dataMateri/{id}', [PenilaianGuruController::class, 'dataMateri'])->name('pbm.dataMateri');
    Route::get('pbm/tambahMateri/{id}', [PenilaianGuruController::class, 'tambahMateri'])->name('pbm.tambahMateri');
    Route::post('pbm/simpanMateri', [PenilaianGuruController::class, 'simpanMateri'])->name('pbm.simpanMateri');
    Route::delete(
        'pbm/hapusMateri/{id}',
        [PenilaianGuruController::class, 'hapusMateri']
    )->name('pbm.hapusMateri');

    Route::get('pbm/dataAbsen/{id}', [PenilaianGuruController::class, 'dataAbsen'])->name('pbm.dataAbsen');
    Route::post('/absensi/simpanDetailAbsensi', [AbsensiController::class, 'simpanDetailAbsensi'])->name('absensi.simpanDetailAbsensi');
    Route::get('pbm/editMateri/{id}', [PenilaianGuruController::class, 'editMateri'])->name('pbm.editMateri');
    Route::put('pbm/updateMateri/{id}', [PenilaianGuruController::class, 'updateMateri'])->name('pbm.updateMateri');
    Route::post('pbm/simpanUjian', [PenilaianGuruController::class, 'simpanUjian'])->name('pbm.simpanUjian');
    Route::delete('pbm/deleteUjian/{id}', [PenilaianGuruController::class, 'deleteUjian'])
        ->name('pbm.deleteUjian');
    Route::get('pbm/dataDetQuiz/{id}', [PenilaianGuruController::class, 'dataDetQuiz'])->name('pbm.dataDetQuiz');
    Route::post('/ckeditor/upload', [PenilaianGuruController::class, 'upload'])
        ->name('ckeditor.upload');
    Route::get('/pbm/cariSoal/{id}', [PenilaianGuruController::class, 'cariSoal'])
        ->name('pbm.cariSoal');
    Route::post('/pbm/updateSoal', [PenilaianGuruController::class, 'updateSoal'])->name('pbm.updateSoal');
    Route::post('/pbm/storeSoal/{id}', [PenilaianGuruController::class, 'storeSoal'])->name('pbm.storeSoal');
    Route::get('/pbm/dataMasterSoal', [PenilaianGuruController::class, 'dataMasterSoal']);
    Route::post('/pbm/deleteDetUjian', [PenilaianGuruController::class, 'deleteDetUjian'])
        ->name('pbm.deleteDetUjian');

    Route::post('/pbm/createDetQuiz/{id}', [PenilaianGuruController::class, 'createDetQuiz'])
        ->name('pbm.createDetQuiz');
    Route::get(
        'pbm/nilai/{id}',
        [PenilaianGuruController::class, 'nilai']
    )->name('pbm.nilai');
    Route::get('/jadwalGuru', [JadwalController::class, 'index'])->name('jadwalGuru.index');


    Route::get('/ujianGuru', [UjianController::class, 'index'])->name('ujianGuru.index');

    Route::get('ujianGuru/data', [UjianController::class, 'data'])->name('ujianGuru.data');

    Route::post('ujianGuru/store', [UjianController::class, 'store'])->name('ujianGuru.store');
    Route::put('ujianGuru/update/{id}', [UjianController::class, 'update'])->name('ujianGuru.update');
    Route::delete('ujianGuru/destroy/{id}', [UjianController::class, 'destroy'])->name('ujianGuru.destroy');

    Route::get('/pbm/detail-ujian-siswa/{id}', [PenilaianGuruController::class, 'detUjianSiswa'])
        ->name('pbm.detailUjianSiswa');


    Route::get('/soalGuru', [SoalGuruController::class, 'index'])->name('soalGuru.index');

    Route::get('soalGuru/data', [SoalGuruController::class, 'data'])
        ->name('soalGuru.data');

    // Simpan
    Route::get('soalGuru/create', [SoalGuruController::class, 'create'])
        ->name('soalGuru.create');


    Route::post('soalGuru/store', [SoalGuruController::class, 'store'])
        ->name('soalGuru.store');


    Route::get('soalGuru/edit/{id}', [SoalGuruController::class, 'edit'])
        ->name('soalGuru.edit');

    Route::put('soalGuru/update/{id}', [SoalGuruController::class, 'update'])
        ->name('soalGuru.update');

    Route::delete('soalGuru/{id}', [SoalGuruController::class, 'destroy'])
        ->name('soalGuru.destroy');
    Route::post('soalGuru/import', [SoalGuruController::class, 'import'])
        ->name('soalGuru.import');
});

Route::middleware(['auth', 'role:guru|admin'])->group(function () {
    Route::get(
        'nilai/detail/{id}',
        [NilaiController::class, 'detIndex']
    )->name('detail');

    Route::post('/nilai-harian/update', [NilaiController::class, 'update'])
        ->name('nilai-harian.update');
});


Route::middleware(['auth', 'role:keuangan'])->group(function () {});

Route::middleware(['auth', 'role:siswa'])->group(function () {});


Route::get(
    'kartu-ujian/{calonSiswa}/download',
    [BayarCalonSiswaController::class, 'download']
)->middleware('signed')
    ->name('kartuUjian.download');
