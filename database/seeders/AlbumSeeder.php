<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('albums')->insert([
            'artist_id' => '1',
            'title' => "Harry's House",            
            'genre' => 'Pop',
            'artwork'=>"Harry's House.jfif",
            'created_at' => now(),
        ]);
        DB::table('albums')->insert([
            'artist_id' => '1',
            'title' => 'Fine Line',           
            'genre' => 'Pop',
            'artwork'=>"Fine Line.jfif",
            'created_at' => now(),
        ]);
        DB::table('albums')->insert([
            'artist_id' => '3',
            'title' => 'After Hours',          
            'genre' => 'Pop',
            'artwork'=>"After Hours.jfif",
            'created_at' => now(),
        ]);
    }
}
