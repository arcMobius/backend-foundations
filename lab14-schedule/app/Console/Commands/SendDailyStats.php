<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\ArticleView;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyStatsMail;
use Carbon\Carbon;
class SendDailyStats extends Command {
    protected $signature = 'stats:send';
    public function handle() {
        $views = ArticleView::whereDate('created_at', Carbon::today())->count();
        $comments = Comment::whereDate('created_at', Carbon::today())->count();
        Mail::to('mod@admin.com')->send(new DailyStatsMail($views, $comments));
    }
}