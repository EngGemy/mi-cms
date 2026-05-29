<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('settings')->upsert([
            ['group' => 'calculator', 'name' => 'concrete_m2',    'locked' => false, 'payload' => json_encode((float) env('CALC_CONCRETE_M2', 2800))],
            ['group' => 'calculator', 'name' => 'steel_m2',       'locked' => false, 'payload' => json_encode((float) env('CALC_STEEL_M2', 4200))],
            ['group' => 'calculator', 'name' => 'walls_m2',       'locked' => false, 'payload' => json_encode((float) env('CALC_WALLS_M2', 2400))],
            ['group' => 'calculator', 'name' => 'tanks_fixed',    'locked' => false, 'payload' => json_encode((float) env('CALC_TANKS_FIXED', 95000))],
            ['group' => 'calculator', 'name' => 'bird_cost',      'locked' => false, 'payload' => json_encode((float) env('CALC_BIRD_COST', 220))],
            ['group' => 'calculator', 'name' => 'rear_fan',       'locked' => false, 'payload' => json_encode((float) env('CALC_REAR_FAN', 42000))],
            ['group' => 'calculator', 'name' => 'cooling_factor', 'locked' => false, 'payload' => json_encode((float) env('CALC_COOLING_FACTOR', 5500))],
            ['group' => 'calculator', 'name' => 'window',         'locked' => false, 'payload' => json_encode((float) env('CALC_WINDOW', 4800))],
            ['group' => 'calculator', 'name' => 'side_fan',       'locked' => false, 'payload' => json_encode((float) env('CALC_SIDE_FAN', 35000))],
            ['group' => 'calculator', 'name' => 'heater',         'locked' => false, 'payload' => json_encode((float) env('CALC_HEATER', 26000))],
            ['group' => 'calculator', 'name' => 'control_fixed',  'locked' => false, 'payload' => json_encode((float) env('CALC_CONTROL_FIXED', 110000))],
            ['group' => 'calculator', 'name' => 'bird_weight_kg', 'locked' => false, 'payload' => json_encode(2.1)],
        ], ['group', 'name']);
    }

    public function down(): void
    {
        DB::table('settings')->where('group', 'calculator')->delete();
    }
};
