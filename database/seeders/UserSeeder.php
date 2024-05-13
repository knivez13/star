<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Maintenance\Result;
use Spatie\Permission\Models\Role;
use App\Models\Maintenance\Currency;
use Illuminate\Support\Facades\Hash;
use App\Models\Maintenance\Inspector;
use App\Models\Blacklist\BlackistType;
use App\Models\Blacklist\BlackistStatus;
use App\Models\Maintenance\GroupSection;
use App\Models\Maintenance\ReportStatus;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'emp_id' => '123123',
            'first_name' => 'Bonjour',
            'middle_name' => 'Lopez',
            'last_name' => 'De Guzman',
            'email' => 'bonjourdeguzman@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $role = Role::create(['name' => 'SystemAdmin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole('SystemAdmin');

        $reportstatus = [
            'Pending',
            'Close for Reply',
            'Total Close',
            'Void'
        ];
        foreach ($reportstatus as $q) {
            ReportStatus::create(['code' => $q, 'description' => $q]);
        }

        $currency = [
            'PHP',
            'USD',
            'HKD',
            'SGD',
            'WON',
            'AUD'
        ];
        foreach ($currency as $q) {
            Currency::create(['code' => $q, 'description' => $q]);
        }

        $groupsection = [
            'Gaming Surveillance',
            'Surveillance',

        ];
        foreach ($groupsection as $q) {
            GroupSection::create(['code' => $q, 'description' => $q]);
        }

        $inspectorX = [
            'NL',
            '1 tables',
            '2 tables',
            '3 tables',
            '4 tables',
            '5 tables',
        ];
        foreach ($inspectorX as $q) {
            Inspector::create(['code' => $q, 'description' => $q]);
        }

        $result = [
            'Repaid',
            'Recovered',
            'Unrecovered',
            'Unpaid',
            'Recovered + Repaid',
            'Repaid + Unrecovered',
            'Recovered + Unrecovered',
            'Other',
            'Not Applicable'

        ];
        foreach ($result as $q) {
            Result::create(['code' => $q, 'description' => $q]);
        }

        $blacklist_type = [
            'Employee',
            'Member',
            'Non Member',
        ];
        foreach ($blacklist_type as $q) {
            BlackistType::create(['code' => $q, 'description' => $q]);
        }
        $blacklist_status = [
            'Under Monitor',
            'Ban',
            'Suspended',
        ];
        foreach ($blacklist_status as $q) {
            BlackistStatus::create(['code' => $q, 'description' => $q, 'color' => 'primary']);
        }
    }
}
