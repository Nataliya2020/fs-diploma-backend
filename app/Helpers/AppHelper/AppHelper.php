<?php

namespace App\Helpers\AppHelper;

use App\Models\Film;
use App\Models\Hall;

class AppHelper
{
    public function getSeatsStandartAndVip($hall): array
    {
        $seats = $hall->seats;

        $seatsNumberVip = '';
        $seatsNumberStandart = '';

        $vips = $seats->where('is_vip_chairs', 1);
        $standarts = $seats->where('is_standard_chairs', 1);

        foreach ($vips as $vip) {
            $seatsNumberVip .= ',' . $vip['seat_number'];
        }

        foreach ($standarts as $standart) {
            $seatsNumberStandart .= ',' . $standart['seat_number'];
        }
        $seatsNumberStandart = substr($seatsNumberStandart, 1);
        $seatsNumberVip = substr($seatsNumberVip, 1);

        return ["standart" => $seatsNumberStandart, "vip" => $seatsNumberVip];
    }

    public function getHallData(): array
    {
        $name = array_column(Hall::factory()->raw(), 'name');
        $name = json_decode(json_encode($name), true);
        $rows = array_column(Hall::factory()->raw(), 'rows');
        $rows = json_decode(json_encode($rows), true);
        $chairs_in_row = array_column(Hall::factory()->raw(), 'chairs_in_row');
        $chairs_in_row = json_decode(json_encode($chairs_in_row), true);
        $total_chairs = array_column(Hall::factory()->raw(), 'total_chairs');
        $total_chairs = json_decode(json_encode($total_chairs), true);
        $blocked_chairs = array_column(Hall::factory()->raw(), 'blocked_chairs');
        $blocked_chairs = json_decode(json_encode($blocked_chairs), true);
        $price_standart_chair = array_column(Hall::factory()->raw(), 'price_standart_chair');
        $price_standart_chair = json_decode(json_encode($price_standart_chair), true);
        $price_vip_chair = array_column(Hall::factory()->raw(), 'price_vip_chair');
        $price_vip_chair = json_decode(json_encode($price_vip_chair), true);
        $is_active = array_column(Hall::factory()->raw(), 'is_active');
        $is_active = json_decode(json_encode($is_active), true);

        return ['name' => $name, 'rows' => $rows, 'chairs_in_row' => $chairs_in_row, 'total_chairs' => $total_chairs,
            'blocked_chairs' => $blocked_chairs, 'price_standart_chair' => $price_standart_chair,
            'price_vip_chair' => $price_vip_chair, 'is_active' => $is_active];
    }

    public function getFilmData(): array
    {
        $titles = array_column(Film::factory()->raw(), 'title');
        $titles = json_decode(json_encode($titles), true);
        $description = array_column(Film::factory()->raw(), 'description');
        $description = json_decode(json_encode($description), true);
        $movie_duration = array_column(Film::factory()->raw(), 'movie_duration');
        $movie_duration = json_decode(json_encode($movie_duration), true);
        $image = array_column(Film::factory()->raw(), 'image');
        $image = json_decode(json_encode($image), true);
        $country_of_origin = array_column(Film::factory()->raw(), 'country_of_origin');
        $country_of_origin = json_decode(json_encode($country_of_origin), true);

        return ['titles' => $titles, 'description' => $description, 'movie_duration' => $movie_duration, 'image' => $image, 'country_of_origin' => $country_of_origin];
    }

    public static function instance()
    {
        return new AppHelper();
    }
}
