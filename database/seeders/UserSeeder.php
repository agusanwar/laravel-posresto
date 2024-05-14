<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(9)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@ai.com',
            'password' => Hash::make('123456'),
            'phone' =>'0912211111',
            'roles' => 'ADMIN',
        ]);
    }
}
