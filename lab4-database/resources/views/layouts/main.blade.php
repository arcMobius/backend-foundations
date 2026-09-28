<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №4</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; min-height: 100vh; }
        header { background-color: #333; color: white; padding: 1rem; }
        header nav a { color: white; margin-right: 15px; text-decoration: none; }
        main { flex: 1; padding: 20px; }
        footer { background-color: #eee; padding: 1rem; text-align: center; }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('about') }}">О нас</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <a href="{{ route('signin') }}" style="color: #ffcc00; font-weight: bold;">Регистрация</a>
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
