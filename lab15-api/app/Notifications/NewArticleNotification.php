<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewArticleNotification extends Notification
{
    use Queueable;

    public Article $article;

    // Передаем объект статьи в конструктор
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    // Канал уведомлений - база данных
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    // Сохраняем в БД массив с данными о статье
    public function toDatabase(object $notifiable): array
    {
        return [
            'article_id' => $this->article->id,
            'title' => $this->article->title,
        ];
    }
}