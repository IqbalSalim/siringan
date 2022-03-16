<?php

use App\Http\Livewire\Arsip\EditArsip;
use App\Http\Livewire\Arsip\IndexArsip;
use App\Http\Livewire\Arsip\ShowArsip;
use App\Http\Livewire\Barang\CreateBarang;
use App\Http\Livewire\Barang\IndexBarang;
use App\Http\Livewire\Barang\UpdateBarang;
use App\Http\Livewire\BuatRab;
use App\Http\Livewire\ShowRab;
use App\Http\Livewire\User\IndexUser;
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

Route::get('buat-rab', BuatRab::class)->name('buat-rab');
Route::get('show-rab', ShowRab::class)->name('show-rab');
Route::get('arsip-rab', IndexArsip::class)->name('arsip-rab');
Route::post('detail-rab', ShowArsip::class)->name('detail-rab');
Route::get('edit-rab/{id}', EditArsip::class)->name('edit-rab');
Route::get('barang', IndexBarang::class)->name('barang');
Route::get('user', IndexUser::class)->name('user');
Route::get('create-barang', CreateBarang::class)->name('create-barang');
Route::post('update-barang', UpdateBarang::class)->name('update-barang');



require __DIR__ . '/auth.php';
