@extends('layouts.main')
@section('content')
    <div style="max-width: 500px; margin: 0 auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="text-align: center;">Регистрация</h2>
        @if ($errors->any())
            <div style="background: #ffdddd; color: #d8000c; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                <ul style="margin: 0; padding: 0; list-style-type: none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('signup.post') }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
            @csrf
            <div><label>Имя:</label><br><input type="text" name="name" style="width: 100%; padding: 8px; margin-top: 4px;" required></div>
            <div><label>Email:</label><br><input type="email" name="email" style="width: 100%; padding: 8px; margin-top: 4px;" required></div>
            <div><label>Пароль:</label><br><input type="password" name="password" style="width: 100%; padding: 8px; margin-top: 4px;" required></div>
            <button type="submit" style="padding: 10px; background-color: #333; color: white; border: none; border-radius: 4px; cursor: pointer;">Зарегистрироваться</button>
        </form>
    </div>
@endsection
