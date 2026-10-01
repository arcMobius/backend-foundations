@extends('layouts.main')

@section('content')
    <article style="max-width: 800px; margin: 0 auto;">
        <p style="color: #666;">{{ $article->date }}</p>
        <h1>{{ $article->name }}</h1>
        @if($article->shortDesc)
            <p style="font-size: 1.1em; font-weight: bold;">{{ $article->shortDesc }}</p>
        @endif
        <div style="margin: 20px 0;">
            <img src="{{ asset($article->full_image) }}" style="max-width: 100%; border-radius: 4px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        </div>
        <div style="line-height: 1.6;">
            {!! nl2br(e($article->desc)) !!}
        </div>

        <hr style="margin: 40px 0;">

        <h3>Комментарии</h3>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @auth
            <form action="{{ route('comments.store', $article->id) }}" method="POST" style="margin-bottom: 30px; display: flex; flex-direction: column; gap: 10px;">
                @csrf
                <textarea name="body" placeholder="Оставьте ваш комментарий..." style="width: 100%; padding: 10px; min-height: 80px; border-radius: 4px; border: 1px solid #ccc;" required></textarea>
                <button type="submit" style="align-self: flex-start; padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Отправить</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.</p>
        @endauth

        <div style="display: flex; flex-direction: column; gap: 15px;">
            @forelse($approvedComments as $comment)
                <div style="background: #f9f9f9; padding: 15px; border-radius: 4px; border: 1px solid #eee;">
                    <strong>{{ $comment->user?->name ?? "Пользователь" }}</strong> <span style="color: #888; font-size: 0.9em;">({{ $comment->created_at->format('d.m.Y H:i') }})</span>
                    <p style="margin-top: 5px;">{{ $comment->body }}</p>
                </div>
            @empty
                <p>Пока нет одобренных комментариев.</p>
            @endforelse
        </div>

        <div style="margin-top: 30px;">
            <a href="{{ route('home') }}" style="color: #007bff; text-decoration: none;">&larr; На главную</a>
        </div>
    </article>
@endsection
