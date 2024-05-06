<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
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
                'title' => 'Звёздные войны XXIII: Атака клонированных клонов',
                'description' => 'Две сотни лет назад малороссийские хутор',
                'movie_duration' => 130,
                'image' => 'img/511eb6fb02565ba0374ddb3ad501d299.jpeg',
                'country_of_origin' => 'США'
            ],
            [
                'title' => 'Альфа',
                'description' => '20 тысяч лет назад Земля была холодным и неуютным местом, в котором смерть подстерегала человека на каждом шагу.',
                'movie_duration' => 96,
                'image' => 'img/3df77a6fe04a8f4253879b3478b0776a.jpeg',
                'country_of_origin' => 'Франция'
            ],
            [
                'title' => 'Хищник',
                'description' => 'Самые опасные хищники Вселенной, прибыв из глубин космоса, высаживаются на улицах маленького городка, чтобы начать свою кровавую охоту. Генетически модернизировав себя с помощью ДНК других видов, охотники стали ещё сильнее, умнее и беспощаднее.',
                'movie_duration' => 101,
                'image' => 'img/511eb6fb02565ba0374ddb3ad501d299.jpeg',
                'country_of_origin' => 'Канада, США'
            ]
        ];
    }
}
