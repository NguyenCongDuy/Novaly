<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'story_id',
        'chapter_number',
        'title',
        'access_type',
        'coin_price',
        'money_price',
        'view_count',
    ];

    protected $casts = [
        'chapter_number' => 'integer',
        'coin_price' => 'decimal:2',
        'premium_price' => 'decimal:2',
        'view_count' => 'integer',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function content()
    {
        return $this->hasOne(ChapterContent::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function readingProgresses()
    {
        return $this->hasMany(ReadingProgress::class);
    }
}