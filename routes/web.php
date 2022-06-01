<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AbsensiImport;
use App\Models\Absensi;

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


//==============================PENGURUS==============================

// Route::get('/', function () {
//     return view('welcome');
// });

    Route::get('/', function () {
        return view('pengurus/login');
    });

// Route::get('/', function () {
//     return view('pengurus/dashboard');
// });

//Route::middleware(['guest'])->group(function (){
    // Login
    Route::get('pengurus/login', 'App\Http\Controllers\LoginController@indexPengurus');
    Route::post('pengurus/login', 'App\Http\Controllers\LoginController@prosesLogin')->name('loginPost');

    // Logout
    Route::get('/logout', 'App\Http\Controllers\LoginController@logout');



//});


//Route::group(['middleware' => ['auth:anggota']], function (){
    Route::get('/pengurus/dashboard', 'App\Http\Controllers\LoginController@dashboardPengurus');

    // Anggota
    Route::get('/anggota/anggota', 'App\Http\Controllers\UserController@indexAnggota');
    //tambah anggota
    Route::post('/pengurus/anggota/anggota', 'App\Http\Controllers\UserController@storeUser')->name('tambahUser');
    //tampil detail anggota
    Route::get('/anggota/anggota/{user}', 'App\Http\Controllers\UserController@showUser');
    //hapus anggota
    Route::delete('/pengurus/anggota/anggota/{user}', 'App\Http\Controllers\UserController@destroyUser')->name('hapusUser');
    //update anggota
    Route::patch('/anggota/anggota/{user}', 'App\Http\Controllers\UserController@updateUser');
    //cari anggota
    Route::get('/anggota/cariAnggota','App\Http\Controllers\UserController@cariAnggota')->name('cariAnggota');


    // // Pengurus
    Route::get('/pengurus-crud/pengurus', 'App\Http\Controllers\UserController@indexPengurus');
    // Route::get('/pengurus/pengurus-crud/pengurus', 'App\Http\Controllers\PengurusController@create');
    Route::get('/pengurus-crud/pengurus/{user}', 'App\Http\Controllers\UserController@showUser')->name('showPengurus');
    Route::post('/pengurus/pengurus-crud/pengurus', 'App\Http\Controllers\UserController@storeUser')->name('tambahUser');
    // Route::delete('/pengurus/pengurus-crud/pengurus/{user}', 'App\Http\Controllers\UserController@destroyUser')->name('hapusUser');
    // Route::get('/pengurus/pengurus-crud/{user}/edit', 'App\Http\Controllers\UserController@edit');
    Route::patch('/pengurus-crud/pengurus/{user}', 'App\Http\Controllers\UserController@updateUser');
    Route::patch('/pengurus-crud/profil-pengurus/{user}', 'App\Http\Controllers\UserController@updateProfilPengurus')->name('updateProfilPengurus');
    Route::get('/pengurus-crud/profil-pengurus', 'App\Http\Controllers\UserController@profilPengurus');
    Route::get('/pengurus/cariPengurus','App\Http\Controllers\UserController@cariPengurus')->name('cariPengurus');

    // Route::get('/pengurus-crud/profil-pengurus/change-password', 'App\Http\Controllers\PengurusController@changePassword')->name('change_password');
    Route::patch('/pengurus-crud/profil-pengurus', 'App\Http\Controllers\UserController@updatePasswordPengurus')->name('update_password_pengurus');



    // Organisasi
    Route::get('/organisasi/organisasi', 'App\Http\Controllers\OrganisasiController@index');
    // Route::get('/pengurus/organisasi/organisasi', 'App\Http\Controllers\OrganisasiController@create');
    Route::post('/pengurus/organisasi/organisasi', 'App\Http\Controllers\OrganisasiController@store')->name('tambahOrganisasi');
    Route::delete('/organisasi/organisasi/{organisasi}', 'App\Http\Controllers\OrganisasiController@destroy');
    // Route::get('/organisasi/organisasi/{organisasi}/edit', 'App\Http\Controllers\OrganisasiController@edit');
    Route::patch('/organisasi/organisasi/{organisasi}', 'App\Http\Controllers\OrganisasiController@update')->name('editOrganisasi');

    // Kegiatan
    Route::get('/kegiatan/kegiatan', 'App\Http\Controllers\KegiatanController@index');
    // Route::get('/pengurus/kegiatan/kegiatan', 'App\Http\Controllers\KegiatanController@create');
    Route::get('/kegiatan/kegiatan/{kegiatan}', 'App\Http\Controllers\KegiatanController@show');
    Route::post('/pengurus/kegiatan/kegiatan', 'App\Http\Controllers\KegiatanController@store');
    Route::delete('/kegiatan/kegiatan/{kegiatan}', 'App\Http\Controllers\KegiatanController@destroy');
    // Route::get('/kegiatan/kegiatan/{kegiatan}/edit', 'App\Http\Controllers\KegiatanController@edit');
    Route::patch('/kegiatan/kegiatan/{kegiatan}', 'App\Http\Controllers\KegiatanController@update');
    Route::get('/kegiatan/kegiatan_pdf/{id}', 'App\Http\Controllers\KegiatanController@exportPDF')->name('exportPDF');
    // Route::get('/kegiatan/kegiatan_pdf/{kegiatan}', 'App\Http\Controllers\KegiatanController@exportPDF')->name('exportPDF');
    Route::get('/kegiatan/cariKegiatan','App\Http\Controllers\KegiatanController@cariKegiatan')->name('cariKegiatan');
    Route::get('/kegiatan/filterTanggal','App\Http\Controllers\KegiatanController@filterTanggal')->name('filterTanggalKegiatan');

    // Event
    Route::get('/event/event', 'App\Http\Controllers\EventController@index');
    Route::get('/event/event/{event}', 'App\Http\Controllers\EventController@show');
    Route::post('/pengurus/event/event', 'App\Http\Controllers\EventController@store');
    Route::delete('/event/event/{event}', 'App\Http\Controllers\EventController@destroy');
    Route::patch('/event/event/{event}', 'App\Http\Controllers\EventController@update');
    Route::get('/event/cariEvent','App\Http\Controllers\EventController@carievent')->name('cariEvent');
    Route::get('/event/filterTanggal','App\Http\Controllers\EventController@filterTanggal')->name('filterTanggalEvent');

    // Pengumuman
    Route::get('/pengumuman/pengumuman', 'App\Http\Controllers\PengumumanController@index');
    // Route::get('/pengurus/pengumuman/pengumuman', 'App\Http\Controllers\PengumumanController@create');
    Route::get('/pengumuman/pengumuman/{pengumuman}', 'App\Http\Controllers\PengumumanController@show');
    Route::post('/pengurus/pengumuman/pengumuman', 'App\Http\Controllers\PengumumanController@store');
    Route::delete('/pengumuman/pengumuman/{pengumuman}', 'App\Http\Controllers\PengumumanController@destroy');
    // Route::get('/pengumuman/pengumuman/{pengumuman}/edit', 'App\Http\Controllers\PengumumanController@edit');
    Route::patch('/pengumuman/pengumuman/{pengumuman}', 'App\Http\Controllers\PengumumanController@update');
    Route::get('/pengumuman/download/{id}', 'App\Http\Controllers\PengumumanController@downloadPengumuman')->name('file.download');
    Route::get('/pengumuman/cariPengumuman','App\Http\Controllers\PengumumanController@cariPengumuman')->name('cariPengumuman');

    // Absensi
    Route::get('/absensi/absensi', 'App\Http\Controllers\AbsensiController@index');
    Route::get('/pengurus/absensi/create-absensi', 'App\Http\Controllers\AbsensiController@create');
    // Route::get('/absensi/absensi/{absensi}', 'App\Http\Controllers\AbsensiController@show');
    Route::post('/pengurus/absensi/absensi', 'App\Http\Controllers\AbsensiController@store');
    Route::delete('/absensi/absensi/{absensi}', 'App\Http\Controllers\AbsensiController@destroy');
    // Route::get('/absensi/absensi/{absensi}/edit', 'App\Http\Controllers\AbsensiController@edit');
    Route::patch('/absensi/absensi/{absensi}', 'App\Http\Controllers\AbsensiController@update')->name('editAbsensi');
    // Route::post('/absensi/absensi', 'App\Http\Controllers\AbsensiController@import_excel');
    Route::get('/absensi/export_absensi', 'App\Http\Controllers\AbsensiController@export_excel')->name('export_absensi');
    Route::get('/absensi/daftar_absensi', 'App\Http\Controllers\AbsensiController@daftarAbsensi')->name('daftar_absensi');
    Route::get('/absensi/cariAbsensi','App\Http\Controllers\AbsensiController@cariAbsensi')->name('cariAbsensi');
    Route::get('/absensi/filterTanggal','App\Http\Controllers\AbsensiController@filterTanggal')->name('filterTanggalAbsensi');
    Route::get('/absensi/cariOrganisasi','App\Http\Controllers\AbsensiController@cariOrganisasi')->name('cariOrganisasi');

    // Laporan Keuangan
    Route::get('/laporan/laporan-keuangan', 'App\Http\Controllers\LaporanKeuanganController@index');
    Route::delete('/laporan/laporan-keuangan/{laporan}', 'App\Http\Controllers\LaporanKeuanganController@destroy');
    Route::get('/laporan/laporan-keuangan/{laporan}', 'App\Http\Controllers\LaporanKeuanganController@show');
    Route::post('/pengurus/laporan/laporan-keuangan', 'App\Http\Controllers\LaporanKeuanganController@store')->name('tambahLaporan');
    Route::delete('/laporan/laporan-keuangan/{laporan-keuangan}', 'App\Http\Controllers\LaporanKeuanganController@destroy')->name('hapusLaporan');
    Route::put('/laporan/laporan-keuangan/{id}', 'App\Http\Controllers\LaporanKeuanganController@update')->name('editLaporan');
    Route::get('/laporan-keuangan/export_laporan-keuangan', 'App\Http\Controllers\LaporanKeuanganController@export_excel')->name('export_laporan-keuangan');
    Route::get('/laporan-keuangan/filterTanggal','App\Http\Controllers\LaporanKeuanganController@filterTanggal')->name('filterTanggalKeuangan');
    // Route::get('/laporan-keuangan-pdf/{laporan-keuangan}', 'App\Http\Controllers\LaporanKeuanganController@exportPDF')->name('exportPDF');
    Route::get('/laporan/cariLaporan','App\Http\Controllers\LaporanKeuanganController@cariLaporan')->name('cariLaporan');
    Route::get('/laporan-keuangan/laporan_keuangan_pdf/{id}', 'App\Http\Controllers\LaporanKeuanganController@exportPDFKeuangan')->name('exportPDFKeuangan');


    //=====================================ANGGOTA================================
    // Route::get('/', function () {
    //     return view('anggota/dashboard-anggota');
    // });

     // Login
     Route::get('anggota/login', 'App\Http\Controllers\LoginController@indexAnggota');
     Route::post('anggota/login', 'App\Http\Controllers\LoginController@prosesLoginAnggota')->name('loginPostAnggota');
     Route::get('/dashboard-anggota', 'App\Http\Controllers\LoginController@dashboardAnggota');
     Route::patch('/dashboard-anggota/{anggota}', 'App\Http\Controllers\UserController@updateProfilAnggota')->name('updateProfilAnggota');
     Route::patch('/dashboard-anggota', 'App\Http\Controllers\UserController@updatePasswordAnggota')->name('update_password_anggota');

    //Register
    Route::get('/register', 'App\Http\Controllers\RegisterController@index');
    Route::post('/register/store', 'App\Http\Controllers\RegisterController@store')->name('register');

     Route::get('/pengumuman', 'App\Http\Controllers\PengumumanController@indexAnggota');

     Route::get('/kegiatan', 'App\Http\Controllers\KegiatanController@indexAnggota');
     Route::get('/absensi', 'App\Http\Controllers\AbsensiController@indexAnggota');
     Route::get('/laporan-keuangan', 'App\Http\Controllers\LaporanKeuanganController@indexAnggota');
     Route::get('/pengumuman/cariPengumumanAnggota','App\Http\Controllers\PengumumanController@cariPengumumanAnggota')->name('cariPengumumanAnggota');
     Route::get('/kegiatan/cariKegiatanAnggota','App\Http\Controllers\KegiatanController@cariKegiatanAnggota')->name('cariKegiatanAnggota');


     // Logout
    //  Route::get('/logout', 'App\Http\Controllers\LoginController@logoutAnggota');


    // Route::get('/kegiatan/{kegiatan}', 'App\Http\Controllers\KegiatanController@show')->name('showKegiatan');

    Route::get('absensi/get_kegiatan/{id}','App\Http\Controllers\AbsensiController@get_kegiatan');
    Route::get('absensi/get_absen/{id}','App\Http\Controllers\AbsensiController@get_absen');
    Route::get('absensi/hapus_absen/{id}','App\Http\Controllers\AbsensiController@hapus');
    Route::post('absensi/update_absen','App\Http\Controllers\AbsensiController@update_absen');
    Route::get('verifikasi-akun','App\Http\Controllers\RegisterController@verifikasi_akun');
    Route::get('proses-verif/{id}','App\Http\Controllers\RegisterController@update_akun');

    Route::get('pemasukan','App\Http\Controllers\PemasukanController@index');
    Route::get('form-pemasukan','App\Http\Controllers\PemasukanController@form');
    Route::post('simpan-pemasukan','App\Http\Controllers\PemasukanController@simpan');
    Route::get('hapus-pemasukan/{id}','App\Http\Controllers\PemasukanController@hapus');
    Route::get('form-edit-pemasukan/{id}','App\Http\Controllers\PemasukanController@form_edit');
    Route::post('update_pemasukan','App\Http\Controllers\PemasukanController@update_pemasukan');

    Route::get('pengeluaran','App\Http\Controllers\PengeluaranController@index');
    Route::get('form-pengeluaran','App\Http\Controllers\PengeluaranController@form_pengeluaran');
    Route::post('simpan-pengeluaran','App\Http\Controllers\PengeluaranController@simpan');
    Route::get('view/{id}','App\Http\Controllers\PengeluaranController@view');
    Route::get('hapus-pengeluaran/{id}','App\Http\Controllers\PengeluaranController@hapus');
    Route::get('detil/{id}','App\Http\Controllers\PengeluaranController@detil');
    Route::get('download/{id}','App\Http\Controllers\PengeluaranController@download');

