@extends('layouts.main')

@section('content')
    <div style="text-align: center; margin-top: 1.5rem;">
        <h1>Просмотр изображения</h1>
        <p><a href="{{ route('home') }}" style="text-decoration: none; color: #0066cc;">&larr; Вернуться к списку статей</a></p>
        
        <div style="margin-top: 2rem;">
            <img src="{{ asset($image) }}" alt="Full size" style="max-width: 90%; max-height: 75vh; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.25);">
        </div>
    </div>
@endsection