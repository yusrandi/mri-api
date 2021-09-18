<?php

use App\Http\Controllers\api\AbsensiController;
use App\Http\Controllers\api\KategoriController as ApiKategoriController;
use App\Http\Controllers\api\ProdukController;
use App\Http\Controllers\api\PegawaiController;
use App\Http\Controllers\api\PengeluaranController;
use App\Http\Controllers\api\StokController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/kategoris', [ApiKategoriController::class, 'index']);
Route::post('/kategoris', [ApiKategoriController::class, 'store']);
Route::put('/kategoris/{id}', [ApiKategoriController::class, 'update']);
Route::delete('/kategoris/{id}', [ApiKategoriController::class, 'destroy']);

Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);
Route::post('/produk', [ProdukController::class, 'store']);
Route::put('/produk/{id}', [ProdukController::class, 'update']);
Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);

Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::post('/pegawai', [PegawaiController::class, 'store']);
Route::put('/pegawai/{id}', [PegawaiController::class, 'update']);
Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy']);

Route::get('/stok', [StokController::class, 'index']);
Route::post('/stok', [StokController::class, 'store']);
Route::put('/stok/{id}', [StokController::class, 'update']);
Route::delete('/stok/{id}', [StokController::class, 'destroy']);

Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
Route::post('/pengeluaran', [PengeluaranController::class, 'store']);
Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update']);
Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy']);

Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::post('/transaksi/bydate', [TransaksiController::class, 'indexByDate']);

Route::get('/absensi', [AbsensiController::class, 'index']);
Route::post('/absensi', [AbsensiController::class, 'store']);

Route::post('/login', [UserController::class, 'login']);