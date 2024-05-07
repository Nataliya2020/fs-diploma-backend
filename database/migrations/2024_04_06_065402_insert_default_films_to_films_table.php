<?php

use App\Helpers\AppHelper\AppHelper;
use App\Models\Film;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $films = Film::factory()->raw();

            foreach ($films as $film) {
                Film::create($film);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $filmData = AppHelper::instance()->getFilmData();

            DB::table('films')
                ->whereIn('title', $filmData['titles'])
                ->whereIn('description', $filmData['description'])
                ->whereIn('movie_duration', $filmData['movie_duration'])
                ->whereIn('image', $filmData['image'])
                ->whereIn('country_of_origin', $filmData['country_of_origin'])
                ->delete();
        });
    }
};
