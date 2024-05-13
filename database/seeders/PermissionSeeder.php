<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Supervisor']);
        Role::create(['name' => 'Admin']);

        $users = [

            'Show Create and Update Date',
            'Show Create and Update User',
            'Show All Department Report',

            'View Dashboard',

            'View Tracker',
            'Create Tracker',
            'Update Tracker',
            'Delete Tracker',

            'View Daily Logs',
            'Create Daily Logs',
            'Update Daily Logs',
            'Delete Daily Logs',

            'View Briefing Logs',
            'Create Briefing Logs',
            'Update Briefing Logs',
            'Delete Briefing Logs',

            'View Barred Patrons',
            'Create Barred Patrons',
            'Update Barred Patrons',
            'Delete Barred Patrons',

            'View Maintenance',
            'Create Maintenance',
            'Update Maintenance',
            'Delete Maintenance',

            'View User Setting',
            'Create User Setting',
            'Update User Setting',
            'Delete User Setting',

            'View Blacklist Setting',
            'Create Blacklist Setting',
            'Update Blacklist Setting',
            'Delete Blacklist Setting',

        ];
        foreach ($users as $user) {
            Permission::create(['name' => $user]);
        }
    }
}
