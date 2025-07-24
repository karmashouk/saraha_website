<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = [
            ['name' => 'Abdo', 'email' => 'Abdo@example.com', 'password' => Hash::make('Abdo137')],
            ['name' => 'Sabry', 'email' => 'Sabry@example.com', 'password' => Hash::make('Sabry2005')],


        ];
        user::create();

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
