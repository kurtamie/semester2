<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\Mahasiswa;
use App\Models\SuratSurvey;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RiwayatController;

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

// Route::get('/', function () {
//   return view('login.view_login');
// });

// Route::get('login', [LoginController::class, 'index'])
//     ->name('login');



Route::get('/', [LayoutController::class, 'index'])->middleware('auth');
Route::get('/home', [LayoutController::class, 'index'])->middleware('auth')->name('home');

Route::controller(LoginController::class)->group(function(){
    Route::get('login', 'index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout')->name('logout');
    Route::get('/register', 'register')->name('register');
    Route::post('/register/create', 'create')->name('create');
});

Route::group(['middleware'=>['auth']], function(){
    Route::group(['middleware' => ['cekUserLogin: admin']], function(){
        Route::resource('admin',Admin::class);
    });

    Route::group(['middleware' => ['cekUserLogin: mahasiswa']], function(){
        Route::resource('mahasiswa',Mahasiswa::class);
    });
});

// Route::get('/letter/add', [LetterController::class, 'create'])->name('letter/create');
// Route::POST('/letter/add', [LetterController::class, 'store'])->name('letter/store');

// Route Letter Controller
Route::controller(LetterController::class)->group(function(){
    Route::get('/letter/add', 'create')->name('letter/create');
    Route::POST('/letter/add', 'store')->name('letter/store');
    Route::get('/letter/{id_surat_izin}', 'show')->name('letter/show');
});

// Route Survey Controller
Route::controller(SurveyController::class)->group(function(){
    Route::get('/survey/add', 'create')->name('survey/create');
    Route::POST('/survey/add', 'store')->name('survey/store');
    Route::get('/survey/{id_surat_survey}', 'show')->name('survey/show');
});

Route::get('/pengajuan/{id_user}', [PengajuanController::class, 'show'])
    ->name('pengajuan');

Route::get('/surat-izin/edit/{id_surat_izin}', [PengajuanController::class, 'edit'])
    ->name('surat-izin.edit');

Route::put('/surat-izin/update/{id_surat_izin}', [PengajuanController::class, 'update'])
    ->name('surat-izin.update');

Route::get('/riwayat/{id_user}', [RiwayatController::class, 'show'])->name('riwayat');

// ROUTE BUTTON TERIMA DAN TOLAK
Route::post('/terima/{id_surat_izin}', [AdminController::class, 'accept'])->name('terima');
Route::post('/tolak/{id_surat_izin}', [AdminController::class, 'reject'])->name('tolak');

Route::get('/tabel_izin', [AdminController::class, 'tabel_izin'])
    ->name('tabel_izin');

Route::get('/tabel_survey', [AdminController::class, 'tabel_survey'])
    ->name('tabel_survey');

Route::post('/reject/{id_surat_survey}', [AdminController::class, 'tolak'])
    ->name('reject');

Route::post('/upload/{id_surat_survey}', [AdminController::class, 'upload'])
    ->name('upload');

Route::post('/survey/download/{id_surat_survey}', [SurveyController::class, 'download'])
    ->name('survey/download');
