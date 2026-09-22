<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {

    $data = [
        'email' => 'student@university.com',
        'телефон' => '+7 (999) 000-11-22',
        'адрес' => 'г. Москва, ул. Студенческая, д. 1'
    ];
    
    return view('contacts', ['contactData' => $data]);
})->name('contacts');