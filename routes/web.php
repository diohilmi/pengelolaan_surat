<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LetterCodeController;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\SenderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\DisposisiUserController;
use App\Http\Controllers\DonwloadFController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
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

Route::get('/', [LoginController::class, 'index']);

// Authentication
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('download', [DonwloadFController::class, 'download'])->name('download-format');
Route::get('/showpdf/{filename}', [DisposisiUserController::class, 'show_pdf'])->name('show-pdf');
Route::get('/showpdf-surat-keluar/{filename}', [OutgoingController::class, 'show_pdf'])->name('show-pdf-surat-keluar');

Route::resource('setting', SettingController::class, [
    'except' => [ 'show' ]
]);
Route::get('setting/password',[SettingController::class, 'change_password'])->name('change-password');
Route::post('setting/upload-profile', [SettingController::class, 'upload_profile'])->name('profile-upload');
Route::post('change-password', [SettingController::class, 'update_password'])->name('update.password');

Route::post('/laporan-get', [LetterController::class, 'get_laporan'])->name('get-laporan');
Route::get('print/disposisi-surat/{id}', [PrintController::class, 'disposisi'])->name('print-disposisi-surat');

//Pegawai Unit
Route::group(['middleware' => ['auth', 'checkRole: 2']], function () {
    Route::resource('/outgoing', OutgoingController::class);
    Route::resource('/disposisi-user', DisposisiUserController::class);
    Route::get('/disposisi-user-pegawai_unit', [DisposisiUserController::class, 'index_pegawai_unit'])->name('disposisi-user-pegawai_unit');
});

//Direktur
Route::group(['middleware' => ['auth', 'checkRole: 3']], function () {

    Route::get('/laporan-direktur', [LetterController::class, 'show_laporan'])->name('show-laporan-direktur');
    // Route::post('/laporan-get-direktur', [LetterController::class, 'get_laporan'])->name('get-laporan-direktur');

    Route::resource('/outgoing', OutgoingController::class);
    Route::get('/outgoing/konfirmasi/{id}', [OutgoingController::class, 'konfirmasi'])->name('outgoing-konfirmasi');
    Route::get('/disposisi-user-direktur', [DisposisiUserController::class, 'index_direktur'])->name('disposisi-user-direktur');
});

Route::group(['middleware' => ['auth', 'checkRole: 1,2,3']], function () {
    Route::resource('/disposisi-user', DisposisiUserController::class);
    Route::resource('/outgoing', OutgoingController::class);
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
});


Route::group(['middleware' => ['auth', 'checkRole:1']], function () {

    Route::resource('/kode-surat', LetterCodeController::class);
    Route::resource('/disposisi', DisposisiController::class);
    // Route::resource('/disposisi-user', DisposisiUserController::class);
    Route::get('/laporan', [LetterController::class, 'show_laporan'])->name('show-laporan');
    Route::resource('/letter', LetterController::class, [
        'except' => [ 'show' ]
    ]);

    Route::get('import-surat', [ImportController::class, 'index'])->name('import-surat');
    Route::post('import-surat/create', [ImportController::class, 'create'])->name('simpan-surat');
    Route::post('import-surat/store', [ImportController::class, 'store'])->name('store-surat');

    Route::get('letter/surat-masuk', [LetterController::class, 'incoming_mail'])->name('surat-masuk');
    Route::post('letter/tambah-masuk', [LetterController::class, 'add'])->name('add-surat');
    Route::get('letter/surat-keluar', [LetterController::class, 'outgoing_mail'])->name('surat-keluar');
    Route::get('letter/delete-file/{id}', [LetterController::class, 'delete_file'])->name('delete-file');

    Route::get('letter/surat/{id}', [LetterController::class, 'show'])->name('detail-surat');
    Route::get('letter/download/{id}', [LetterController::class, 'download_letter'])->name('download-surat');

    //print
    Route::get('print/surat-masuk', [PrintController::class, 'index'])->name('print-surat-masuk');
    Route::get('print/surat-keluar', [PrintController::class, 'outgoing'])->name('print-surat-keluar');

    Route::resource('user', UserController::class);
});

