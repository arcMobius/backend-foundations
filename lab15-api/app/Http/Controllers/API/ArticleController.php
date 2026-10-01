<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\VeryLongJob;
use App\Events\NewArticleEvent;
use App\Notifications\NewArticleNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('log.view', only: ['show']),
        ];
    }

    public function index()
    {
        $page = request()->get('page', 1);
        $articles = Cache::remember('articles_page_' . $page, 60, function () {
            return Article::latest()->paginate(5);
        });
        return response()->json($articles);
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

        return response()->json(['status' => 'created', 'data' => $article], 201);
    }

    public function show(Article $article)
    {
        $approvedComments = Cache::rememberForever('article_comments_' . $article->id, function () use ($article) {
            return $article->comments()->where('is_approved', true)->with('user')->latest()->get();
        });

        return response()->json([
            'article' => $article,
            'comments' => $approvedComments
        ]);
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
        return response()->json(['status' => 'updated', 'data' => $article]);
    }

    public function destroy(Article $article)
    {
        Cache::flush();
        $article->delete();
        return response()->json(['status' => 'deleted']);
    }
}