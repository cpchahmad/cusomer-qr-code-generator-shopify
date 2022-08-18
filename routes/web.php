<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['verify.shopify']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('syncCustomer', [CustomerController::class, 'customer_sync'])->name('sync_customer');
    Route::get('customer_detail/{id}', [CustomerController::class, 'show'])->name('customer_detail');
    Route::get('activeStatus', [CustomerController::class, 'active']);
    Route::get('InactiveStatus', [CustomerController::class, 'Inactive']);
    Route::get('get/{filename}', [CustomerController::class, 'getFile'])->name('getfile');
});
Route::get('changeStatus', [CustomerController::class, 'status']);

Route::group(['prefix' => 'customer'], function () {
    Route::get('/status/{id}', [CustomerController::class, 'checkStatus']);
});
