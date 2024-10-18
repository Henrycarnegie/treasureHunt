<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
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

Route::view('/', 'homepage')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');
});


Route::middleware('auth')->group(function () {
        Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::get('/guru', function () {
    return view('guru.index');
});

Route::get('/guru/dashboard', function () {
    return view('guru.index');
})->name('guru.dashboard');

Route::get('/guru/level1', function () {
    return view('guru.level1');
})->name('guru.level1');

Route::get('/guru/level2', function () {
    return view('guru.level2');
})->name('guru.level2');

Route::get('/guru/level3', function () {
    return view('guru.level3');
})->name('guru.level3');

Route::get('/guru/level4', function () {
    return view('guru.level4');
})->name('guru.level4');

Route::get('/guru/level5', function () {
    return view('guru.level5');
})->name('guru.level5');
