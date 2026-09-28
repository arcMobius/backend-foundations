<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Article;
use App\Policies\ArticlePolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::policy(Article::class, ArticlePolicy::class);

        Gate::before(function (User $user, string $ability) {
            if ($user->role && $user->role->name === 'moderator') {
                return true;
            }
        });
    }
}
