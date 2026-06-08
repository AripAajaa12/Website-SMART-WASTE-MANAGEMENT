<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/waste-bins', function () {
    return view('waste-bins.index');
});