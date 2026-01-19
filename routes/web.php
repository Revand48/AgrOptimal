<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PupukController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\SimulasiController;

use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\PupukAdminController;
use App\Http\Controllers\Admin\BeritaAdminController;
use App\Http\Controllers\Admin\CekTanahAdminController;
use App\Http\Controllers\Admin\EduTipsBibitController;
use App\Http\Controllers\Admin\EduTipsLahanController;
use App\Http\Controllers\Admin\WilayahAdminController;
use App\Http\Controllers\Admin\SimulasiAdminController;
use App\Http\Controllers\Admin\KomoditasAdminController;
use App\Http\Controllers\Admin\PublikasiAdminController;
use App\Http\Controllers\Admin\EduTipsPemupukanController;
use App\Http\Controllers\Admin\EduTipsIrigasiController;

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index']);
Route::post('/pengaduan', [HomeController::class, 'kirimPengaduan'])
    ->name('pengaduan.kirim');

Route::get('/profile', fn () => view('users.profile'));
Route::get('/datapupuk', [PupukController::class, 'index'])->name('pupuk.index');

Route::controller(EdukasiController::class)->prefix('users/edukasi_budidaya')->group(function () {
    Route::get('/tips_bibit', 'tipsBibit')->name('edukasi.bibit');
    Route::get('/tips_lahan', 'tipsLahan')->name('edukasi.lahan');
    Route::get('/tips_pemupukan', 'tipsPemupukan')->name('edukasi.pemupukan');
    Route::get('/cek_tanah', 'tipsCekTanah')->name('edukasi.cek_tanah');
    Route::get('/irigasi', 'tipsIrigasi')->name('edukasi.irigasi');
});
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{berita:slug}', [BeritaController::class, 'show'])->name('berita.show');

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN - AUTH
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\LoginAdminController;

Route::middleware('guest')->group(function () {
    Route::get('/Login-Admin', [LoginAdminController::class, 'index'])->name('login');
    Route::post('/Login-Admin', [LoginAdminController::class, 'store'])->name('admin.login.store');
});

