<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\BidangMinatController;
use App\Http\Controllers\MatKulController;
use App\Http\Controllers\PengajuanSertifikasiController;
use App\Http\Controllers\JenisPelatihanController;
use App\Http\Controllers\PeriodeController;
// use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//url lalu function
// Route::get('d_pelatihan', [LandingController::class, 'd_pelatihan'])->name('landing.d_pelatihan');

Route::resource('/', LandingController::class);

Route::get('/dashboard', [WelcomeController::class, 'index']);

// Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka
// Route::get('login', [AuthController::class, 'login'])->name('login');
// Route::post('login', [AuthController::class, 'postlogin']);
// Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
// Route::get('register', [AuthController::class, 'register']);
// Route::post('register', [AuthController::class, 'store']);

Route::group(['prefix' => 'vendor'], function () {
    Route::get('/', [VendorController::class, 'index']); // Menampilkan halaman awal vendor
    Route::post('/list', [VendorController::class, 'list']); // Menampilkan data vendor dalam bentuk json untuk datatables
    Route::get('/create', [VendorController::class, 'create']); // Menampilkan halaman form tambah vendor
    Route::post('/', [VendorController::class, 'store']); // Menyimpan data vendor baru
    Route::get('/create_ajax', [VendorController::class, 'create_ajax']); // Menampilkan halaman form tambah vendor Ajax
    Route::post('/ajax', [VendorController::class, 'store_ajax']); // Menyimpan data vendor baru Ajax
    Route::get('/import', [VendorController::class, 'import']); // Ajax form upload excel untuk vendor
    Route::post('/import_ajax', [VendorController::class, 'import_ajax']); // Ajax import excel vendor
    Route::get('/export_excel', [VendorController::class, 'export_excel']); // Export excel vendor
    Route::get('/export_pdf', [VendorController::class, 'export_pdf']); // Export pdf vendor
    Route::get('/{id}', [VendorController::class, 'show']); // Menampilkan detail vendor
    Route::get('/{id}/edit', [VendorController::class, 'edit']); // Menampilkan halaman form edit vendor
    Route::put('/{id}', [VendorController::class, 'update']); // Menyimpan perubahan data vendor
    Route::get('/{id}/edit_ajax', [VendorController::class, 'edit_ajax']); // Menampilkan halaman form edit vendor Ajax
    Route::put('/{id}/update_ajax', [VendorController::class, 'update_ajax']); // Menyimpan perubahan data vendor Ajax
    Route::get('/{id}/delete_ajax', [VendorController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete vendor Ajax
    Route::delete('/{id}/delete_ajax', [VendorController::class, 'delete_ajax']); // Untuk hapus data vendor Ajax
    Route::delete('/{id}', [VendorController::class, 'destroy']); // Menghapus data vendor
});

Route::group(['prefix' => 'data_sertifikasi'], function () {
    Route::get('/', [SertifikasiController::class, 'index']); // Menampilkan halaman awal sertifikasi
    Route::post('/list', [SertifikasiController::class, 'list']); // Menampilkan data sertifikasi dalam bentuk json untuk datatables
    Route::get('/create', [SertifikasiController::class, 'create']); // Menampilkan halaman form tambah sertifikasi
    Route::post('/', [SertifikasiController::class, 'store']); // Menyimpan data sertifikasi baru
    Route::get('/create_ajax', [SertifikasiController::class, 'create_ajax']); // Menampilkan halaman form tambah sertifikasi Ajax
    Route::post('/ajax', [SertifikasiController::class, 'store_ajax']); // Menyimpan data sertifikasi baru Ajax
    Route::get('/import', [SertifikasiController::class, 'import']); // Ajax form upload excel untuk sertifikasi
    Route::post('/import_ajax', [SertifikasiController::class, 'import_ajax']); // Ajax import excel sertifikasi
    Route::get('/export_excel', [SertifikasiController::class, 'export_excel']); // Export excel sertifikasi
    Route::get('/export_pdf', [SertifikasiController::class, 'export_pdf']); // Export pdf sertifikasi
    Route::get('/{id}', [SertifikasiController::class, 'show']); // Menampilkan detail sertifikasi
    Route::get('/{id}/edit', [SertifikasiController::class, 'edit']); // Menampilkan halaman form edit sertifikasi
    Route::put('/{id}', [SertifikasiController::class, 'update']); // Menyimpan perubahan data sertifikasi
    Route::get('/{id}/edit_ajax', [SertifikasiController::class, 'edit_ajax']); // Menampilkan halaman form edit sertifikasi Ajax
    Route::put('/{id}/update_ajax', [SertifikasiController::class, 'update_ajax']); // Menyimpan perubahan data sertifikasi Ajax
    Route::get('/{id}/delete_ajax', [SertifikasiController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete sertifikasi Ajax
    Route::delete('/{id}/delete_ajax', [SertifikasiController::class, 'delete_ajax']); // Untuk hapus data sertifikasi Ajax
    Route::delete('/{id}', [SertifikasiController::class, 'destroy']); // Menghapus data sertifikasi
});

Route::group(['prefix' => 'data_pelatihan'], function () {
    Route::get('/', [PelatihanController::class, 'index']); // Menampilkan halaman awal pelatihan
    Route::post('/list', [PelatihanController::class, 'list']); // Menampilkan data pelatihan dalam bentuk JSON untuk datatables
    Route::get('/create', [PelatihanController::class, 'create']); // Menampilkan halaman form tambah pelatihan
    Route::post('/', [PelatihanController::class, 'store']); // Menyimpan data pelatihan baru
    Route::get('/create_ajax', [PelatihanController::class, 'create_ajax']); // Menampilkan halaman form tambah pelatihan Ajax
    Route::post('/ajax', [PelatihanController::class, 'store_ajax']); // Menyimpan data pelatihan baru Ajax
    Route::get('/import', [PelatihanController::class, 'import']); // Ajax form upload excel untuk pelatihan
    Route::post('/import_ajax', [PelatihanController::class, 'import_ajax']); // Ajax import excel pelatihan
    Route::get('/export_excel', [PelatihanController::class, 'export_excel']); // Export excel pelatihan
    Route::get('/export_pdf', [PelatihanController::class, 'export_pdf']); // Export pdf pelatihan
    Route::get('/{id}', [PelatihanController::class, 'show']); // Menampilkan detail pelatihan
    Route::get('/{id}/edit', [PelatihanController::class, 'edit']); // Menampilkan halaman form edit pelatihan
    Route::put('/{id}', [PelatihanController::class, 'update']); // Menyimpan perubahan data pelatihan
    Route::get('/{id}/edit_ajax', [PelatihanController::class, 'edit_ajax']); // Menampilkan halaman form edit pelatihan Ajax
    Route::put('/{id}/update_ajax', [PelatihanController::class, 'update_ajax']); // Menyimpan perubahan data pelatihan Ajax
    Route::get('/{id}/delete_ajax', [PelatihanController::class, 'confirm_ajax']); // Untuk tampilkan form konfirmasi delete pelatihan Ajax
    Route::delete('/{id}/delete_ajax', [PelatihanController::class, 'delete_ajax']); // Untuk hapus data pelatihan Ajax
    Route::delete('/{id}', [PelatihanController::class, 'destroy']); // Menghapus data pelatihan
});

Route::group(['prefix' => 'prodi'], function () {
    Route::get('/', [ProdiController::class, 'index']); // Menampilkan halaman awal prodi
    Route::post('/list', [ProdiController::class, 'list']); // Menampilkan data prodi dalam bentuk JSON untuk datatables
    Route::get('/create', [ProdiController::class, 'create']); // Menampilkan halaman form tambah prodi
    Route::post('/', [ProdiController::class, 'store']); // Menyimpan data prodi baru
    Route::get('/create_ajax', [ProdiController::class, 'create_ajax']); // Menampilkan halaman form tambah prodi Ajax
    Route::post('/ajax', [ProdiController::class, 'store_ajax']); // Menyimpan data prodi baru Ajax
    Route::get('/import', [ProdiController::class, 'import']); // Ajax form upload excel untuk prodi
    Route::post('/import_ajax', [ProdiController::class, 'import_ajax']); // Ajax import excel prodi
    Route::get('/export_excel', [ProdiController::class, 'export_excel']); // Export excel prodi
    Route::get('/export_pdf', [ProdiController::class, 'export_pdf']); // Export pdf prodi
    Route::get('/{id}', [ProdiController::class, 'show']); // Menampilkan detail prodi
    Route::get('/{id}/edit', [ProdiController::class, 'edit']); // Menampilkan halaman form edit prodi
    Route::put('/{id}', [ProdiController::class, 'update']); // Menyimpan perubahan data prodi
    Route::get('/{id}/edit_ajax', [ProdiController::class, 'edit_ajax']); // Menampilkan halaman form edit prodi Ajax
    Route::put('/{id}/update_ajax', [ProdiController::class, 'update_ajax']); // Menyimpan perubahan data prodi Ajax
    Route::get('/{id}/delete_ajax', [ProdiController::class, 'confirm_ajax']); // Untuk tampilkan form konfirmasi delete prodi Ajax
    Route::delete('/{id}/delete_ajax', [ProdiController::class, 'delete_ajax']); // Untuk hapus data prodi Ajax
    Route::delete('/{id}', [ProdiController::class, 'destroy']); // Menghapus data prodi
});

Route::group(['prefix' => 'kompetensi'], function () {
    Route::get('/', [KompetensiController::class, 'index']); // Menampilkan halaman awal kompetensi
    Route::post('/list', [KompetensiController::class, 'list']); // Menampilkan data kompetensi dalam bentuk JSON untuk datatables
    Route::get('/create', [KompetensiController::class, 'create']); // Menampilkan halaman form tambah kompetensi
    Route::post('/', [KompetensiController::class, 'store']); // Menyimpan data kompetensi baru
    Route::get('/create_ajax', [KompetensiController::class, 'create_ajax']); // Menampilkan halaman form tambah kompetensi Ajax
    Route::post('/ajax', [KompetensiController::class, 'store_ajax']); // Menyimpan data kompetensi baru Ajax
    Route::get('/import', [KompetensiController::class, 'import']); // Ajax form upload excel untuk kompetensi
    Route::post('/import_ajax', [KompetensiController::class, 'import_ajax']); // Ajax import excel kompetensi
    Route::get('/export_excel', [KompetensiController::class, 'export_excel']); // Export excel kompetensi
    Route::get('/export_pdf', [KompetensiController::class, 'export_pdf']); // Export pdf kompetensi
    Route::get('/{id}', [KompetensiController::class, 'show']); // Menampilkan detail kompetensi
    Route::get('/{id}/edit', [KompetensiController::class, 'edit']); // Menampilkan halaman form edit kompetensi
    Route::put('/{id}', [KompetensiController::class, 'update']); // Menyimpan perubahan data kompetensi
    Route::get('/{id}/edit_ajax', [KompetensiController::class, 'edit_ajax']); // Menampilkan halaman form edit kompetensi Ajax
    Route::put('/{id}/update_ajax', [KompetensiController::class, 'update_ajax']); // Menyimpan perubahan data kompetensi Ajax
    Route::get('/{id}/delete_ajax', [KompetensiController::class, 'confirm_ajax']); // Untuk tampilkan form konfirmasi delete kompetensi Ajax
    Route::delete('/{id}/delete_ajax', [KompetensiController::class, 'delete_ajax']); // Untuk hapus data kompetensi Ajax
    Route::delete('/{id}', [KompetensiController::class, 'destroy']); // Menghapus data kompetensi
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // Menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); // Menampilkan data user dalam bentuk JSON untuk datatables
    Route::get('/create', [UserController::class, 'create']); // Menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']); // Menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::get('/import', [UserController::class, 'import']); // Ajax form upload excel untuk user
    Route::post('/import_ajax', [UserController::class, 'import_ajax']); // Ajax import excel user
    Route::get('/export_excel', [UserController::class, 'export_excel']); // Export excel user
    Route::get('/export_pdf', [UserController::class, 'export_pdf']); // Export pdf user
    Route::get('/{id}', [UserController::class, 'show']); // Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // Menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); // Menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form konfirmasi delete user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); // Menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']); // Menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']); // Menampilkan data level dalam bentuk JSON untuk datatables
    Route::get('/create', [LevelController::class, 'create']); // Menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']); // Menyimpan data level baru
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level Ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data level baru Ajax
    Route::get('/import', [LevelController::class, 'import']); // Ajax form upload excel untuk level
    Route::post('/import_ajax', [LevelController::class, 'import_ajax']); // Ajax import excel level
    Route::get('/export_excel', [LevelController::class, 'export_excel']); // Export excel level
    Route::get('/export_pdf', [LevelController::class, 'export_pdf']); // Export pdf level
    Route::get('/{id}', [LevelController::class, 'show']); // Menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']); // Menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']); // Menyimpan perubahan data level
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk tampilkan form konfirmasi delete level Ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk hapus data level Ajax
    Route::delete('/{id}', [LevelController::class, 'destroy']); // Menghapus data level
});

Route::group(['prefix' => 'bidang_minat'], function () {
    Route::get('/', [BidangMinatController::class, 'index']); // Menampilkan halaman awal bidang minat
    Route::post('/list', [BidangMinatController::class, 'list']); // Menampilkan data bidang minat dalam bentuk JSON untuk datatables
    Route::get('/create', [BidangMinatController::class, 'create']); // Menampilkan halaman form tambah bidang minat
    Route::post('/', [BidangMinatController::class, 'store']); // Menyimpan data bidang minat baru
    Route::get('/create_ajax', [BidangMinatController::class, 'create_ajax']); // Menampilkan halaman form tambah bidang minat Ajax
    Route::post('/ajax', [BidangMinatController::class, 'store_ajax']); // Menyimpan data bidang minat baru Ajax
    Route::get('/import', [BidangMinatController::class, 'import']); // Ajax form upload excel untuk bidang minat
    Route::post('/import_ajax', [BidangMinatController::class, 'import_ajax']); // Ajax import excel bidang minat
    Route::get('/export_excel', [BidangMinatController::class, 'export_excel']); // Export excel bidang minat
    Route::get('/export_pdf', [BidangMinatController::class, 'export_pdf']); // Export pdf bidang minat
    Route::get('/{id}', [BidangMinatController::class, 'show']); // Menampilkan detail bidang minat
    Route::get('/{id}/edit', [BidangMinatController::class, 'edit']); // Menampilkan halaman form edit bidang minat
    Route::put('/{id}', [BidangMinatController::class, 'update']); // Menyimpan perubahan data bidang minat
    Route::get('/{id}/edit_ajax', [BidangMinatController::class, 'edit_ajax']); // Menampilkan halaman form edit bidang minat Ajax
    Route::put('/{id}/update_ajax', [BidangMinatController::class, 'update_ajax']); // Menyimpan perubahan data bidang minat Ajax
    Route::get('/{id}/delete_ajax', [BidangMinatController::class, 'confirm_ajax']); // Untuk tampilkan form konfirmasi delete bidang minat Ajax
    Route::delete('/{id}/delete_ajax', [BidangMinatController::class, 'delete_ajax']); // Untuk hapus data bidang minat Ajax
    Route::delete('/{id}', [BidangMinatController::class, 'destroy']); // Menghapus data bidang minat
});

Route::group(['prefix' => 'matkul'], function () {
    Route::get('/', [MatKulController::class, 'index']); // Menampilkan halaman awal MatKul
    Route::post('/list', [MatKulController::class, 'list']); // Menampilkan data MatKul dalam bentuk json untuk datatables
    Route::get('/create', [MatKulController::class, 'create']); // Menampilkan halaman form tambah MatKul
    Route::post('/', [MatKulController::class, 'store']); // Menyimpan data MatKul baru
    Route::get('/create_ajax', [MatKulController::class, 'create_ajax']); // Menampilkan halaman form tambah MatKul Ajax
    Route::post('/ajax', [MatKulController::class, 'store_ajax']); // Menyimpan data MatKul baru Ajax
    Route::get('/import', [MatKulController::class, 'import']); // Ajax form upload excel untuk MatKul
    Route::post('/import_ajax', [MatKulController::class, 'import_ajax']); // Ajax import excel MatKul
    Route::get('/export_excel', [MatKulController::class, 'export_excel']); // Export excel MatKul
    Route::get('/export_pdf', [MatKulController::class, 'export_pdf']); // Export pdf MatKul
    Route::get('/{id}', [MatKulController::class, 'show']); // Menampilkan detail MatKul
    Route::get('/{id}/edit', [MatKulController::class, 'edit']); // Menampilkan halaman form edit MatKul
    Route::put('/{id}', [MatKulController::class, 'update']); // Menyimpan perubahan data MatKul
    Route::get('/{id}/edit_ajax', [MatKulController::class, 'edit_ajax']); // Menampilkan halaman form edit MatKul Ajax
    Route::put('/{id}/update_ajax', [MatKulController::class, 'update_ajax']); // Menyimpan perubahan data MatKul Ajax
    Route::get('/{id}/delete_ajax', [MatKulController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete MatKul Ajax
    Route::delete('/{id}/delete_ajax', [MatKulController::class, 'delete_ajax']); // Untuk hapus data MatKul Ajax
    Route::delete('/{id}', [MatKulController::class, 'destroy']); // Menghapus data vendor
});

Route::group(['prefix' => 'ajukan_sertifikasi'], function () {
    Route::get('/', [PengajuanSertifikasiController::class, 'index']); // Menampilkan halaman awal Pengajuan Sertifikasi
    Route::post('/list', [PengajuanSertifikasiController::class, 'list']); // Menampilkan data Pengajuan Sertifikasi dalam bentuk json untuk datatables
    Route::get('/create', [PengajuanSertifikasiController::class, 'create']); // Menampilkan halaman form tambah Pengajuan Sertifikasi
    Route::post('/', [PengajuanSertifikasiController::class, 'store']); // Menyimpan data Pengajuan Sertifikasi baru
    Route::get('/create_ajax', [PengajuanSertifikasiController::class, 'create_ajax']); // Menampilkan halaman form tambah Pengajuan Sertifikasi Ajax
    Route::post('/ajax', [PengajuanSertifikasiController::class, 'store_ajax']); // Menyimpan data Pengajuan Sertifikasi baru Ajax
    Route::get('/import', [PengajuanSertifikasiController::class, 'import']); // Ajax form upload excel untuk Pengajuan Sertifikasi
    Route::post('/import_ajax', [PengajuanSertifikasiController::class, 'import_ajax']); // Ajax import excel Pengajuan Sertifikasi
    Route::get('/export_excel', [PengajuanSertifikasiController::class, 'export_excel']); // Export excel Pengajuan Sertifikasi
    Route::get('/export_pdf', [PengajuanSertifikasiController::class, 'export_pdf']); // Export pdf Pengajuan Sertifikasi
    Route::get('/{id}', [PengajuanSertifikasiController::class, 'show']); // Menampilkan detail Pengajuan Sertifikasi
    Route::get('/{id}/edit', [PengajuanSertifikasiController::class, 'edit']); // Menampilkan halaman form edit Pengajuan Sertifikasi
    Route::put('/{id}', [PengajuanSertifikasiController::class, 'update']); // Menyimpan perubahan data Pengajuan Sertifikasi
    Route::get('/{id}/edit_ajax', [PengajuanSertifikasiController::class, 'edit_ajax']); // Menampilkan halaman form edit Pengajuan Sertifikasi Ajax
    Route::put('/{id}/update_ajax', [PengajuanSertifikasiController::class, 'update_ajax']); // Menyimpan perubahan data Pengajuan Sertifikasi Ajax
    Route::get('/{id}/delete_ajax', [PengajuanSertifikasiController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete Pengajuan Sertifikasi Ajax
    Route::delete('/{id}/delete_ajax', [PengajuanSertifikasiController::class, 'delete_ajax']); // Untuk hapus data Pengajuan Sertifikasi Ajax
    Route::delete('/{id}', [PengajuanSertifikasiController::class, 'destroy']); // Menghapus data Pengajuan Sertifikasi
});

Route::group(['prefix' => 'jenis_pelatihan'], function () {
    Route::get('/', [JenisPelatihanController::class, 'index']); // Menampilkan halaman awal jenis pelatihan
    Route::post('/list', [JenisPelatihanController::class, 'list']); // Menampilkan data jenis pelatihan dalam bentuk JSON untuk datatables
    Route::get('/create', [JenisPelatihanController::class, 'create']); // Menampilkan halaman form tambah jenis pelatihan
    Route::post('/', [JenisPelatihanController::class, 'store']); // Menyimpan data jenis pelatihan baru
    Route::get('/create_ajax', [JenisPelatihanController::class, 'create_ajax']); // Menampilkan halaman form tambah jenis pelatihan Ajax
    Route::post('/ajax', [JenisPelatihanController::class, 'store_ajax']); // Menyimpan data jenis pelatihan baru Ajax
    Route::get('/import', [JenisPelatihanController::class, 'import']); // Ajax form upload excel untuk jenis pelatihan
    Route::post('/import_ajax', [JenisPelatihanController::class, 'import_ajax']); // Ajax import excel jenis pelatihan
    Route::get('/export_excel', [JenisPelatihanController::class, 'export_excel']); // Export excel jenis pelatihan
    Route::get('/export_pdf', [JenisPelatihanController::class, 'export_pdf']); // Export pdf jenis pelatihan
    Route::get('/{id}', [JenisPelatihanController::class, 'show']); // Menampilkan detail jenis pelatihan
    Route::get('/{id}/edit', [JenisPelatihanController::class, 'edit']); // Menampilkan halaman form edit jenis pelatihan
    Route::put('/{id}', [JenisPelatihanController::class, 'update']); // Menyimpan perubahan data jenis pelatihan
    Route::get('/{id}/edit_ajax', [JenisPelatihanController::class, 'edit_ajax']); // Menampilkan halaman form edit jenis pelatihan Ajax
    Route::put('/{id}/update_ajax', [JenisPelatihanController::class, 'update_ajax']); // Menyimpan perubahan data jenis pelatihan Ajax
    Route::get('/{id}/delete_ajax', [JenisPelatihanController::class, 'confirm_ajax']); // Untuk tampilkan form konfirmasi delete jenis pelatihan Ajax
    Route::delete('/{id}/delete_ajax', [JenisPelatihanController::class, 'delete_ajax']); // Untuk hapus data jenis pelatihan Ajax
    Route::delete('/{id}', [JenisPelatihanController::class, 'destroy']); // Menghapus data jenis pelatihan
});

Route::group(['prefix' => 'periode'], function () {
    Route::get('/', [PeriodeController::class, 'index']); // Menampilkan halaman awal periode
    Route::post('/list', [PeriodeController::class, 'list']); // Menampilkan data periode dalam bentuk json untuk datatables
    Route::get('/create', [PeriodeController::class, 'create']); // Menampilkan halaman form tambah periode
    Route::post('/', [PeriodeController::class, 'store']); // Menyimpan data periode baru
    Route::get('/create_ajax', [PeriodeController::class, 'create_ajax']); // Menampilkan halaman form tambah periode Ajax
    Route::post('/ajax', [PeriodeController::class, 'store_ajax']); // Menyimpan data periode baru Ajax
    Route::get('/import', [PeriodeController::class, 'import']); // Ajax form upload excel untuk periode
    Route::post('/import_ajax', [PeriodeController::class, 'import_ajax']); // Ajax import excel periode
    Route::get('/export_excel', [PeriodeController::class, 'export_excel']); // Export excel periode
    Route::get('/export_pdf', [PeriodeController::class, 'export_pdf']); // Export pdf periode
    Route::get('/{id}', [PeriodeController::class, 'show']); // Menampilkan detail periode
    Route::get('/{id}/edit', [PeriodeController::class, 'edit']); // Menampilkan halaman form edit periode
    Route::put('/{id}', [PeriodeController::class, 'update']); // Menyimpan perubahan data periode
    Route::get('/{id}/edit_ajax', [PeriodeController::class, 'edit_ajax']); // Menampilkan halaman form edit periode Ajax
    Route::put('/{id}/update_ajax', [PeriodeController::class, 'update_ajax']); // Menyimpan perubahan data periode Ajax
    Route::get('/{id}/delete_ajax', [PeriodeController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete periode Ajax
    Route::delete('/{id}/delete_ajax', [PeriodeController::class, 'delete_ajax']); // Untuk hapus data periode Ajax
    Route::delete('/{id}', [PeriodeController::class, 'destroy']); // Menghapus data periode
});

