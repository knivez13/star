<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Maintenance\ReportStatus;
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

        $reportstatus = [
            'Pending',
            'Close for Reply',
            'Total Close',
            'Void'
        ];
        foreach ($reportstatus as $q) {
            ReportStatus::create(['code' => $q, 'description' => $q]);
        }
    }
}
