<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=["IT News","Sport","Food & Drink","Travel"];
        foreach($categories as $c){
            Category::factory()->create([
                "title" => $c,
                "slug" => Str::slug($c),
                "user_id" => User::inRandomOrder()->first()->id
            ]);
        }
    }
}
