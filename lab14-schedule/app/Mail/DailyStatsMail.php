<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class DailyStatsMail extends Mailable {
    use Queueable, SerializesModels;
    public $views;
    public $comments;
    public function __construct($views, $comments) {
        $this->views = $views;
        $this->comments = $comments;
    }
    public function build() {
        return $this->subject('Статистика за день')->text('emails.stats');
    }
}