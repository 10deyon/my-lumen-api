<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BankTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(LocalGovtTableSeeder::class);
        $this->call(AppSettingTableSeeder::class);
    }
}
