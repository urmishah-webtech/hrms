<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'id' => 1,
            'name' => 'Westheimer'
        ]);
        DB::table('locations')->insert([
            'id' => 2,
            'name' => 'Beechnut'
        ]);
        DB::table('locations')->insert([
            'id' => 3,
            'name' => 'Warehouse'
        ]);
        DB::table('locations')->insert([
            'id' => 4,
            'name' => 'Corporate'
        ]);
    }
}
