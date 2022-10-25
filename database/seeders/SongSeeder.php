<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->insert([
            'album_id' => '2',
            'title' => "Album 2 Song 1",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '2',
            'title' => "Album 2 Song 2",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '2',
            'title' => "Album 2 Song 3",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '3',
            'title' => "Album 3 Song 1",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '3',
            'title' => "Album 3 Song 2",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '3',
            'title' => "Album 3 Song 3",            
            'created_at' => now(),
        ]);
    }
}
