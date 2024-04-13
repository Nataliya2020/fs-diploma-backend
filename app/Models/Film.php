<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'movie_duration', 'image', 'description', 'country_of_origin'
    ];

    protected $table = 'films';

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'film_id', 'id');
    }
}
