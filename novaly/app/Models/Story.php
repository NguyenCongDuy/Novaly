<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'avatar_url',
        'cover_url',
        'view_count',
        'like_count',
        'status',
        'author_id',
    ];

    protected $casts = [
        'view_count' => 'integer',
        'like_count' => 'integer',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'story_genres');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows')->withTimestamps();
    }

    public function readingHistories()
    {
        return $this->hasMany(ReadingHistory::class);
    }

    public function ratings()
    {
        return $this->hasMany(StoryRating::class);
    }
}