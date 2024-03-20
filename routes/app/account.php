<?php

use App\Http\Controllers\Account\ArtikelController;
use App\Http\Controllers\Account\FaqController;
use App\Http\Controllers\Account\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'account',
    'as'         => 'account.',
    'middleware' => ['auth', 'verified'],
], function () {
    //ARTIKEL
    Route::resource('/artikel', ArtikelController::class)->except('show');
    //index_kategori
    Route::get('/artikel/kategori', [ArtikelController::class, 'index_kategori'])->name('kategori.index');
    //store_kategori
    Route::post('/artikel/kategori/store', [ArtikelController::class, 'store_kategori'])->name('kategori.store');

    //index_tag
    Route::get('/artikel/tag', [ArtikelController::class, 'index_tag'])->name('tag.index');
    //store_tag
    Route::post('/artikel/tag/store', [ArtikelController::class, 'store_tag'])->name('tag.store');

    //index_komentar
    Route::get('/artikel/komentar', [ArtikelController::class, 'index_komentar'])->name('komentar.index');

    //FAQ
    Route::resource('/faq', FaqController::class)->except('show');
    //index_kategori_faq
    Route::get('/faq/kategori', [FaqController::class, 'index_kategori_faq'])->name('kategori.faq.index');

    //USER
    Route::resource('/user', UserController::class)->except('show');
});
