<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №9</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; min-height: 100vh; }
        header { background-color: #333; color: white; padding: 1rem; }
        header nav { display: flex; align-items: center; }
        header nav a { color: white; margin-right: 15px; text-decoration: none; }
        main { flex: 1; padding: 20px; }
        footer { background-color: #eee; padding: 1rem; text-align: center; }
        .pagination { display: flex; list-style: none; padding: 0; gap: 5px; margin-top: 20px; justify-content: center; }
        .page-item .page-link { padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; color: #333; border-radius: 4px; background: #fff;}
        .page-item.active .page-link { background: #333; color: white; border-color: #333; }
        .page-item.disabled .page-link { color: #aaa; background: #f9f9f9; cursor: not-allowed; pointer-events: none;}
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('about') }}">О нас</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <div style="margin-left: auto; display: flex; align-items: center; gap: 15px;">
                @auth
                    @if(Auth::user()->role && Auth::user()->role->name === 'moderator')
                        <a href="{{ route('moderation.comments') }}" style="color: #ffcc00; font-weight: bold;">Модерация комментариев</a>
                    @endif
                    <span style="color: #28a745; font-weight: bold;">Привет, {{ Auth::user()->name }}!</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="background: transparent; color: #ffcc00; border: none; font-weight: bold; cursor: pointer; padding: 0; font-size: 16px;">Выход</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="color: #ffcc00; font-weight: bold;">Вход</a>
                    <a href="{{ route('signup') }}" style="color: #ffcc00; font-weight: bold;">Регистрация</a>
                @endauth
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>Выполнил: Усачев Максим Викторович, Группа: 251-3210</p>
    </footer>
</body>
</html>
