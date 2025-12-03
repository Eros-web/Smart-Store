<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LogoutController; // <- tambah ini
use App\Http\Controllers\Barang\barangKeluarController;
use App\Http\Controllers\Barang\barangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\stokController;
use App\Http\Controllers\suplierController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function(){

    Route::get('/', 'login')->name('login');
    Route::post('/', 'login_proses');

});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LogoutController::class, '__invoke'])->name('logout');
});

Route::middleware(['auth', 'cekLevel:superadmin'])->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::controller(pegawaiController::class)->group(function(){
        Route::get('/pegawai', 'index');

        Route::post('/pegawai/add', 'store')->name('add-pegawai');

        Route::get('/pegawai/edit/{id}', 'edit');
        Route::post('/pegawai/edit/{id}', 'update');

        Route::get('/pegawai/delete/{id}', 'destroy');
    });

    Route::controller(suplierController::class)->group(function(){
        Route::get('/suplier', 'index');

        Route::get('/suplier/add', 'create');
        Route::post('/suplier/add', 'store');

        Route::get('suplier/edit/{id}', 'edit');
        Route::post('suplier/edit/{id}', 'update');

        Route::get('/suplier/{id}', 'destroy');

    });

    Route::controller(pelangganController::class)->group(function(){
        Route::get('/pelanggan', 'index');

        Route::get('/pelanggan/add', 'create'); 
        Route::post('/pelanggan/add', 'store');

        Route::get('/pelanggan/edit/{id}', 'edit');
        Route::post('/pelanggan/edit/{id}', 'update');

        Route::get('/pelanggan/{id}', 'destroy');

    });

    Route::controller(stokController::class)->group(function(){
        Route::get('/stok', 'index');

        Route::get('/stok/add', 'create');
        Route::post('/stok/add', 'store');

        Route::get('/stok/edit/{id}', 'edit');
        Route::post('/stok/edit/{id}', 'update'); 

        Route::get('/stok/{id}', 'destroy');

    });


    Route::controller(barangMasukController::class)->group(function(){
        Route::get('/barang-masuk', 'index');
        
        Route::get('/barang-masuk/add', 'create');
        Route::post('/barang-masuk/add', 'store');
        
        Route::get('/barang-masuk/{id}', 'destroy');
        
    });


    Route::controller(barangKeluarController::class)->group(function(){

        Route::get('/barang-keluar', 'index');
        
        Route::get('/barang-keluar/add', 'create');
        Route::post('/barang-keluar/add', 'store');
        
        Route::post('/barang-keluar/save', 'saveProcess')->name('addBarangKeluar');
        
        Route::get('/barang-keluar/{id}', 'destroy');
        
        Route::get('/barang-keluar/print/{id}', 'print');


    });



});
