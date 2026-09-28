<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $jsonPath = public_path('articles.json');
        
        if (file_exists($jsonPath)) {
            $articles = json_decode(file_get_contents($jsonPath), true);
        } else {
            $articles = [];
        }

        return view('home', compact('articles'));
    }

    public function galery($img)
    {
        return view('galery', ['image' => $img]);
    }
}