<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/{any}', function () {
//     return view('form');
// })->where('any', '.*');

Route::get('/', function () {
    return view('form');
});
Route::get('/about', function () {
    return view('form');
});
Route::get('/representative', function () {
    return view('form');
});
Route::get('/contact', function () {
    return view('form');
});
Route::get('/budget', function () {
    return view('form');
});
Route::get('/checkout', function () {
    return view('form');
});
Route::get('/client-login', function () {
    return view('form');
});

Route::resource('/product', App\Http\Controllers\ProductController::class);
Route::resource('/category', App\Http\Controllers\ProductCategoryController::class);
Route::resource('/subcategory', App\Http\Controllers\ProductSubCategoryController::class);
Route::resource('/budget', App\Http\Controllers\BudgetController::class);
Route::get('/client/get-by-cnpj', [App\Http\Controllers\ClientController::class, 'getClientByCnpj']);

// Route::get('product', function () {
//     return view('form');
// });
Route::get('product/category/{category}', function () {
    return view('form');
});
Route::get('product/{id}/detail', function () {
    return view('form');
});
Route::get('product/category/{category}/sub/{sub}', function () {
    return view('form');
});

Route::post('/send-email', [App\Http\Controllers\EmailController::class, 'sendEmail']);

Auth::routes();
