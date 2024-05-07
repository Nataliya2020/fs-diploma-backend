<?php

namespace Database\Factories;

use App\Helpers\AppHelper\AppHelper;
use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory<Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hallData = AppHelper::instance()->getHallData();

        $halls = DB::table('halls')
            ->whereIn('name', $hallData['name'])
            ->whereIn('rows', $hallData['rows'])
            ->whereIn('chairs_in_row', $hallData['chairs_in_row'])
            ->whereIn('total_chairs', $hallData['total_chairs'])
            ->whereIn('blocked_chairs', $hallData['blocked_chairs'])
            ->whereIn('price_standart_chair', $hallData['price_standart_chair'])
            ->whereIn('price_vip_chair', $hallData['price_vip_chair'])
            ->pluck('id')->toArray();

        $keyHall = array_rand($halls);

        $filmData = AppHelper::instance()->getFilmData();

        $films = DB::table('films')
            ->whereIn('title', $filmData['titles'])
            ->whereIn('description', $filmData['description'])
            ->whereIn('movie_duration', $filmData['movie_duration'])
            ->whereIn('image', $filmData['image'])
            ->whereIn('country_of_origin', $filmData['country_of_origin'])
            ->pluck('id')->toArray();

        $keyFilm = Array_rand($films);

        return [
            [
                'hall_id' => $halls[$keyHall],
                'film_id' => $films[$keyFilm],
                'session_start_time' => '10:00',
                'session_date' => date('Ymd')
            ],
            [
                'hall_id' => $halls[$keyHall],
                'film_id' => $films[$keyFilm],
                'session_start_time' => '15:00',
                'session_date' => date('Ymd')
            ],
            [
                'hall_id' => $halls[$keyHall],
                'film_id' => $films[$keyFilm],
                'session_start_time' => '20:00',
                'session_date' => date('Ymd')
            ]
        ];
    }
}
