<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

require __DIR__.'/auth.php';

Route::get('/todo-list', [TodoController::class, 'index'])->middleware('auth');
Route::post('/create', [TodoController::class, 'store']);
Route::post('/update', [TodoController::class, 'update']);
Route::post('/delete', [TodoController::class, 'destroy']);
Route::get('/find', [TodoController::class, 'find']);
Route::post('/find', [TodoController::class, 'search']);
Route::post('/find/update', [TodoController::class, 'findUpdate']);
Route::post('/find/delete', [TodoController::class, 'findDestroy']);