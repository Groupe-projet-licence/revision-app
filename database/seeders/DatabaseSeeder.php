<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            "name"=>"darlin",
            "email"=> "donfackdarlin@gmail.com",
            "password"=> Hash::make("670748873")
        ]);
        \App\Models\User::factory()->create([
            "name"=>"rochelin",
            "email"=> "anoumedemrochelin6@gmail.com",
            "password"=> Hash::make("698112522")
        ]);
        \App\Models\User::factory()->create([
            "name"=>"wafo",
            "email"=> "aroldwafo50@gmail.com",
            "password"=> Hash::make("676351663")
        ]);
        \App\Models\User::factory()->create([
            "name"=>"alicia",
            "email"=> "ematalicia5@gmail.com",
            "password"=> Hash::make("653654468")
        ]);
        \App\Models\User::factory()->create([
            "name"=>"elisabeth",
            "email"=> "kennepewoelisabeth223@gmail.com",
            "password"=> Hash::make("654992997")
        ]);
        \App\Models\User::factory()->create([
            "name"=>"elie",
            "email"=> "fotsoelie52@gmail.com",
            "password"=> Hash::make("657945736")
        ]); 
        \App\Models\User::factory()->create([
            "name"=>"ange",
            "email"=> "angekengne651@gmail.com",
            "password"=> Hash::make("651261713")
        ]);
        \App\Models\User::factory()->create([
            "name"=>"jason",
            "email"=> "Atemjason11@gmail.com",
            "password"=> Hash::make("652725764")
        ]);
        \App\Models\User::factory()->create([
            "name"=>"john",
            "email"=> "kuetchejohn19@gmail.com",
            "password"=> Hash::make("675372019")
        ]);
        \App\Models\User::factory()->create([
            "name"=>"patricia",
            "email"=> "patricia@gmail.com",
            "password"=> Hash::make("651641499")
        ]);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
