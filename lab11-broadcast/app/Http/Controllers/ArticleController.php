<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Jobs\VeryLongJob;
use App\Events\NewArticleEvent;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $approvedComments =$article->comments()->where('is_approved', true)->with('user')->latest()->get();
        return view('articles.show', compact('article', 'approvedComments'));
    }

    public function create()
    {
        // $this->authorize('create', Article::class);
        return view('articles.create');
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Article::class);
        $validated =$request->validate([
            'name' => 'required|string',
            'date' => 'required|string', 
            'shortDesc' => 'nullable|string',
            'desc' => 'required|string'
        ]);
        
        $article = Article::create($validated);

        VeryLongJob::dispatch($article);
        
        event(new NewArticleEvent($article));

        return redirect()->route('home');
    }

    public function edit(Article $article)
    {
        $this->authorize('update',$article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article$article)
    {
        $this->authorize('update',$article);
        $validated =$request->validate([
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
        $this->authorize('delete', $article);$article->delete();
        return redirect()->route('home');
    }
}
