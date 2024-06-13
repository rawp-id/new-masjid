<?php

use App\Controllers\Api\DetailKeuanganController;
use App\Controllers\Api\JamaahController;
use App\Controllers\Api\KegiatanController;
use App\Controllers\Api\KeuanganMasjidController;
use App\Controllers\Api\ManageMasjidController;
use App\Controllers\Api\MasjidController;
use App\Controllers\Api\TabunganController;
use App\Controllers\Api\UserController;
use App\Controllers\Api\ZakatController;
use App\Controllers\MasjidPageController;
use App\Controllers\UndanganController;
use App\Middleware\AuthApiMiddleware;
use App\Middleware\AuthMiddleware;
use Core\Route;

// Route::get('/masjid', function () {
//     return view('views.index');
// });

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/pendaftaran-masjid', function () {
//     return view('dashboard.form-masjid');
// });

// user api route
Route::post('/api/login', [UserController::class, 'login']);
Route::get('/api/user/check', [UserController::class, 'check']);
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/logout', [UserController::class, 'logout']);


Route::group(['middleware' => AuthMiddleware::class], function () {

    Route::get('/undangan', [UndanganController::class, 'generateUndangan']);
    Route::get('/undangan/delete/{id}', [UndanganController::class, 'destroy']);

    Route::get('/home', function () {
        return view('dashboard.home');
    });

    Route::get('/pendaftaran-masjid', function () {
        return view('dashboard.form-masjid');
    });

    Route::get('/manage-masjid', function () {
        return view('dashboard.manage-masjid');
    });

    // Route::get('/masjid/{id}', [MasjidPageController::class, 'show']);
    Route::get('/masjid', [MasjidPageController::class, 'show']);
    Route::get('/jamaah/delete', [MasjidPageController::class, 'hapusJamaah']);
    Route::get('/hak-akses', [MasjidPageController::class, 'hakAkses']);
    Route::get('/tabungan/delete', [MasjidPageController::class, 'hapusTabungan']);
    Route::post('/jamaah/update/{id}', [MasjidPageController::class, 'updateJamaah']);
});


Route::group(['middleware' => AuthApiMiddleware::class], function () {

    // api route
    Route::post('/api/detail-keuangan/{id}', [DetailKeuanganController::class, 'update']);
    Route::resource('/api/masjid', MasjidController::class);
    Route::resource('/api/tabungan', TabunganController::class);
    Route::resource('/api/jamaah', JamaahController::class);
    Route::resource('/api/kegiatan', KegiatanController::class);
    Route::resource('/api/keuangan-masjid', KeuanganMasjidController::class);
    Route::resource('/api/manage-masjid', ManageMasjidController::class);
    Route::resource('/api/detail-keuangan', DetailKeuanganController::class);
    Route::resource('/api/zakat', ZakatController::class);
});