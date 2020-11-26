<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PostController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('post.index', 'en');
})->name('dashboard');

Route::group(['prefix' => 'areas'], function(){
    Route::get('/{lang}', [AreaController::class, 'index'])->name('area.index');
    Route::get('create/{lang}', [AreaController::class, 'create'])->name('area.create');
    Route::post('store/{lang}', [AreaController::class, 'store'])->name('area.store');
    Route::get('edit/{area}/{lang}', [AreaController::class, 'edit'])->name('area.edit');
    Route::put('update/{area}/{lang}', [AreaController::class, 'update'])->name('area.update');
    Route::delete('delete/{area}/{lang}', [AreaController::class, 'destroy'])->name('area.destroy');
    Route::get('show/{area}/{lang}', [AreaController::class, 'show'])->name('area.show');
    Route::get('pdf/{area}/{lang}', [AreaController::class, 'pdf'])->name('area.pdf');
});
 
Route::group(['prefix' => 'posts'], function(){
    Route::get('/{lang}', [PostController::class, 'index'])->name('post.index');
    Route::get('create/{lang}', [PostController::class, 'create'])->name('post.create');
    Route::post('store/{lang}', [PostController::class, 'store'])->name('post.store');
    Route::get('edit/{post}/{lang}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('update/{post}/{lang}', [PostController::class, 'update'])->name('post.update');
    Route::delete('delete/{post}/{lang}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('show/{post}/{lang}', [PostController::class, 'show'])->name('post.show');
    Route::get('pdf/{post}/{lang}', [PostController::class, 'pdf'])->name('post.pdf');
});