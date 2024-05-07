<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    use HasFactory;

    protected $hidden = [
        'deleted_at'
    ];
    protected $fillable = [
        'name',
        'rows',
        'chairs_in_row',
        'total_chairs',
        'blocked_chairs',
        'price_standart_chair',
        'price_vip_chair',
        'is_active'
    ];

    protected $table = 'halls';

    public function sessions(): HasMany
    {

        return $this->hasMany(Session::class, 'hall_id', 'id');
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class, 'hall_id', 'id');
    }
}
