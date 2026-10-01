<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'article_id' => $article->id,
            'user_id' => Auth::id(),
            'body' => $validated['body'],
            'is_approved' => false,
        ]);

        return redirect()->route('articles.show', $article->id)->with('success', 'Комментарий ожидает модерации.');
    }

    public function index()
    {
        $comments = Comment::where('is_approved', false)->with(['article', 'user'])->latest()->paginate(10);
        return view('moderation.comments', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        return redirect()->route('moderation.comments');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('moderation.comments');
    }
}
