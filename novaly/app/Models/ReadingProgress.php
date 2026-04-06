<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingProgress extends Model
{
    use HasFactory;

    protected $table = 'reading_progresss'; // Note: migration has typo

    protected $fillable = [
        'user_id',
        'story_id',
        'chapter_id',
        'scroll_percent',
        'last_read_at',
    ];

    protected $casts = [
        'scroll_percentage' => 'decimal:2',
        'last_read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}