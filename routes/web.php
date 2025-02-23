<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', function () {
    return view('dashboard'); 
})->name('login');

Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

Route::get('/new-watch', function () {
    return view('watches/create'); 
})->name('new-watch');