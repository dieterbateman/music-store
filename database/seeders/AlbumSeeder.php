<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'title' => 'The Beginning',
            'artist_id'=> '1',
            'genre'=> 'Hip-Hop',
            'created_at' => now(),
        ]);
        DB::table('albums')->insert([
            'title' => 'The End',
            'artist_id'=> '1',
            'genre'=> 'Hip-Hop',
            'created_at' => now(),
        ]);
        DB::table('albums')->insert([
            'title' => 'Another Album',
            'artist_id'=> '2',
            'genre'=> 'Pop',
            'created_at' => now(),
        ]);
    }
}
