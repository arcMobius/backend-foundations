<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('/galery/{img}', [MainController::class, 'galery'])->name('galery');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    $data = [
        'email' => 'student@mospolytech.com',
        'телефон' => '+7 (999) 000-11-22',
        'адрес' => 'г. Москва, ул. Большая Семеновская, д. 1'
    ];
    return view('contacts', ['contactData' => $data]);
})->name('contacts');