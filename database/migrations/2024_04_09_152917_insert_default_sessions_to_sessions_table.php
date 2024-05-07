<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            $sessions = \App\Models\Session::factory()->raw();

            foreach ($sessions as $session) {
                \App\Models\Session::create($session);
            }
        });
    }

    public function down(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            $session_start_time = array_column(\App\Models\Session::factory()->raw(), 'session_start_time');
            $session_start_time = json_decode(json_encode($session_start_time), true);
            $session_date = array_column(\App\Models\Session::factory()->raw(), 'session_date');
            $session_date = json_decode(json_encode($session_date), true);

            DB::table('sessions')
                ->whereIn('session_start_time', $session_start_time)
                ->whereIn('session_date', $session_date)
                ->delete();
        });
    }
};
