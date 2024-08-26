<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visitors = [
            [
                'date' => '2024-07-18',
                'first_name' => 'Ma\'am',
                'middle_name' => 'Arlyn',
                'last_name' => 'Aquino',
                'person_to_visit' => 'CITE',
                'purpose' => 'Payment',
                'time_in' => '12:23:00',
            ],
            [
                'date' => '2024-07-17',
                'first_name' => 'Test',
                'middle_name' => 'mic',
                'last_name' => 'Test Scripts',
                'person_to_visit' => 'Lorem ipsum cloraime',
                'purpose' => 'Payment',
                'time_in' => '11:24:00',
            ],
            [
                'date' => '2024-07-17',
                'first_name' => 'testing',
                'middle_name' => '',
                'last_name' => '11',
                'person_to_visit' => 'CITE',
                'purpose' => 'Enrollment po',
                'time_in' => '10:50:00',
            ],
            [
                'date' => '2022-02-23',
                'first_name' => 'mogswara',
                'middle_name' => '',
                'last_name' => 'Luffytaro',
                'person_to_visit' => 'Gomu gomuno rackett',
                'purpose' => 'gear 5',
                'time_in' => '08:37:00',
            ],
            [
                'date' => '2024-07-11',
                'first_name' => 'David',
                'middle_name' => 'Earl',
                'last_name' => 'Gabriel',
                'person_to_visit' => 'CITE',
                'purpose' => 'Enrollment',
                'time_in' => '07:48:00',
            ],
            [
                'date' => '2024-07-10',
                'first_name' => 'Test',
                'middle_name' => 'Naming1233444',
                'last_name' => 'perds',
                'person_to_visit' => 'Department 123224235cgd',
                'purpose' => 'Purpose it',
                'time_in' => '07:13:00',
                'remarks' => ''
            ],
            [
                'date' => '2024-07-17',
                'first_name' => 'Test',
                'middle_name' => 'Name 123',
                'last_name' => 'ngeks',
                'person_to_visit' => 'Department 123',
                'purpose' => 'Purpose 1234557809',
                'time_in' => '07:11:00',
                'remarks' => ''
            ],
            [
                'date' => '2024-07-17',
                'first_name' => 'Frank',
                'middle_name' => 'datu',
                'last_name' => 'nako',
                'person_to_visit' => 'test 123 lang po ito kasi di niya alam kung gagana sana gumaguys',
                'purpose' => 'testing only',
                'time_in' => '18:45:00',
            ],
            [
                'date' => '2024-07-18',
                'first_name' => 'test47',
                'middle_name' => '',
                'last_name' => 'nice',
                'person_to_visit' => 'Visit 231',
                'purpose' => 'Purpose.....',
                'time_in' => '07:55:00',

            ],
        ];

        DB::table('visitors')->insert($visitors);
    }
}
