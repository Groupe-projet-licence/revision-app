<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Sheet;
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
       

        Sheet::factory()->count(3)->create(['user_id'=>1]);
        Sheet::factory()->count(3)->create(['user_id'=>2]);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
