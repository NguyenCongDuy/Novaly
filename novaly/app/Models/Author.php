<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'address',
        'description',
        'bio',
    ];

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}