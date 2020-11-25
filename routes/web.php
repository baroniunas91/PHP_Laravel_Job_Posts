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
    return redirect()->route('post.index');
})->name('dashboard');

Route::group(['prefix' => 'areas'], function(){
    Route::get('', [AreaController::class, 'index'])->name('area.index');
    Route::get('create', [AreaController::class, 'create'])->name('area.create');
    Route::post('store', [AreaController::class, 'store'])->name('area.store');
    Route::get('edit/{area}', [AreaController::class, 'edit'])->name('area.edit');
    Route::post('update/{area}', [AreaController::class, 'update'])->name('area.update');
    Route::post('delete/{area}', [AreaController::class, 'destroy'])->name('area.destroy');
    Route::get('show/{area}', [AreaController::class, 'show'])->name('area.show');
    Route::get('pdf/{area}', [AreaController::class, 'pdf'])->name('area.pdf');
});
 
Route::group(['prefix' => 'posts'], function(){
    Route::get('', [PostController::class, 'index'])->name('post.index');
    Route::get('create', [PostController::class, 'create'])->name('post.create');
    Route::post('store', [PostController::class, 'store'])->name('post.store');
    Route::get('edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('update/{post}', [PostController::class, 'update'])->name('post.update');
    Route::post('delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('show/{post}', [PostController::class, 'show'])->name('post.show');
    Route::get('pdf/{post}', [PostController::class, 'pdf'])->name('post.pdf');
});