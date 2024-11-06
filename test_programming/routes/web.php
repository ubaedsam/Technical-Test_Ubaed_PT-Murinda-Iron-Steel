<?php

use App\Http\Controllers\COA\COAController;
use App\Http\Controllers\CYY\CurrencyController;
use App\Http\Controllers\JURNAL\JurnalController;
use App\Http\Controllers\TRANSAKSI\TransaksiController;
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

Route::get('/', function () {
    return view('welcome');
});

// Master Jurnal
Route::get('master_jurnal', [JurnalController::class, 'index']);
Route::get('/datajurnal', [JurnalController::class, 'data'])->name('datajurnal');
Route::post('/tambahjurnal', [JurnalController::class, 'store'])->name('tambahjurnal');
Route::put('/ambiljurnal/{jrcode}', [JurnalController::class, 'ambiljurnal'])->name('ambiljurnal');
Route::put('/prosesubahjurnal/{jrcode}', [JurnalController::class, 'ubahjurnal'])->name('ubahjurnal');
Route::get('/hapusjurnal/{jrcode}', [JurnalController::class, 'delete']);

// Master Currency (CYY)
Route::get('master_currency', [CurrencyController::class, 'index']);
Route::get('/datacurrency', [CurrencyController::class, 'data'])->name('datacurrency');
Route::post('/tambahcurrency', [CurrencyController::class, 'store'])->name('tambahcurrency');
Route::put('/ambilcurrency/{mis_ccy}', [CurrencyController::class, 'ambilcurrency'])->name('ambilcurrency');
Route::put('/prosesubahcurrency/{mis_ccy}', [CurrencyController::class, 'ubahcurrency'])->name('ubahcurrency');
Route::get('/hapuscurrency/{mis_ccy}', [CurrencyController::class, 'delete']);

// Master COA
Route::get('master_coa', [COAController::class, 'index']);
Route::get('/datacoa', [COAController::class, 'data'])->name('datacoa');
Route::post('/tambahcoa', [COAController::class, 'store'])->name('tambahcoa');
Route::put('/ambilcoa/{mis_kodeacc}', [COAController::class, 'ambilcoa'])->name('ambilcoa');
Route::put('/prosesubahcoa/{mis_kodeacc}', [COAController::class, 'ubahcoa'])->name('ubahcoa');
Route::get('/hapuscoa/{mis_kodeacc}', [COAController::class, 'delete']);
Route::get('/ambil_coa_terakhir', [COAController::class, 'load_coa']);

// Master Transaksi
Route::get('/ambil_jurnal_baru', [JurnalController::class, 'load_jurnal']);
Route::get('/ambil_coa_baru', [TransaksiController::class, 'load_coa']);
Route::get('/datatransaksi', [TransaksiController::class, 'data'])->name('datatransaksi');
Route::post('/tambahtransaksi', [TransaksiController::class, 'store'])->name('tambahtransaksi');
Route::put('/ambiltransaksi/{id}', [TransaksiController::class, 'ambiltransaksi'])->name('ambiltransaksi');
Route::put('/prosesubahtransaksi/{id}', [TransaksiController::class, 'ubahtransaksi'])->name('ubahtransaksi');
Route::get('/hapustransaksi/{id}', [TransaksiController::class, 'delete']);

Route::get('/downloadPDF_Transaksi/{id}', [TransaksiController::class, 'downloadPDFTransaksi'])->name('downloadPDFTransaksi');
