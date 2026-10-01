<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'shortDesc',
        'desc',
    ];

    protected $appends = ['preview_image', 'full_image'];

    public function getPreviewImageAttribute()
    {
        return $this->id % 2 === 0 ? 'images/preview_2.jpg' : 'images/preview.jpg';
    }

    public function getFullImageAttribute()
    {
        return $this->id % 2 === 0 ? 'images/full_2.jpeg' : 'images/full.jpeg';
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
