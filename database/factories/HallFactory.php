<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Hall>
 */
class HallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            [
                'name' => 'Зал 1',
                'rows' => 10,
                'chairs_in_row' => 12,
                'total_chairs' => 120,
                'blocked_chairs' => '1,2,3,4,5,8,9,10,11,12,13,14,15,16,21,22,23,24,25,34,35,36,46,47,48,58,59,60,70,71,72,82,83,84,94,95,96',
                'price_standart_chair' => '250',
                'price_vip_chair' => '350',
                'is_active' => '0'
            ],
            [
                'name' => 'Зал 2',
                'rows' => 12,
                'chairs_in_row' => 13,
                'total_chairs' => 156,
                'blocked_chairs' => '7,20,33,46,59,72,85,98,111,124,137,150',
                'price_standart_chair' => '225',
                'price_vip_chair' => '325',
                'is_active' => '0'
            ],
            [
                'name' => 'Зал 3',
                'rows' => 11,
                'chairs_in_row' => 10,
                'total_chairs' => 120,
                'blocked_chairs' => '1,2,3,4,7,8,9,10,11,12,13,18,19,20,21,22,29,30,31,40',
                'price_standart_chair' => '260',
                'price_vip_chair' => '360',
                'is_active' => '0'
            ]
        ];
    }
}
