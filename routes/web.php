<?php

use App\Http\Livewire\ShowRab;
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
    return view('welcome');
});

Route::get('buat-rab', function () {
    return view('buat-rab');
})->name('buat-rab');

Route::get('show-rab', ShowRab::class)->name('show-rab');

Route::get('arsip-rab', function () {
    return view('arsip-rab');
})->name('arsip-rab');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
