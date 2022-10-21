<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker=Faker::create();
        // foreach(range(1,5) as $value){
        //     DB::table('artists')->insert([
        //         'name' => $faker->name,
        //         'created_at' => now(),
        //     ]);
        // }
        DB::table('artists')->insert([
            'name' => 'Harry Styles',
            'created_at' => now(),
        ]);
        DB::table('artists')->insert([
            'name' => 'Rihanna',
            'created_at' => now(),
        ]);
        DB::table('artists')->insert([
            'name' => 'The Weeknd',
            'created_at' => now(),
        ]);
    }
}
