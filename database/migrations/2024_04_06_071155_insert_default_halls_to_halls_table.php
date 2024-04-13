<?php

use App\Helpers\AppHelper\AppHelper;
use App\Models\Hall;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $halls = Hall::factory()->raw();

            foreach ($halls as $hall) {
                Hall::create($hall);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $hallData = AppHelper::instance()->getHallData();

            DB::table('halls')->whereIn('name', $hallData['name'])->whereIn('rows', $hallData['rows'])
                ->whereIn('chairs_in_row', $hallData['chairs_in_row'])->whereIn('total_chairs', $hallData['total_chairs'])
                ->whereIn('blocked_chairs', $hallData['blocked_chairs'])->whereIn('price_standart_chair', $hallData['price_standart_chair'])
                ->whereIn('price_vip_chair', $hallData['price_vip_chair'])->whereIn('is_active', $hallData['is_active'])->delete();
        });
    }
};
