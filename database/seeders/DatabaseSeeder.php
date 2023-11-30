<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\events;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name'=>'admin',
            'email'=>'admin@example.com',
            'password'=>bcrypt('password'),
            'role'=>'admin',
        ]);
        events::create([
            'title'=>'Demo Masak',
            'description'=>'Demo Masak',
            'date'=>'2023-12-03',
            'time'=>'14:00:10',
            'location'=>'Restoran Mbak Yayuk Karangan',
            'slots_available'=>'12',
            'created_by_user_id'=>'1',
            ]
        );
        events::create([
            'title'=>'Demo Masak',
            'description'=>'Demo Masak',
            'date'=>'2023-12-03',
            'time'=>'14:00:10',
            'location'=>'Restoran Bu Rissa TMB',
            'slots_available'=>'12',
            'created_by_user_id'=>'1',
            ]
        );
        events::create([
            'title'=>'Rejeki Nomplok',
            'description'=>'Undian',
            'date'=>'2023-12-03',
            'time'=>'14:00:10',
            'location'=>'Alun-alun Surabaya Mall 1, Pemuda 33-37, Genteng, Surabaya',
            'slots_available'=>'12',
            'created_by_user_id'=>'1',
            ]
        );
    }
}