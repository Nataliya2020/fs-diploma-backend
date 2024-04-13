<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\TicketRequest;

class TicketController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request): array
    {
        $data = $request->validated();
        $modelNew = Ticket::create($data);

        return ['id' => $modelNew->id];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $rowAndSeats = $ticket->seatsTicket;
        $ticket['seats'] = $rowAndSeats;

        return $ticket;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (gettype($id) === 'integer') {
            $tickets = Ticket::where('id', $id)->get();

            foreach ($tickets as $ticket) {
                if ($ticket->delete()) {
                    return ['status' => 'ok', 'messages' => 'Data deleted'];
                }
            }
        }
        return ['error' => 'not number'];
    }
}
