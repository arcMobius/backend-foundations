<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

Route::resource('articles', ArticleController::class);
Route::get('/', [ArticleController::class, 'index'])->name('home');

Route::get('/galery/{img}', [MainController::class, 'galery'])->name('galery');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contacts', function () {
    $data = ['email' => 'student@university.com', 'телефон' => '+7 (999) 000-11-22', 'адрес' => 'г. Москва, ул. Студенческая, д. 1'];
    return view('contacts', ['contactData' => $data]);
})->name('contacts');

Route::get('/signin', [AuthController::class, 'create'])->name('signin');
Route::post('/signin', [AuthController::class, 'registration'])->name('signin.post');
