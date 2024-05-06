<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'emp_id' => '123123',
            'first_name' => 'Bonjour',
            'middle_name' => 'Lopez',
            'last_name' => 'De Guzman',
            'email' => 'bonjourdeguzman@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
