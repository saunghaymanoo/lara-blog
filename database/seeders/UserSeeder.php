<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

       
        \App\Models\User::factory()->create([
            'name' => 'Su Pon',
            'email' => 'supon@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('asdffdsa'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('asdffdsa'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test Editor',
            'email' => 'editor@example.com',
            'role' => 'editor',
            'password' => Hash::make('asdffdsa'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test Author',
            'email' => 'author@example.com',
            'role' => 'author',
            'password' => Hash::make('asdffdsa'),
        ]);
    }
}
