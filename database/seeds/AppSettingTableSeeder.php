<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("app_settings")->truncate();

        DB::table("app_settings")->insert([
            "default_commission_rate" => 0.7
        ]);
    }
}
