<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketSeat extends Model
{
    use HasFactory;

    protected $hidden = [
        'deleted_at'
    ];

    protected $fillable = [
        'ticket_id', 'row', 'seats_numbers'
    ];

    protected $table = 'ticket_seats';

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}
