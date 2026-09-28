<?php
namespace App\Policies;
use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\Response;

class ArticlePolicy {
    public function create(User $user) {
        return Response::deny('Доступ запрещен. Только модератор может создавать статьи.');
    }
    public function update(User $user, Article $article) {
        return Response::deny('Доступ запрещен. Только модератор может редактировать статьи.');
    }
    public function delete(User $user, Article $article) {
        return Response::deny('Доступ запрещен. Только модератор может удалять статьи.');
    }
}
