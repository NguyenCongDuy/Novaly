<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'avatar_url',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function followedStories()
    {
        return $this->belongsToMany(Story::class, 'follows')->withTimestamps();
    }

    public function bookmarkedChapters()
    {
        return $this->belongsToMany(Chapter::class, 'bookmarks', 'user_id', 'chapter_id')
            ->withPivot('story_id')
            ->withTimestamps();
    }

    public function readingHistories()
    {
        return $this->hasMany(ReadingHistory::class);
    }

    public function storyRatings()
    {
        return $this->hasMany(StoryRating::class);
    }

    public function readingProgresses()
    {
        return $this->hasMany(ReadingProgress::class);
    }

    public function getAvatarUrlAttribute($value)
    {
        return $value ?? 'default-avatar.png';
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
