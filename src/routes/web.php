<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [ContactController::class, 'contact']);
Route::post('/contact/confirm', [ContactController::class, 'confirm']);
Route::post('/contact/complete', [ContactController::class, 'store']);
Route::get('/thanks', function () {
    return view('thanks');
});
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'admin']);
});
Route::post('/admin/search', [AdminController::class, 'search']);
Route::get('/admin/reset', [AdminController::class, 'reset']);
Route::post('/admin/delete', [AdminController::class, 'destroy']);
Route::post('/admin/export', [AdminController::class, 'export']);
