<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "title",
        "description",
        "image"
    ];

    protected function casts(): array
    {
        return [
            'image' => 'array'
        ];
    }
}
