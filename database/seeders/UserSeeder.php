<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nick' => 'Pepe',
            'email' => 'buenas@gmail.com',
            'password' => bcrypt('123456'),
            'status' => true,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        DB::table('users')->insert([
            'nick' => 'Carla',
            'email' => 'auto@gmail.com',
            'password' => bcrypt('123456'),
            'status' => true,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);

        DB::table('users')->insert([
            'nick' => 'Pedrolon',
            'email' => 'rosco@gmail.com',
            'password' => bcrypt('123456'),
            'status' => true,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
    }
}
