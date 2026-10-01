<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новая статья</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Уведомление о новой статье</h2>
    <p>Модератор, на сайте была добавлена новая статья:</p>
    <h3>{{ $article->name }}</h3>
    <p><strong>Дата:</strong> {{ $article->date }}</p>
    @if($article->shortDesc)
        <p><strong>Краткое описание:</strong> {{ $article->shortDesc }}</p>
    @endif
    <p>{{ $article->desc }}</p>
</body>
</html>
