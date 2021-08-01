<?php

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

Route::get('/', function () {
    //return view('welcome');
    return redirect('upload');
});


Route::get('/upload', App\Http\Controllers\UploadController::class);
Route::post('/import/old', [App\Http\Controllers\ImportController::class, 'old'])->name('import.old');
Route::post('/import/new', [App\Http\Controllers\ImportController::class, 'new'])->name('import.new');

Route::get('/compare', [App\Http\Controllers\CompareController::class, 'index'])->name('compare');
Route::get('/compare/download', [App\Http\Controllers\CompareController::class, 'download'])->name('compare.download');

Route::resource('options', App\Http\Controllers\OptionController::class);

Route::delete('/clean', App\Http\Controllers\CleanController::class)->name('clean');
