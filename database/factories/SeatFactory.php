<?php

namespace Database\Factories;

use App\Helpers\AppHelper\AppHelper;
use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seats = [];
        $seatsItem = [];

        $hallData = AppHelper::instance()->getHallData();

        $halls = DB::table('halls')->whereIn('name', $hallData['name'])->whereIn('rows', $hallData['rows'])->whereIn('chairs_in_row', $hallData['chairs_in_row'])
            ->whereIn('total_chairs', $hallData['total_chairs'])->whereIn('blocked_chairs', $hallData['blocked_chairs'])
            ->whereIn('price_standart_chair', $hallData['price_standart_chair'])->whereIn('price_vip_chair', $hallData['price_vip_chair'])->get()->toArray();


        foreach ($halls as $hall) {
            $seatsItem['hall_id'] = $hall->id;
            $seatsItem['is_vip_chairs'] = true;
            $seatsItem['is_standard_chairs'] = false;

            $seatsBlocked = explode(",", $hall->blocked_chairs);

            $firstRowSeatsQuantity = $hall->chairs_in_row;

            for ($i = 1; $i <= $firstRowSeatsQuantity; $i++) {
                if (!in_array(strval($i), $seatsBlocked)) {
                    $seatsItem['seat_number'] = $i;
                    $seats[] = $seatsItem;
                }
            }
        }

        return $seats;
    }
}
