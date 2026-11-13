<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BookController::class, 'index'])
    ->name('buku.index');

Route::get('/buku/create', [BookController::class, 'create'])
    ->name('buku.create');

Route::post('/buku', [BookController::class, 'store'])
    ->name('buku.store');

Route::get('/buku/{id}/edit', [BookController::class, 'edit'])
    ->name('buku.edit');

Route::put('/buku/{id}', [BookController::class, 'update'])
    ->name('buku.update');

Route::get('/buku/{id}', [BookController::class, 'show'])
    ->name('buku.show');

Route::delete('/buku/{id}', [BookController::class, 'destroy'])
    ->name('buku.destroy');

Route::resource('kategori', CategoryController::class)
    ->except('show');

// Route penerbit
Route::resource('penerbit', PublisherController::class)
    ->except('show');

Route::resource('penulis', AuthorController::class)
    ->except('show')
    ->parameters(['penulis' => 'penulis']);

