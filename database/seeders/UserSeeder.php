<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Users\UserLevel;
use Illuminate\Database\Seeder;
use App\Models\Maintenance\Result;
use Spatie\Permission\Models\Role;
use App\Models\Maintenance\Currency;
use App\Models\Maintenance\Property;
use Illuminate\Support\Facades\Hash;
use App\Models\Maintenance\Inspector;
use App\Models\Users\UserDesignation;
use App\Models\Blacklist\BlackistType;
use App\Models\Maintenance\ReportType;
use App\Models\Maintenance\Origination;
use App\Models\Blacklist\BlackistStatus;
use App\Models\Maintenance\GroupSection;
use App\Models\Maintenance\ReportStatus;
use Spatie\Permission\Models\Permission;
use App\Models\Maintenance\IncidentTitle;
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

        $UserDesignation = [
            'Rank & File',
            'Supervisory',
            'Asst. Manager',
            'Manager',
            'Operations Manager',
            'Asst. Director',
            'Director',
        ];
        foreach ($UserDesignation as $q) {
            UserDesignation::create(['code' => $q, 'description' => $q,]);
        }

        $UserLevel = [
            'Suveillance  Operator',
            'Surveillance Supervisor',
            'Surveillance Asst Manager',
        ];
        foreach ($UserLevel as $q) {
            UserLevel::create(['code' => $q, 'description' => $q,]);
        }

        $origin = [
            'Gaming Treasury - Manager',
            'Gaming Treasury - Asst Director',
            'Gaming Treasury - Director',
            'Gaming Treasury - Sr Director',
            'Gaming Treasury - Cashier',
            'Gaming Treasury - Supervisor',
            'Gaming Ops- Ops Manager',
            'Gaming Ops- Asst Director',
            'Gaming Ops- Director',
            'Gaming Ops- Sr Director',
            'Gaming Ops- Pit Manager',
            'Gaming Ops- Asst Pit Manager',
            'Gaming Ops- Poker Supervisor',
            'Slots Ops- Ops Manager',
            'Slots Ops- Asst Director',
            'Slots Ops- Director',
            'Slots Ops- Sr Director',
            'Slots Ops- Supervisor',
            'Slots Ops- Operations Manager',
            'Slots Ops- Manager',
            'Slots Ops- Asst Manager',
            'VIP Services - Manager',
            'VIP Services - Director',
            'VIP Services - Sr Director',
            'Gaming Security - Asst Manager',
            'Gaming Security - Manager',
            'Gaming Security - Asst Director',
            'Gaming Security - GAA',
            'Gaming Security - Marshall',
            'Gaming Security - Coordinator',
            'Credit & Revenue Officer',
            'Rating Team',
            'Surveillance',
            'Others',
        ];
        foreach ($origin as $q) {
            Origination::create(['code' => $q, 'description' => $q]);
        }

        $property = [
            "D'Heights",
        ];
        foreach ($property as $q) {
            Property::create(['code' => $q, 'description' => $q]);
        }

        $incidenttitle = [
            'Key-in ',
            'Buy-in / Chip Change',
            'Overpayment',
            'Underpayment',
            'Cash / Chip Handling',
            'Cash / Chip Scanning',
            'Credit Card',
            'Notification',
            'Clean Hands',
            'Equipment',
            'Grooming',
            'On-Off / In-Out',
            'Other',
            'Rolling False',
            'Incomplete Chip Change',
            'Chip Type',
            'Wrong Update',
            'Seal Emergency',
            'Emergency',
            'Fill / Credit',
            'Valid Claim',
            'Lock / Key Change',
            'Variance',
            'Mismatch',
            'Collection',
            'Complaint',
            'Poor Service',
            'Review',
            'Security Risk',
            'Softcount',
            'Invalid Claim',
            'Audit',
            'Close Watch',
            'eTRAK',
            'Investigation',
            'Observation',
            'Tip',
            'Shuffle Violation',
            'Card Placement',
            'Card Reconstruction',
            'Jackpot Violation',
            'Dealing',
            'Function Coverage',
            'E-Result',
            'Layout Scan',
            'Gaming Equipment',
            'Incorrect Voiding',
            'Inspection',
            'Table Limit',
            'Pay / Take',
            'Rolling',
            'Roulette',
            'Card Burning',
            'Overdrawn Card',
            'Chip Change',
            'Game Declaration',
            'Marker / Cards Passed Out',
            'Uncollected Bet',
            'Table Error',
            'Insurance',
            'Softcount Exception - Overpayment',
            'Softcount Exception - Underpayment',
            'Dispute',
            'Cards',
            'Commercial',
            'Opportunitism',
            'Fresh Bet',
            'Jackpot Hand',
            'Claim',
            'Losing Shoe',
            'Lost Property',
            'Unauthorize Use',
            'Losing Bet',
            'Winning Bet',
            'Rating Review',
            'Alter Wager',
            'Tampering',
            'Unclaim',
            'Profiling',
            'Frisking',
            'Loitering',
            'Conversation',
            'Theft',
            'Tip Pocketing',
            'Failed Clock-in / out',
            'Fraternization',
            'Loser Paid',
            'Patron Profile Tracking',
            'Audit - Slots',
            'Audit - Table Games',
            'Audit - Gaming Treasury',
            'Audit - Membership',
            'Audit - VIP Services',
            'Audit - F&B',
            'Tip Soliciting',
            'Collusion',
        ];
        foreach ($incidenttitle as $q) {
            IncidentTitle::create(['code' => $q, 'description' => $q]);
        }

        $reporttype = [
            'CPVR',
            'Error Report',
            'Incident Report',
            'Surveillance',
            'Safety Hazard',
            'Security Risk',
            'Procedural Violation',
            'Good Customer Service',
            'Poor Customer Service',
            'Good Practice',
            'Bad Practice',
            'Person of Interest',
            'Red Flag',
            'Target Observation',
            'NVR Checking',
            'Equipment Report',
            'Camera Concern',
            'Medical Assistance',
            'Vehicular Incident',
            'Irresponsible Parenting',
            'Intercepted Items',
            'Reported Incident',
            'Guest Complaint',
            'Missing Item',
            'Lost and Found',
            'Request Verification / Review',
            'SPIR',
            'Employee Monitoring',
            'Guest Monitoring',
            'Barred Patron',
            'Parking Violation',
            'Elevator / Escalator Concern',
            'Access Door Concern',
            'Fire / Panic Alarm Activation',
            'COVID Prevention & Control',
            'Target Monitoring',

        ];
        foreach ($reporttype as $q) {
            ReportType::create(['code' => $q, 'description' => $q]);
        }
    }
}
