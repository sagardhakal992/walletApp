<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        $user1=User::create([
            'email'=>"adam@gmail.com",
            'name'=>'adam',
            'password'=>Hash::make('password'),
            'phone_number'=>9865214200
        ]);

        User::create([
            'email'=>"sagar@gmail.com",
            'name'=>'sagar',
            'password'=>Hash::make('password'),
            'phone_number'=>9865684200
        ]);
        User::factory()->count(10)->create();
    }
}
