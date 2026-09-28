<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Пагинация: 5 записей на страницу
        $articles = Article::latest()->paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'shortDesc' => 'nullable|string',
            'desc' => 'required|string',
        ], [
            'name.required' => 'Заголовок обязателен для заполнения.',
            'date.required' => 'Укажите дату публикации.',
            'desc.required' => 'Полное описание обязательно для заполнения.',
        ]);

        Article::create($validated);
        return redirect()->route('home');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'shortDesc' => 'nullable|string',
            'desc' => 'required|string',
        ], [
            'name.required' => 'Заголовок обязателен для заполнения.',
            'date.required' => 'Укажите дату публикации.',
            'desc.required' => 'Полное описание обязательно для заполнения.',
        ]);

        $article->update($validated);
        return redirect()->route('home');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('home');
    }
}
