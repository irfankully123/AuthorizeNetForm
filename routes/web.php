<?php

use App\Http\Controllers\AuthorizeController;
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

Route::view('/', 'secure_payment_form');

Route::view('/thankyou', 'thankyou');

Route::view('/error', 'error');

Route::post('/process/payment',[AuthorizeController::class,'create'])
    ->name('process.payment');
