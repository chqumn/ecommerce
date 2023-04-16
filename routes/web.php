<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/add_category', [AdminController::class, 'add_category']);
Route::get('delete_category/{id}', [AdminController::class, 'delete_category']);
Route::get('/new_product', [AdminController::class, 'new_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);
Route::get('/order', [AdminController::class, 'order']);
Route::get('/delivery/{id}', [AdminController::class, 'delivery']);
Route::get('/complete_order/{id}', [AdminController::class, 'complete_order']);
Route::get('/delete_order/{id}', [AdminController::class, 'delete_order']);
Route::get('/search_order', [AdminController::class, 'search_order']);
Route::get('/search_product', [AdminController::class, 'search_product']);
Route::get('/test', [AdminController::class, 'test']);



Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/', [HomeController::class, 'index']);
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/view_cart', [HomeController::class, 'view_cart']);
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/view_order', [HomeController::class, 'view_order']);
Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);
Route::get('/product_page', [HomeController::class, 'product_page']);
Route::get('/product_search', [HomeController::class, 'product_search']);
Route::get('/user_profile', [HomeController::class, 'user_profile']);
