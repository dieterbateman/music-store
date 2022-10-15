<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin user
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at'=>now(),
            'password' => Hash::make('admin'),
            'is_admin' => True,
        ]);
        // create test user
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test'),
            'is_admin' => False,
        ]);
    }
}
