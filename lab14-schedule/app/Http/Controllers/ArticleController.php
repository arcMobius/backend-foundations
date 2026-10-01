<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\VeryLongJob;
use App\Events\NewArticleEvent;
use App\Notifications\NewArticleNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware(): array
    {
        return [
            new \Illuminate\Routing\Controllers\Middleware(\App\Http\Middleware\LogArticleView::class, only: ['show']),
        ];
    }

    public function index()
    {
        $page = request()->get('page', 1);
        
        $articles = Cache::remember('articles_page_' . $page, 60, function () {
            return Article::latest()->paginate(5);
        });

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'date' => 'required|string',
            'shortDesc' => 'nullable|string',
            'desc' => 'required|string'
        ]);

        $article = Article::create($validated);

        VeryLongJob::dispatch($article);

        event(new NewArticleEvent($article));
        
        $readers = User::where('id', '!=', auth()->id())->get();
        Notification::send($readers, new NewArticleNotification($article));

        for ($i = 1; $i <= 100; $i++) {
            Cache::forget('articles_page_' . $i);
        }

        return redirect()->route('home');
    }

    public function show(Article $article)
    {
        $approvedComments = Cache::rememberForever('article_comments_' . $article->id, function () use ($article) {
            return $article->comments()->where('is_approved', true)->with('user')->latest()->get();
        });

        return view('articles.show', compact('article', 'approvedComments'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        Cache::flush();
        
        $validated = $request->validate([
            'name' => 'required|string',
            'date' => 'required|string',
            'shortDesc' => 'nullable|string',
            'desc' => 'required|string'
        ]);

        $article->update($validated);
        
        return redirect()->route('home');
    }

    public function destroy(Article $article)
    {
        Cache::flush();
        
        $article->delete();
        
        return redirect()->route('home');
    }
}