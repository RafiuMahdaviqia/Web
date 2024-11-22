<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\PelatihanController;
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



