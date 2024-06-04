<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

//routes sebelum autentikasi
Route::get('/', function(){
    return view('welcome', ['menu' => 'home']);
});
Route::get('/about-us', function(){
    return view('about-us', ['menu' => 'tentang-kami']);
});
Route::get('/registrasi', function(){
    return view('registrasi', ['menu' => 'registrasi']);
});
Route::post('/registrasi', [AuthController::class, 'registrasi']);
Route::get('/login', function(){
    return view('login', ['menu' => 'login']);
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

//route untuk admin
Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/manage-user', [AdminController::class, 'list_user']);
    Route::get('/admin/manage-user/add', function(){
        return view('admin.add-user', ['menu' => 'datauser']);
    });
    Route::post('/admin/manage-user/add', [AdminController::class, 'add_user']);
    Route::delete('/admin/manage-user/delete/{id}', [AdminController::class, 'delete_user']);
    Route::put('/admin/manage-user/edit/{id}', [AdminController::class, 'update_user']);

    Route::get('/logout-admin', [AuthController::class, 'logout']);
});

//routes untuk pegawai
Route::group(['middleware' => 'role:pegawai'], function () {

});

//routes untuk pemilik
Route::group(['middleware' => 'role:pemilik'], function () {

});

//routes untuk pelanggan
Route::group(['middleware' => 'role:pelanggan'], function () {
    Route::get('/pelanggan', function(){
        return view('pelanggan.index');
    });

    Route::get('/logout-pelanggan', [AuthController::class, 'logout']);
});
