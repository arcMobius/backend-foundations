<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('home', compact('articles'));
    }

    public function galery($img)
    {
        return view('galery', ['image' => $img]);
    }
}
