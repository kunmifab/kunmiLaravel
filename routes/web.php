<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('product', [ProductController::class, 'index']);
Route::get('product/{slug}', [ProductController::class, 'show'])->name('show_product');
Route::get('product/create', [ProductController::class, 'create'])->name('create_product');
Route::post('product', [ProductController::class, 'store'])->name('store_product');
Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('edit_product');
Route::patch('product/{id}', [ProductController::class, 'update'])->name('update_product');
Route::delete('product/{id}',[ProductController::class, 'destroy'])->name('delete_product');

require __DIR__.'/auth.php';
require __DIR__.'/post.php';
require __DIR__.'/category.php';
require __DIR__.'/tag.php';
