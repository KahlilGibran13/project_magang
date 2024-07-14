<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PutusanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonografiController;
use App\Http\Controllers\PeraturanController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LinkTerkaitController;
use App\Http\Controllers\TentangJDIHController;
use App\Http\Controllers\Verifikasi;
use App\Http\Controllers\VerifikasiInfografis;
use App\Http\Controllers\VerifikasiLinkTerkait;
use App\Http\Controllers\VerifikasiTentangJDIH;

Route::resource('posts', PostController::class);



#####
// Route::get('/dashboard', function () {
//     return view('users.index');
// });
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('tentang');
// Route::get('/', [DashboardController::class, 'index'])->name('tentang');

// Route::get('/putusan', function () {
//     return view('putusan.index');
// });

Route::get('/', [LandingPageController::class, 'beranda'])->name('beranda');
Route::post('/survey/store', [LandingPageController::class, 'storeSurvey'])->name('survey.store');
Route::get('/fp/tentangkami/landasan', [LandingPageController::class, 'landasan'])->name('fp-landasan');
Route::get('/fp/tentangkami/visimisi', [LandingPageController::class, 'visiMisi'])->name('fp-visimisi');
Route::get('/fp/tentangkami/strukturorganisasi', [LandingPageController::class, 'strukturOrganisasi'])->name('fp-strukturorganisasi');
Route::get('/fp/tentangkami/sop', [LandingPageController::class, 'sop'])->name('fp-sop');
Route::get('/fp/peraturan', [LandingPageController::class, 'dokumenHukumAllPeraturan'])->name('fp-dokumenhukum-all-peraturan');
Route::get('/fp/dokumenhukum/peraturan/{id}', [LandingPageController::class, 'dokumenHukumPeraturan'])->name('fp-dokumenhukum-peraturan');
Route::get('/fp/dokumenhukum/peraturan/detail/{id}', [LandingPageController::class, 'dokumenHukumPeraturanDetail'])->name('fp-dokumenhukum-peraturan-detail');
Route::get('/fp/dokumenhukum/putusan/', [LandingPageController::class, 'dokumenHukumPutusan'])->name('fp-dokumenhukum-putusan');
Route::get('/fp/dokumenhukum/putusan/detail/{id}', [LandingPageController::class, 'dokumenHukumPutusanDetail'])->name('fp-dokumenhukum-putusan-detail');
Route::get('/fp/dokumenhukum/monografi/', [LandingPageController::class, 'dokumenHukumMonografi'])->name('fp-dokumenhukum-monografi');
Route::get('/fp/dokumenhukum/monografi/detail/{id}', [LandingPageController::class, 'dokumenHukumMonografiDetail'])->name('fp-dokumenhukum-monografi-detail');
Route::get('/fp/dokumenhukum/artikel/', [LandingPageController::class, 'dokumenHukumArtikel'])->name('fp-dokumenhukum-artikel');
Route::get('/fp/dokumenhukum/artikel/detail/{id}', [LandingPageController::class, 'dokumenHukumArtikelDetail'])->name('fp-dokumenhukum-artikel-detail');

Route::middleware('guest')->group(function () {

    Route::get('/masuk', function () {
        return view('login.masuk');
    })->name('login');

    Route::post('/masuk', [AuthController::class, 'authentication']);

    // Route::get('/login', function () {
    //     return view('login.masuk');
    // });

    Route::get('/daftar', function () {
        return view('login.daftar');
    })->name('register');

    Route::post('/daftar', [AuthController::class, 'register']);

    // Route::get('logout', function () {
    //     return view('login.masuk');
    // });

    // Route::get('/home', function () {
    //     return view('layouts.master');
    // });
    ## DASHBOARD UPLOAD IMAGE

});

