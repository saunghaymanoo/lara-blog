<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;
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
        \App\Models\User::factory(10)->create();

       
        \App\Models\User::factory()->create([
            'name' => 'Su Pon',
            'email' => 'supon@example.com',
            'password' => Hash::make('asdffdsa'),
        ]);
        $categories=["IT News","Sport","Food & Drink","Travel"];
        foreach($categories as $c){
            Category::factory()->create([
                "title" => $c,
                "slug" => Str::slug($c),
                "user_id" => User::inRandomOrder()->first()->id
            ]);
        }

        Post::factory()->count(50)->create();

    }
}
