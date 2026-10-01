@extends('layouts.main')

@section('content')
    <div style="max-width: 900px; margin: 0 auto;">
        <h1>Модерация комментариев</h1>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background: #f4f4f4;">
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Автор</th>
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Статья</th>
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Комментарий</th>
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: center; width: 180px;">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px;">{{ $comment->user->name }}</td>
                        <td style="border: 1px solid #ddd; padding: 10px;"><a href="{{ route('articles.show', $comment->article_id) }}" target="_blank">{{ $comment->article->name }}</a></td>
                        <td style="border: 1px solid #ddd; padding: 10px;">{{ $comment->body }}</td>
                        <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                            <div style="display: flex; gap: 5px; justify-content: center;">
                                <form action="{{ route('moderation.comments.approve', $comment->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" style="background: #28a745; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer;">Принять</button>
                                </form>
                                <form action="{{ route('moderation.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Удалить комментарий?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #dc3545; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer;">Отклонить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="border: 1px solid #ddd; padding: 15px; text-align: center;">Нет комментариев, ожидающих модерации.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $comments->links() }}
        </div>
    </div>
@endsection