Route::middleware('auth')->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/upload-image', [DashboardController::class, 'uploadImage'])->name('upload-image');

    ### sidebar ###
    Route::get('/tentang', [TentangJDIHController::class, 'index'])->name('tentang');
    Route::get('/add-tentang', [TentangJDIHController::class, 'create'])->name('add-tentang');
    Route::post('/store-tentang', [TentangJDIHController::class, 'store'])->name('store-tentang');
    Route::put('/update-tentang/{id}', [TentangJDIHController::class, 'update'])->name('update-tentang/{id}');
    Route::post('/send-verifikasi-tentang', [VerifikasiTentangJDIH::class, 'send'])->name('tentang.verifikasi.send');
    Route::post('/tarik-verifikasi-tentang', [VerifikasiTentangJDIH::class, 'tarik'])->name('tentang.verifikasi.tarik');
    Route::get('/verifikasi-tentang', [VerifikasiTentangJDIH::class, 'viewVerifikasi'])->name('tentang.verifikasi.index');
    Route::post('/verifikasi-tentang', [VerifikasiTentangJDIH::class, 'storeVerifikasi']);
    // Route::get('/edit-tentang/{id}', [TentangJDIHController::class, 'edit'])->name('edit-tentang/{id}');

    Route::get('/peraturan', [PeraturanController::class, 'index'])->name('peraturan');
    Route::get('/add-peraturan', [PeraturanController::class, 'create'])->name('add-peraturan');
    Route::post('/store-peraturan', [PeraturanController::class, 'store'])->name('store-peraturan');
    Route::get('/edit-peraturan/{id}', [PeraturanController::class, 'edit'])->name('edit-peraturan/{id}');
    Route::put('/update-peraturan/{id}', [PeraturanController::class, 'update'])->name('update-peraturan/{id}');
    Route::get('/pdf/{filename}', [PeraturanController::class, 'showPDF'])->name('pdf-peraturan');
    Route::delete('/peraturan/{id}', [PeraturanController::class, 'destroy'])->name('peraturan.destroy');
    Route::get('/detail-peraturan/{id}', [PeraturanController::class, 'detailPeraturan'])->name('peraturan.detail');
    Route::get('/verifikasi-peraturan', [PeraturanController::class, 'viewVerifikasi'])->name('verifikasi.peraturan.index');

    Route::post('/verifikasi-send', [Verifikasi::class, 'sendVerifikasi'])->name('verifikasi.send');
    Route::post('/verifikasi-tarik', [Verifikasi::class, 'tarikVerifikasi'])->name('verifikasi.tarik');
    Route::get('/verifikasi', [Verifikasi::class, 'viewVerifikasi'])->name('verifikasi.index');
    Route::get('/verifikasi/{id}', [Verifikasi::class, 'verifikasi'])->name('verifikasi.verifikasi');
    Route::post('/verifikasi-store', [Verifikasi::class, 'storeVerifikasi'])->name('verifikasi.verifikasi.store');

    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
    Route::get('/add-artikel', [ArtikelController::class, 'create'])->name('add-artikel');
    Route::post('/store-artikel', [ArtikelController::class, 'store'])->name('store-artikel');
    Route::get('/edit-artikel/{id}', [ArtikelController::class, 'edit'])->name('edit-artikel');
    Route::put('/update-artikel/{id}', [ArtikelController::class, 'update'])->name('update-artikel/{id}');
    Route::get('/pdf/{filename}', [ArtikelController::class, 'showPDF'])->name('pdf-artikel');
    Route::delete('/delete-artikel/{id}', [ArtikelController::class, 'destroy'])->name('delete-artikel');
    Route::get('/detail-artikel/{id}', [ArtikelController::class, 'detail'])->name('artikel.detail');
    Route::get('/verifikasi-artikel', [ArtikelController::class, 'viewVerifikasi'])->name('verifikasi.artikel.index');

    Route::get('/infografis', [InfografisController::class, 'index'])->name('infografis');
    Route::get('/add-infografis', [InfografisController::class, 'create'])->name('add-infografis');
    Route::post('/store-infografis', [InfografisController::class, 'store'])->name('store-infografis');
    Route::get('/edit-infografis/{id}', [InfografisController::class, 'edit'])->name('edit-infografis/{id}');
    Route::put('/update-infografis/{id}', [InfografisController::class, 'update'])->name('update-infografis/{id}');
    Route::delete('/infografis/{id}', [InfografisController::class, 'destroy'])->name('infografis.destroy');

    Route::get('/detail-infografis/{id}', [InfografisController::class, 'detail'])->name('infografis.detail');
    Route::post('/send-verifikasi-infografis', [VerifikasiInfografis::class, 'send'])->name('infografis.verifikasi.send');
    Route::post('/tarik-verifikasi-infografis', [VerifikasiInfografis::class, 'tarik'])->name('infografis.verifikasi.tarik');
    Route::get('/verifikasi-infografis', [VerifikasiInfografis::class, 'viewVerifikasi'])->name('infografis.verifikasi.index');
    Route::get('/verifikasi-infografis/{id}', [VerifikasiInfografis::class, 'verifikasi'])->name('infografis.verifikasi.verifikasi');
    Route::post('/verifikasi-infografis', [VerifikasiInfografis::class, 'storeVerifikasi']);

    Route::get('/monografi', [MonografiController::class, 'index'])->name('monografi');
    Route::get('/add-monografi', [MonografiController::class, 'create'])->name('add-monografi');
    Route::post('/store-monografi', [MonografiController::class, 'store'])->name('store-monografi');
    Route::get('/edit-monografi/{id}', [MonografiController::class, 'edit'])->name('edit-monografi');
    Route::put('/update-monografi/{id}', [MonografiController::class, 'update'])->name('update-monografi');
    Route::delete('/delete-monografi/{id}', [MonografiController::class, 'destroy'])->name('delete-monografi');
    Route::get('/detail-monografi/{id}', [MonografiController::class, 'detail'])->name('monografi.detail');
    Route::get('/verifikasi-monografi', [MonografiController::class, 'viewVerifikasi'])->name('verifikasi.monografi.index');

    Route::get('/putusan', [PutusanController::class, 'index'])->name('putusan');
    Route::get('/add-putusan', [PutusanController::class, 'create'])->name('add-putusan');
    Route::post('/store-putusan', [PutusanController::class, 'store'])->name('store-putusan');
    Route::get('/edit-putusan/{id}', [PutusanController::class, 'edit'])->name('putusan.edit');
    Route::put('/update-putusan/{id}', [PutusanController::class, 'update'])->name('update-putusan/{id}');
    Route::get('/pdf/{filename}', [PutusanController::class, 'showPDF'])->name('pdf.view');
    Route::delete('/delete-putusan/{id}', [PutusanController::class, 'destroy'])->name('putusan.destroy');
    Route::get('/detail-putusan/{id}', [PutusanController::class, 'detail'])->name('putusan.detail');
    Route::get('/verifikasi-putusan', [PutusanController::class, 'viewVerifikasi'])->name('verifikasi.putusan.index');

    Route::get('/linkterkait', [LinkTerkaitController::class, 'index'])->name('linkterkait');
    Route::get('/add-linkterkait', [LinkTerkaitController::class, 'create'])->name('add-linkterkait');
    Route::post('/store-linkterkait', [LinkTerkaitController::class, 'store'])->name('store-linkterkait');
    Route::get('/edit-linkterkait/{id}', [LinkTerkaitController::class, 'edit'])->name('edit-linkterkait/{id}');
    Route::put('/update-linkterkait/{id}', [LinkTerkaitController::class, 'update'])->name('update-linkterkait/{id}');
    Route::delete('/linkterkait/{id}', [LinkTerkaitController::class, 'destroy'])->name('linkterkait.destroy');
    Route::get('/detail-linkterkait/{id}', [LinkTerkaitController::class, 'detail'])->name('linkterkait.detail');
    Route::post('/send-verifikasi-link', [VerifikasiLinkTerkait::class, 'send'])->name('link.verifikasi.send');
    Route::post('/tarik-verifikasi-link', [VerifikasiLinkTerkait::class, 'tarik'])->name('link.verifikasi.tarik');
    Route::get('/verifikasi-link', [VerifikasiLinkTerkait::class, 'viewVerifikasi'])->name('link.verifikasi.index');
    Route::get('/verifikasi-link/{id}', [VerifikasiLinkTerkait::class, 'verifikasi'])->name('link.verifikasi.verifikasi');
    Route::post('/verifikasi-link', [VerifikasiLinkTerkait::class, 'storeVerifikasi']);





    // Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    // Route::post('login', [AuthController::class, 'login']);






    ### add ###

    Route::get('/add_jurnal', function () {
        return view('add.add_jurnal');
    });

    Route::get('/add_putusan', function () {
        return view('add.add_putusan');
    });

    Route::get('/add_monografi', function () {
        return view('add.add_monografi');
    });

    Route::get('/add_peraturan', function () {
        return view('add.add_peraturan');
    });
});
