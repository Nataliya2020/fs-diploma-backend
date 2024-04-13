<?php

use App\Models\Seat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('seats', function (Blueprint $table) {
            $seats = Seat::factory()->raw();

            foreach ($seats as $seat) {
                Seat::create($seat);
            }
        });
    }

    public function down(): void
    {
        Schema::table('seats', function (Blueprint $table) {
            $hall_id = array_column(Seat::factory()->raw(), 'hall_id');
            $hall_id = json_decode(json_encode($hall_id), true);
            $seat_number = array_column(Seat::factory()->raw(), 'seat_number');
            $seat_number = json_decode(json_encode($seat_number), true);
            $is_standard_chairs = array_column(Seat::factory()->raw(), 'is_standard_chairs');
            $is_standard_chairs = json_decode(json_encode($is_standard_chairs), true);
            $is_vip_chairs = array_column(Seat::factory()->raw(), 'is_vip_chairs');
            $is_vip_chairs = json_decode(json_encode($is_vip_chairs), true);

            DB::table('seats')->whereIn('hall_id', $hall_id)->whereIn('seat_number', $seat_number)
                ->whereIn('is_standard_chairs', $is_standard_chairs)->whereIn('is_vip_chairs', $is_vip_chairs)->delete();
        });
    }
};
