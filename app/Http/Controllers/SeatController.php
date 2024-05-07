<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Database\Eloquent\Casts\ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): string
    {
        $seats = Seat::all();
        $halls = [];

        foreach ($seats as $seat) {
            $halls[] = $seat['hall_id'];
        }

        $halls = array_unique($halls);
        $totalSeatsNotBlocked = [];

        foreach ($seats as $seat) {
            $totalSeatsNotBlocked[] = $seat['seat_number'];
        }

        $totalQuantitySeatsNotBlocked = count($totalSeatsNotBlocked);
        $quantityHallsAndSeatsNotBlocked = [];
        $quantityHallsAndSeatsNotBlocked['quantityHalls'] = count($halls);
        $quantityHallsAndSeatsNotBlocked['quantitySeats'] = $totalQuantitySeatsNotBlocked;

        return json_encode($quantityHallsAndSeatsNotBlocked, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): array
    {
        $entity = $request->all();
        $countValid = 0;

        $rules = [
            'hall_id' => 'required|integer',
            'seat_number' => 'required|integer',
            'is_standard_chairs' => 'bool',
            'is_vip_chairs' => 'bool'
        ];

        foreach ($entity as $seat) {

            $seatArr = (array)$seat;

            $validator = Validator::make($seatArr, $rules);

            if ($validator->fails()) {
                $countValid--;
                break;
            } else {
                $countValid++;
            }
        }

        if ($countValid === count($entity)) {
            $forCopy = new ArrayObject($entity);
            $copyEntity = $forCopy->getArrayCopy();
            $seat = Seat::where('hall_id', $copyEntity[0]['hall_id'])->get();

            if ($seat->isNotEmpty()) {
                foreach ($seat as $key => $item) {
                    foreach ($copyEntity as $entityItem) {
                        if ($item['hall_id'] === $entityItem['hall_id'] && $item['seat_number'] === $entityItem['seat_number']) {
                            unset($seat[$key]);
                        }
                    }
                }
            }

            foreach ($seat as $item) {
                $this->destroySeat((array)$item['id']);
            }

            foreach ($entity as $place) {
                $hallWIthBlockedSeat = Hall::where('id', $place['hall_id'])->where('blocked_chairs', '<>', '.')->first();

                if ($hallWIthBlockedSeat && $hallWIthBlockedSeat->count() !== 0) {
                    $arrayBlockedSeat = explode(",", $hallWIthBlockedSeat['blocked_chairs']);

                    if (count($arrayBlockedSeat) !== 0) {
                        foreach ($arrayBlockedSeat as $blockedSeat) {
                            $seatDestroy = Seat::where('hall_id', $place['hall_id'])->where('seat_number', $blockedSeat)->first();

                            if (count((array)$seatDestroy) !== 0) {
                                $this->destroySeat((array)$seatDestroy['id']);
                            }
                        }
                    }
                }

                if ($place['seat_number'] !== 0) {
                    $seatUpdate = Seat::firstOrCreate([
                        'hall_id' => $place['hall_id'],
                        'seat_number' => $place['seat_number']
                    ]);

                    if ($seatUpdate->count() !== 0) {
                        $this->updateSeat($place);
                    } else {
                        Seat::create($place);
                    }
                }
            }
        }

        return ['done'];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Seat::where('hall_id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     * @throws ValidationException
     */

    public function updateSeat($request): array
    {
        $rules = [
            'hall_id' => 'required|integer',
            'seat_number' => 'required|integer',
            'is_standard_chairs' => 'bool',
            'is_vip_chairs' => 'bool'
        ];

        $validator = Validator::make($request, $rules);
        $result = [];

        if ($validator->fails()) {
            $result[] = "Проверьте данные места {$request['seat_number']}";

        } else {
            $seatUpdate = Seat::firstOrCreate([
                'hall_id' => $request['hall_id'],
                'seat_number' => $request['seat_number']
            ]);
            if ($seatUpdate !== false) {
                $seatUpdate->fill($request);
                $seatUpdate->save();
                $result[] = "Done";
            }
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroySeat($id): void
    {
        $seat = Seat::findOrFail($id)->first();
        $seat->delete();
    }
}