Route::post('/logout', [LoginAdminController::class, 'destroy'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware(['admin'])->group(function () {

    Route::get('/dashboard', fn () => view('dashboard.dashboard'))->name('admin.dashboard');
    
    // EDUKASI BUDIDAYA
    Route::prefix('dashboard/edukasi_budidaya')->name('admin.edukasi.')->group(function () {
        Route::resource('tips_bibit', EduTipsBibitController::class);
        Route::resource('tips_lahan', EduTipsLahanController::class);
        Route::resource('irigasi', EduTipsIrigasiController::class);
        Route::resource('tips_pemupukan', EduTipsPemupukanController::class);
        Route::resource('cek_tanah', CekTanahAdminController::class)->names('cek_tanah');
    });

    // HOME STATISTIK
    Route::get('/dashboard/home-statistik', [HomeAdminController::class, 'index']);
    Route::post('/dashboard/home-statistik', [HomeAdminController::class, 'update']);

    // HOME FAQ
    Route::prefix('dashboard/home-faq')->group(function () {
        Route::get('/', [HomeAdminController::class, 'faqIndex'])->name('admin.faq.index');
        Route::get('/create', [HomeAdminController::class, 'faqCreate'])->name('admin.faq.create');
        Route::post('/', [HomeAdminController::class, 'faqStore'])->name('admin.faq.store');
        Route::get('/{faq}/edit', [HomeAdminController::class, 'faqEdit'])->name('admin.faq.edit');
        Route::put('/{faq}', [HomeAdminController::class, 'faqUpdate'])->name('admin.faq.update');
        Route::delete('/{faq}', [HomeAdminController::class, 'faqDestroy'])->name('admin.faq.destroy');

        Route::post('/{faq}/toggle-aktif', [HomeAdminController::class, 'faqToggleAktif']);
        Route::post('/{faq}/toggle-verifikasi', [HomeAdminController::class, 'faqToggleVerifikasi']);
    });

    // HOME PENGADUAN
    Route::prefix('dashboard/pengaduan')->group(function () {
        Route::get('/', [HomeAdminController::class, 'pengaduanIndex'])
            ->name('admin.pengaduan.index');
        Route::get('/{pengaduan}', [HomeAdminController::class, 'pengaduanShow'])
            ->name('admin.pengaduan.show');
        Route::delete('/{pengaduan}', [HomeAdminController::class, 'pengaduanDestroy'])
            ->name('admin.pengaduan.destroy');
    });

    // DATA PUPUK - PUBLIKASI
    Route::prefix('dashboard/data_pupuk/publikasi')->name('admin.publikasi.')->group(function () {
        Route::get('/', [PublikasiAdminController::class, 'index'])->name('index');
        Route::get('/create', [PublikasiAdminController::class, 'create'])->name('create');
        Route::post('/', [PublikasiAdminController::class, 'store'])->name('store');
        Route::get('/{publikasi}/edit', [PublikasiAdminController::class, 'edit'])->name('edit');
        Route::put('/{publikasi}', [PublikasiAdminController::class, 'update'])->name('update');
        Route::delete('/{publikasi}', [PublikasiAdminController::class, 'destroy'])->name('destroy');
    });

    // DATA PUPUK
    Route::prefix('dashboard/data_pupuk/pupuk')->name('admin.')->group(function () {
        Route::get('/', [PupukAdminController::class, 'index'])->name('pupuk.index');
        Route::get('/create', [PupukAdminController::class, 'create'])->name('pupuk.create');
        Route::post('/', [PupukAdminController::class, 'store'])->name('pupuk.store');
        Route::get('/{pupuk}/edit', [PupukAdminController::class, 'edit'])->name('pupuk.edit');
        Route::put('/{pupuk}', [PupukAdminController::class, 'update'])->name('pupuk.update');
        Route::delete('/{pupuk}', [PupukAdminController::class, 'destroy'])->name('pupuk.destroy');
    });

    // DATA WILAYAH
    Route::prefix('dashboard/data_pupuk/wilayah')->name('admin.')->group(function () {
        Route::get('/', [WilayahAdminController::class, 'index'])->name('wilayah.index');

        Route::get('/kecamatan/create', [WilayahAdminController::class, 'createKecamatan'])->name('wilayah.kecamatan.create');
        Route::post('/kecamatan', [WilayahAdminController::class, 'storeKecamatan'])->name('wilayah.kecamatan.store');
        Route::get('/kecamatan/{kecamatan}/edit', [WilayahAdminController::class, 'editKecamatan'])->name('wilayah.kecamatan.edit');
        Route::put('/kecamatan/{kecamatan}', [WilayahAdminController::class, 'updateKecamatan'])->name('wilayah.kecamatan.update');
        Route::delete('/kecamatan/{kecamatan}', [WilayahAdminController::class, 'destroyKecamatan'])->name('wilayah.kecamatan.destroy');

        Route::get('/desa/create', [WilayahAdminController::class, 'createDesa'])->name('wilayah.desa.create');
        Route::post('/desa', [WilayahAdminController::class, 'storeDesa'])->name('wilayah.desa.store');
        Route::get('/desa/{desa}/edit', [WilayahAdminController::class, 'editDesa'])->name('wilayah.desa.edit');
        Route::put('/desa/{desa}', [WilayahAdminController::class, 'updateDesa'])->name('wilayah.desa.update');
        Route::delete('/desa/{desa}', [WilayahAdminController::class, 'destroyDesa'])->name('wilayah.desa.destroy');
    });

    // BERITA
    Route::resource('dashboard/berita', BeritaAdminController::class)->names('admin.berita');

    // KOMODITAS
    Route::resource('dashboard/komoditas', KomoditasAdminController::class)->parameters([
        'komoditas' => 'komoditas',
    ])->names('admin.komoditas');

    // SIMULASI
    Route::prefix('dashboard/simulasi')->name('admin.simulasi.')->group(function () {
        Route::get('/', [SimulasiAdminController::class, 'index'])->name('index');
        Route::post('/', [SimulasiAdminController::class, 'store'])->name('store');
        Route::delete('/{simulasi}', [SimulasiAdminController::class, 'destroy'])->name('destroy');
    });
});

Route::controller(SimulasiController::class)->group(function () {
    Route::get('/simulasi', 'index')->name('simulasi.index');
    Route::post('/simulasi/calculate', 'calculate')->name('simulasi.calculate');
    Route::post('/simulasi/analyze', 'analyze')->name('simulasi.analyze');
});
