@extends('layouts.main')
@section('content')
<style> input, textarea { border: 1px solid #ced4da !important; padding: 8px !important; border-radius: 4px !important; width: 100% !important; box-sizing: border-box !important; margin-top: 5px !important; margin-bottom: 15px !important; } button[type="submit"] { background-color: #198754 !important; color: white !important; padding: 10px 20px !important; border: none !important; border-radius: 4px !important; cursor: pointer !important; } </style>
    <h2>Добавление новой статьи</h2>
    @if ($errors->any())
        <div style="background: #ffdddd; color: #d8000c; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            <ul style="margin: 0; padding: 0; list-style-type: none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('articles.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem; max-width: 600px;">
        @csrf
        <label>Заголовок:<br><input type="text" name="name" style="width: 100%; padding: 8px;" required></label>
        <label>Дата:<br><input type="text" name="date" value="{{ date('d.m.Y') }}" style="width: 100%; padding: 8px;" required></label>
        <label>Краткое описание:<br><textarea name="shortDesc" style="width: 100%; padding: 8px; min-height: 60px;"></textarea></label>
        <label>Полное описание:<br><textarea name="desc" style="width: 100%; padding: 8px; min-height: 120px;" required></textarea></label>
        <button type="submit" style="padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">Сохранить</button>
    </form>
@endsection
