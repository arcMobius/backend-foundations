<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №13</title>
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
    @vite(["resources/css/app.css", "resources/js/app.js"])
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
                        @auth
<div class="dropdown" style="position: relative; display: inline-block; margin-right: 15px;">
    <button type="button" id="notifDropdownBtn" style="background: transparent; color: #fff; border: 1px solid rgba(255,255,255,0.4); border-radius: 4px; padding: 4px 10px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
        <span>🔔 Уведомления</span>
        @if(Auth::user()->unreadNotifications->count() > 0)
            <span style="background-color: #dc3545; color: white; border-radius: 10px; padding: 1px 7px; font-size: 11px; font-weight: bold;">
                {{ Auth::user()->unreadNotifications->count() }}
            </span>
        @endif
    </button>
    <div id="notifDropdownMenu" style="display: none; position: absolute; right: 0; top: 100%; background: #ffffff; min-width: 250px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border-radius: 6px; padding: 6px 0; z-index: 1050; margin-top: 5px;">
        <div style="padding: 6px 14px; font-size: 12px; font-weight: bold; color: #6c757d; border-bottom: 1px solid #eee;">
            Непрочитанные статьи
        </div>
        @forelse(Auth::user()->unreadNotifications as $notification)
            <a href="{{ route('notifications.read', $notification->id) }}" style="display: block; padding: 8px 14px; color: #212529; text-decoration: none; font-size: 13px; border-bottom: 1px solid #f8f9fa;" onmouseover="this.style.background='#f1f3f5'" onmouseout="this.style.background='transparent'">
                📌 <strong>{{ $notification->data['title'] ?? 'Новая статья' }}</strong>
            </a>
        @empty
            <div style="padding: 10px 14px; color: #888; font-size: 13px;">Нет новых уведомлений</div>
        @endforelse
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('notifDropdownBtn');
        const menu = document.getElementById('notifDropdownMenu');
        if (btn && menu) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
            document.addEventListener('click', function () {
                menu.style.display = 'none';
            });
            menu.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }
    });
</script>
@endauth
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
        <div id="app"></div>
    @yield('content')
    </main>
    <footer>
        <p>Выполнил: Усачев Максим Викторович, Группа: 251-3210</p>
    </footer>
</body>
</html>
