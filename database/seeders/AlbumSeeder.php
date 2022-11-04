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
            'genre' => 'Funk, Pop',
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
            'artist_id' => '2',
            'title' => 'Anti',          
            'genre' => 'Hip-Hop & Rap',
            'artwork'=>"Anti.jfif",
            'created_at' => now(),
        ]);
        DB::table('albums')->insert([
            'artist_id' => '3',
            'title' => 'After Hours',          
            'genre' => 'Pop, R&B',
            'artwork'=>"After Hours.jfif",
            'created_at' => now(),
        ]);
        DB::table('albums')->insert([
            'artist_id' => '3',
            'title' => 'Dawn FM',          
            'genre' => 'Classical',
            'artwork'=>"Dawn FM.jfif",
            'created_at' => now(),
        ]);
        DB::table('albums')->insert([
            'artist_id' => '4',
            'title' => 'Blue',          
            'genre' => 'Country',
            'artwork'=>"Blue.jfif",
            'created_at' => now(),
        ]);
        DB::table('albums')->insert([
            'artist_id' => '5',
            'title' => 'Future Nostalgia',          
            'genre' => 'Jazz, EDM',
            'artwork'=>"Future Nostalgia.jfif",
            'created_at' => now(),
        ]);
    }
}
