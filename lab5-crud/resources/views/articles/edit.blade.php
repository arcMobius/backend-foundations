@extends('layouts.main')

@section('content')
    <h2>Редактирование статьи</h2>

    @if ($errors->any())
        <div style="background: #ffdddd; color: #d8000c; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            <ul style="margin: 0; padding: 0; list-style-type: none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem; max-width: 600px;">
        @csrf
        @method('PUT')
        
        <label>Заголовок:<br>
            <input type="text" name="name" value="{{ old('name', $article->name) }}" style="width: 100%; padding: 8px;" required>
        </label>
        
        <label>Дата:<br>
            <input type="text" name="date" value="{{ old('date', $article->date) }}" style="width: 100%; padding: 8px;" required>
        </label>
        
        <label>Краткое описание:<br>
            <textarea name="shortDesc" style="width: 100%; padding: 8px; min-height: 60px;">{{ old('shortDesc', $article->shortDesc) }}</textarea>
        </label>
        
        <label>Полное описание:<br>
            <textarea name="desc" style="width: 100%; padding: 8px; min-height: 120px;" required>{{ old('desc', $article->desc) }}</textarea>
        </label>

        <button type="submit" style="padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Обновить статью</button>
    </form>
@endsection
