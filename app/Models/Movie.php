<?php

namespace App\Models;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'poster_link',
        'synopsis',
        'release_date',
        'trailer_link',
    ];
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
