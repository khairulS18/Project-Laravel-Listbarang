<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;

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

Route::get('/', [ListController::class, 'index'])->name('view.index');
Route::get('/created', [ListController::class, 'create'])->name('view.created');
Route::post('/created', [ListController::class, 'store'])->name('view.store');
Route::get('/edit/{id}', [ListController::class, 'edit'])->name('view.edit');
Route::put('/edit/{id}', [ListController::class, 'update'])->name('view.update');
Route::delete('/delete/{id}', [ListController::class, 'destroy'])->name('view.destroy');
Route::get('/get-data/{id}', [ListController::class, 'getData'])->name('get.data');
// Route::get('/', function () {
//     return view('welcome');
// });
