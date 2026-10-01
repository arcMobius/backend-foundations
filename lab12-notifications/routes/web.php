<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

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
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/moderation/comments', [CommentController::class, 'index'])->name('moderation.comments');
    Route::post('/moderation/comments/{comment}/approve', [CommentController::class, 'approve'])->name('moderation.comments.approve');
    Route::delete('/moderation/comments/{comment}', [CommentController::class, 'destroy'])->name('moderation.comments.destroy');
});


// ЛР12: Отметка уведомления как прочитанного и переход к просмотру статьи
Route::get('/notifications/{id}/read', function ($id) {
    if (auth()->check()) {
        $notification = auth()->user()->unreadNotifications->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            $articleId = $notification->data['article_id'] ?? null;
            if ($articleId) {
                if (\Illuminate\Support\Facades\Route::has('articles.show')) {
                    return redirect()->route('articles.show', $articleId);
                }
                return redirect('/articles/' . $articleId);
            }
        }
    }
    return redirect('/');
})->name('notifications.read');