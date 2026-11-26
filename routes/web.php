<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Admin\Gallery;
use App\Livewire\Admin\Links;
use App\Livewire\Admin\Sponsors;
use App\Livewire\Admin\Team;
use App\Livewire\Admin\Users;
use App\Livewire\Auth\Login;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPage::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', Links::class)->name('links');
        Route::get('/galeria', Gallery::class)->name('gallery');
        Route::get('/equipe', Team::class)->name('team');
        Route::get('/patrocinadores', Sponsors::class)->name('sponsors');
        Route::get('/administradores', Users::class)->name('users');
    });
});
