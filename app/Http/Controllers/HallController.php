<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper\AppHelper;
use App\Models\Film;
use App\Models\Hall;
use App\Http\Requests\HallRequest;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): bool|string
    {
        $halls = Hall::all();
        $arrayHall = [];
        $sessionsForHalls = [];

        foreach ($halls as $hall) {
            $data = $hall->sessions;
            if (count($data) > 0) {
                foreach ($data as $session) {
                    $filmsForHall[] = Film::find($session->attributesToArray()['film_id']);
                    $filmsForHallUniq = array_unique($filmsForHall);
                }
                $arrayHall = $hall->attributesToArray();
                $arrayHall['sessions'] = $data;
                $arrayHall['films'] = $filmsForHallUniq ?? [];
            } else {
                $arrayHall = $hall->attributesToArray();
                $arrayHall['sessions'] = $data;
                $arrayHall['films'] = [];
            }

            $seatsVipAndStandart = AppHelper::instance()->getSeatsStandartAndVip($hall);

            $arrayHall['number_vip_chairs'] = $seatsVipAndStandart['vip'];
            $arrayHall['number_standard_chairs'] = $seatsVipAndStandart['standart'];

            $sessionsForHalls[] = $arrayHall;
        }
        return response()->json($sessionsForHalls);
        //return json_encode($sessionsForHalls, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HallRequest $request): array
    {
        $data = $request->validated();
        Hall::create($data);
        return ['status' => 'ok', 'messages' => 'Data created'];
    }

    /**
     * Display the specified resource.
     */
    public function show($id): array
    {
        $sessionsForHall = [];
        $filmsForHall = [];
        $hall = Hall::findOrFail($id);

        $sessionsHall = $hall->sessions;

        foreach ($sessionsHall as $session) {
            $filmsForHall[] = Film::find($session->attributesToArray()['film_id'])->attributesToArray();
        }

        $seatsVipAndStandart = AppHelper::instance()->getSeatsStandartAndVip($hall);

        $hall->attributesToArray();
        $hall['sessions'] = $sessionsHall;
        $hall['films'] = $filmsForHall;
        $hall['number_vip_chairs'] = $seatsVipAndStandart['vip'];
        $hall['number_standard_chairs'] = $seatsVipAndStandart['standart'];

        $sessionsForHall[] = $hall;
        return $sessionsForHall;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HallRequest $request, $hall_id)
    {
        $hall = Hall::findOrFail($hall_id);
        $hall->fill($request->validated());
        return $hall->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hall = Hall::findOrFail($id);

        if ($hall->delete()) {
            return ['status' => 'ok', 'messages' => 'Data deleted'];
        }

        return null;
    }
}
