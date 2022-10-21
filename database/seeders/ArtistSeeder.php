<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artists')->insert([
            'name' => 'Drake',
            'created_at' => now(),
        ]);
        DB::table('artists')->insert([
            'name' => 'Rihanna',
            'created_at' => now(),
        ]);
        DB::table('artists')->insert([
            'name' => 'Britney Spears',
            'created_at' => now(),
        ]);
    }
}
