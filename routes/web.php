<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemilikController;
use App\Models\Product;
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
    $best_product = Product::where('display', 'Tampilkan')->withSum('SalesProduct', 'jumlah')
            ->orderBy('sales_product_sum_jumlah', 'desc')
            ->take(4)
            ->get();
    return view('welcome', ['menu' => 'home', 'best_produk' => $best_product]);
});
Route::get('/about-us', [PelangganController::class, 'about_us']);
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
    Route::get('/pegawai/dashboard', [PegawaiController::class, 'dashboard']);
    Route::get('/pegawai/product', [PegawaiController::class, 'index']);
    Route::get('/pegawai/product/add', function(){
        return view('pegawai.add-product', ['menu' => 'produkbibit']);
    });
    Route::post('/pegawai/product/add', [PegawaiController::class, 'store']);
    Route::put('/pegawai/product/update/{id}', [PegawaiController::class, 'update']);
    Route::get('/pegawai/pesanan', [PegawaiController::class, 'pesanan']);
    Route::get('/pegawai/detail-pesanan/{id}', [PegawaiController::class, 'detail_pesanan']);

    Route::put('/pegawai/update-status-pesanan/tanam-bibit/{id}', [PegawaiController::class, 'update_status_tanam_bibit']);
    Route::put('/pegawai/update-status-pesanan/siap-kirim/{id}', [PegawaiController::class, 'update_status_siap_kirim']);
    Route::put('/pegawai/update-status-pesanan/dikirim/{id}', [PegawaiController::class, 'update_status_dikirim']);

    Route::get('/pegawai/monitoring-bibit', [PegawaiController::class, 'index_monitoring']);
    Route::get('/pegawai/monitoring-bibit/detail/{id}', [PegawaiController::class, 'detail_monitoring']);
    Route::post('/add-progress-monitoring/{id}', [PegawaiController::class, 'store_data_monitoring']);
    Route::post('/pegawai/konfirmasi-pembayaran/{id}', [PegawaiController::class, 'payment_confirmation']);

    Route::get('/logout-pegawai', [AuthController::class, 'logout']);
});

//routes untuk pemilik
Route::group(['middleware' => 'role:pemilik'], function () {
    Route::get('/pemilik/dashboard', [PemilikController::class, 'dashboard']);
    Route::get('/pemilik/produk-bibit', [PemilikController::class, 'index']);

    Route::get('/pemilik/product/add', function(){
        return view('pemilik.add-product', ['menu' => 'produkbibit']);
    });
    Route::post('/pemilik/product/add', [PemilikController::class, 'store']);
    Route::put('/pemilik/product/update/{id}', [PemilikController::class, 'update']);

    Route::get('/pemilik/laporan-penjualan', [PemilikController::class, 'laporan'])->name('laporan.penjualan');

    Route::get('/logout-pemilik', [AuthController::class, 'logout']);
});

//routes untuk pelanggan
Route::group(['middleware' => 'role:pelanggan'], function () {
    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::get('/pelanggan/order', [PelangganController::class, 'order']);
    Route::get('/pelanggan/order/{id}', [PelangganController::class, 'detail_product']);
    Route::post('/pelanggan/order', [PelangganController::class, 'store_order']);

    Route::get('/pelanggan/pesanan', [PelangganController::class, 'pesanan_index']);
    Route::get('/pelanggan/detail-order/{id}', [PelangganController::class, 'detail_monitoring']);
    Route::get('/pelanggan/cetak-struk/{order}', [PelangganController::class, 'cetakStruk'])->name('order.cetakStruk');

    Route::post('/pelanggan/upload-bukti/{id}', [PelangganController::class, 'upload_bukti_transfer']);

    Route::get('/logout-pelanggan', [AuthController::class, 'logout']);
});
