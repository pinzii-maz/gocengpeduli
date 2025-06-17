<?php

use App\Models\transaksi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\statusController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PHPMailerController;
use App\Http\Controllers\TransaksiController;

Route::get('/', [DonationController::class, 'index'])->name('home');
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::post('/checkout', [TransaksiController::class, 'checkout']);
Route::get('/test-email', [PHPMailerController::class, 'kirimNota']);

Route::get('/succes', [statusController::class, 'succes'])->name('payment.succes');
Route::get('/pending', [statusController::class, 'pending'])->name('payment.pending');
Route::get('/failed', [statusController::class, 'failed'])->name('payment.failed');

Route::get('/transaksi/{order_id}', [TransaksiController::class, 'show'])->name('transaksi.show');