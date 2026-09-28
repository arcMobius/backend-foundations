<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/galery/{img}', [MainController::class, 'galery'])->name('galery');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contacts', function () {
    $data = ['email' => 'student@university.com', 'телефон' => '+7 (999) 000-11-22', 'адрес' => 'г. Москва, ул. Студенческая, д. 1'];
    return view('contacts', ['contactData' => $data]);
})->name('contacts');

Route::middleware('guest')->group(function () {
    Route::get('/signup', [AuthController::class, 'create'])->name('signup');
    Route::post('/signup', [AuthController::class, 'store'])->name('signup.post');
    Route::get('/signin', [AuthController::class, 'login'])->name('login');
    Route::post('/signin', [AuthController::class, 'authenticate'])->name('login.post');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('articles', ArticleController::class)->except(['index', 'show']);
});
