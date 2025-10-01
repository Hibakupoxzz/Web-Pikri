<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::get('/logout', [AuthController::class,'logout']);

Route::middleware('auth')->group(function() {

    // Route untuk admin
    Route::get('/admin', [AdminController::class,'index']);
    Route::resource('/sparepart', SparepartController::class);
    Route::resource('/users', UserController::class);

    // Route untuk user
    Route::get('/user', [TransaksiController::class,'index']);
    Route::post('/beli/{id}', [TransaksiController::class,'beli'])->name('beli');
    Route::get('/riwayat', [TransaksiController::class,'riwayat'])->name('user.transaksi');

    // Route cart - TAMBAHKAN INI
    Route::get('/cart', [CartController::class,'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class,'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class,'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class,'destroy'])->name('cart.destroy');
    Route::post('/cart/checkout', [CartController::class,'checkout'])->name('cart.checkout');
});
