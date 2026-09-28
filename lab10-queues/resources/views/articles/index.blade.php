@extends('layouts.main')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Лента новостей</h1>
        @can('create', App\Models\Article::class)
            <a href="{{ route('articles.create') }}" style="background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">Добавить новость</a>
        @endcan
    </div>

    <style>
        .articles-table { width: 100%; border-collapse: collapse; margin-top: 1.5rem; }
        .articles-table th, .articles-table td { border: 1px solid #ddd; padding: 12px; text-align: left; vertical-align: top; }
        .articles-table th { background-color: #f4f4f4; }
        .preview-img { max-width: 140px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.15); }
    </style>

    <table class="articles-table">
        <thead>
            <tr>
                <th style="width: 100px;">Дата</th>
                <th style="width: 160px;">Превью</th>
                <th>Заголовок и описание</th>
                @can('create', App\Models\Article::class)
                <th style="width: 150px;">Действия</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
                <tr>
                    <td>{{ $article->date ?? '—' }}</td>
                    <td>
                        <a href="{{ route('galery', ['img' => $article->full_image]) }}">
                            <img src="{{ asset($article->preview_image) }}" class="preview-img">
                        </a>
                    </td>
                    <td>
                        <h3><a href="{{ route('articles.show', $article->id) }}" style="color: #007bff; text-decoration: none;">{{ $article->name }}</a></h3>
                        @if($article->shortDesc)
                            <p><strong>{{ $article->shortDesc }}</strong></p>
                        @endif
                        <p>{{ $article->desc }}</p>
                    </td>
                    @can('update', $article)
                    <td>
                        <div style="display: flex; gap: 5px; flex-direction: column;">
                            <a href="{{ route('articles.edit', $article->id) }}" style="background: #007bff; color: white; padding: 6px; text-align: center; text-decoration: none; border-radius: 4px;">Редактировать</a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Точно удалить?');">
                                @csrf @method('DELETE')
                                <button type="submit" style="width: 100%; background: #dc3545; color: white; border: none; padding: 6px; border-radius: 4px; cursor: pointer;">Удалить</button>
                            </form>
                        </div>
                    </td>
                    @endcan
                </tr>
            @empty
                <tr><td colspan="4">Статьи не найдены.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $articles->links() }}
@endsection
