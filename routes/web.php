<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/homepage', function () {
    return view('homepage');
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
