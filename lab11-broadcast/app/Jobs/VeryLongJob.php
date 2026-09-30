<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\User;
use App\Mail\ArticleCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function handle(): void
    {
        $moderator = User::whereHas('role', function($query) {
            $query->where('name', 'moderator');
        })->first();

        if ($moderator) {
            Mail::to($moderator->email)->send(new ArticleCreated($this->article));
        }
    }
}
