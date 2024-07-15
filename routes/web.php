<?php

use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\LowonganPekerjaanController;
use App\Http\Controllers\PemberiKerjaController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\InstgramAuthController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // tambahkan ini
use App\Mail\SendEmail; // tambahkan ini

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

// LOGIN
// Auth::routes();

// LOGIN PEMBERI KERJA
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Auth::routes(['verify' => true ]);

// Route::get('/mail/send', function () {
//     $data = [
//         'subject' => 'Testing Kirim Email',
//         'title' => 'Testing Kirim Email',
//         'body' => 'Ini adalah email uji coba dari Tutorial Laravel: Send Email Via SMTP GMAIL @ qadrLabs.com'
//     ];

//     Mail::to('ekiakmarullah.sbg@gmail.com')->send(new SendEmail($data));

// });




// LOGIN ADMIN
Route::get('admin/login', [AdminAuthController::class, 'getLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'postLogin']);
Route::post('/admin/logout', function () {
    auth()->guard('admin')->logout();
    session()->flush();
    return redirect()->route('admin.login');
})->name('admin.logout');

Route::middleware('auth')->group(function() {

});

Route::middleware('auth:admin')->group(function(){
    // Tulis routemu di sini.
    Route::get('admin/dashboard', [DashboardController::class, 'indexAdmin'])->name('dashboard.admin');

    Route::get('admin/dashboard/status', [StatusController::class, 'index'])->name('dashboard.admin.status');

    Route::get('admin/dashboard/status/activate/{id}', [StatusController::class, 'activateStatus'])->name('status');

    // PEMBERI KERJA
    Route::get('/dashboard/pemberi-kerja/data', [PemberiKerjaController::class, 'getDataPemberiKerja'])->name('pemberi_kerja.data');

    Route::get('/dashboard/pemberi-kerja', [PemberiKerjaController::class, 'index'])->name('pemberi_kerja');

    Route::get('/dashboard/pemberi-kerja/tambah', [PemberiKerjaController::class, 'create'])->name('tambah_pemberi_kerja');

    Route::get('/dashboard/pemberi-kerja/{slug}/edit', [PemberiKerjaController::class, 'edit'])->name('pemberi_kerja.edit');

    Route::post('/dashboard/pemberi-kerja/update/{id}', [PemberiKerjaController::class, 'update']);

    Route::delete('/dashboard/pemberi-kerja/delete/{id}',[PemberiKerjaController::class, 'delete'])->name("pemberi_kerja.delete");

    Route::post('/dashboard/pemberi-kerja/store', [PemberiKerjaController::class, 'store'])->middleware('auth');
  });


// DASHBOARD ROUTE

// LOWONGAN PEKERJAAN ROUTE

Route::get('/dashboard/lowongan-pekerjaan', [LowonganPekerjaanController::class, 'index'])->name('lowongan_pekerjaan')->middleware('auth');

Route::get('/dashboard/lowongan-pekerjaan/data', [LowonganPekerjaanController::class, 'getDataLowonganPekerjaan'])->name('lowongan_pekerjaan.data')->middleware('auth');

Route::get('/dashboard/lowongan-pekerjaan/tambah', [LowonganPekerjaanController::class, 'create'])->name('lowongan_pekerjaan.tambah')->middleware('auth');

Route::post('/dashboard/lowongan-pekerjaan/store', [LowonganPekerjaanController::class, 'store'])->name('lowongan_pekerjaan.store')->middleware('auth');

Route::get('/dashboard/lowongan-pekerjaan/{slug}/edit', [LowonganPekerjaanController::class, 'edit'])->name('lowongan_pekerjaan.edit')->middleware('auth');

Route::post('/dashboard/lowongan-pekerjaan/update/{id}', [LowonganPekerjaanController::class, 'update'])->name('lowongan_pekerjaan.update')->middleware('auth');

Route::delete('/dashboard/lowongan-pekerjaan/delete/{id}',[LowonganPekerjaanController::class, 'delete'])->name("lowongan_pekerjaan.delete")->middleware('auth');

// PEMBERI KERJA



// LOKASI ROUTE
Route::get('/dashboard/lokasi', [LokasiController::class, 'index'])->name('lokasi.index')->middleware('auth');

Route::get('/dashboard/lokasi/data', [LokasiController::class, 'getDataLokasi'])->name('lokasi.data')->middleware('auth');

Route::get('/dashboard/lokasi/create', [LokasiController::class, 'create'])->name('lokasi.create')->middleware('auth');

Route::post('/dashboard/lokasi/store', [LokasiController::class, 'store'])->name('lokasi.store')->middleware('auth');

Route::get('/dashboard/lokasi/{slug}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit')->middleware('auth');

Route::post('/dashboard/lokasi/update/{id}', [LokasiController::class, 'update'])->name('lokasi.update')->middleware('auth');

Route::delete('/dashboard/lokasi/delete/{id}', [LokasiController::class, 'delete'])->name('lokasi.delete')->middleware('auth');

// KATEGORI ROUTE
Route::get('/dashboard/kategori', [KategoriController::class, 'index'])->name('kategori.index')->middleware('auth');

Route::get('/dashboard/kategori/data', [KategoriController::class, 'getDataTipePekerjaan'])->name('kategori.data')->middleware('auth');

Route::get('/dashboard/kategori/create', [KategoriController::class, 'create'])->name('kategori.create')->middleware('auth');

Route::post('/dashboard/kategori/store', [KategoriController::class, 'store'])->name('kategori.store')->middleware('auth');

Route::get('/dashboard/kategori/{slug}/edit', [KategoriController::class, 'edit'])->name('kategori.edit')->middleware('auth');

Route::post('/dashboard/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update')->middleware('auth');

Route::delete('/dashboard/kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete')->middleware('auth');


// ADMIN ROUTE
Route::get('/dashboard/profil-admin', [ProfilAdminController::class, 'create'])->name('profil_admin.create')->middleware('auth');

Route::post('/dashboard/profil-admin/store', [ProfilAdminController::class, 'store'])->name('profil_admin.store')->middleware('auth');

// FRONTEND ROUTE
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('cari', [HomeController::class, 'cari'])->name('home.cari');

Route::get('/pekerjaan', [HomeController::class, 'pekerjaan'])->name('home.pekerjaan');

Route::get('pekerjaan/detail/{slug}', [HomeController::class, 'show'])->name('home.show');

Route::get('kategori', [HomeController::class, 'kategori'])->name('home.kategori');

Route::get('pekerjaan/kategori/{id}', [HomeController::class, 'pekerjaanByKategori'])->name('home.pekerjaan.kategori');


