@extends('layouts.main')

@section('content')
    <h1>Список статей и новостей</h1>

    <style>
        .articles-table { width: 100%; border-collapse: collapse; margin-top: 1.5rem; }
        .articles-table th, .articles-table td { border: 1px solid #ddd; padding: 12px; text-align: left; vertical-align: top; }
        .articles-table th { background-color: #f4f4f4; }
        .preview-img { max-width: 140px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.15); transition: transform 0.2s; }
        .preview-img:hover { transform: scale(1.05); }
    </style>

    <table class="articles-table">
        <thead>
            <tr>
                <th style="width: 100px;">Дата</th>
                <th style="width: 160px;">Превью</th>
                <th>Заголовок и описание</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
                <tr>
                    <td>{{ $article->date ?? '—' }}</td>
                    <td>
                        <a href="{{ route('galery', ['img' => $article->full_image]) }}" title="Нажмите для открытия">
                            <img src="{{ asset($article->preview_image) }}" alt="{{ $article->name }}" class="preview-img">
                        </a>
                    </td>
                    <td>
                        <h3>{{ $article->name }}</h3>
                        @if($article->shortDesc)
                            <p><strong>{{ $article->shortDesc }}</strong></p>
                        @endif
                        <p>{{ $article->desc }}</p>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Статьи не найдены.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
