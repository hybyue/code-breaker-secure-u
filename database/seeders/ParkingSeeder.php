<?php

namespace Database\Seeders;

use App\Models\Parking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Parking::create([
            'license_no' => '123456',
            'first_name' => 'John',
            'middle_name' => 'A',
            'last_name' => 'Doe',
            'date_registered' => now(),
            'expiration_date' => now()->addYear(),
            'license_photo' => null,
        ]);
    }
}
