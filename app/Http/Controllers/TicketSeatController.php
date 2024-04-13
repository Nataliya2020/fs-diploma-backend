<?php

namespace App\Http\Controllers;

use App\Models\TicketSeat;
use App\Http\Requests\TicketSeatRequest;
use Illuminate\Support\Facades\Validator;

class TicketSeatController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketSeatRequest $request)
    {
        $data = $request->validated();
        $dataSeat = $data['seat'];
        $countValid = 0;

        $rules = [
            'seat' => [
                'row' => 'required|integer',
                'col' => 'required|string'
            ]
        ];

        foreach ($dataSeat as $seat) {
            $seatArr = (array)$seat;
            $validator = Validator::make($seatArr, $rules);

            if ($validator->fails()) {
                $countValid--;
                break;
            } else {
                $countValid++;
            }
        }

        if ($countValid === count($dataSeat)) {
            foreach ($dataSeat as $seat) {
                $dataSave = ['ticket_id' => $data['ticket_id'], 'row' => $seat['row'], 'seats_numbers' => $seat['col']];
                TicketSeat::create($dataSave);
            }
        }

        return ['status' => 'ok'];
    }
}
