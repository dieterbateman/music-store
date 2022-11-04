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
            'album_id' => '7',
            'title' => "Future Nostalgia",
            'file' => "Future Nostalgia - Future Nostalgia.mp3",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '7',
            'title' => "Levitating",
            'file' => "Future Nostalgia - Levitating.mp4",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '2',
            'title' => "Lights Up", 
            'file' => "Fine Line - Lights Up.mp3",           
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '2',
            'title' => "Watermelon Sugar",
            'file' => "Fine Line - Watermelon Sugar.mp3",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '1',
            'title' => "As It Was",
            'file' => "Harry's House - As It Was.mp4",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '1',
            'title' => "Grapejuice",
            'file' => "Harry's House - Grapejuice.mp4",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '1',
            'title' => "Late Night Talking",
            'file' => "Harry's House - Late Night Talking.mp4",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '6',
            'title' => "Mama",
            'file' => "Blue - Mama.mp4",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '6',
            'title' => "Perfect Strangers", 
            'file' => "Blue - Perfect Strangers.mp3",           
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '3',
            'title' => "Consideration",
            'file' => "Anti - Consideration.mp4",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '3',
            'title' => "Work",
            'file' => "Anti - Work.mp3",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '4',
            'title' => "Blinding Lights",
            'file' => "After Hours - Blinding Lights.mp4",            
            'created_at' => now(),
        ]);
        DB::table('songs')->insert([
            'album_id' => '4',
            'title' => "Save Your Tears",
            'file' => "After Hours - Save Your Tears.mp3",            
            'created_at' => now(),
        ]);
    }
}
