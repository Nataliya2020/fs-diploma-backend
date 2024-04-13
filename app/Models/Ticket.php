<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $hidden = [
        'deleted_at'
    ];

    protected $fillable = [
        'film_title', 'hall_name', 'start_time', 'total_price', 'session_date'
    ];

    protected $table = 'tickets';

    public function seatsTicket(): HasMany
    {
        return $this->hasMany(TicketSeat::class, 'ticket_id', 'id');
    }
}
