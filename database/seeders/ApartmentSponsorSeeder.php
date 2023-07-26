<?php

namespace Database\Seeders;

use App\Models\Admin\Apartment;
use App\Models\Admin\Sponsor;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'apartment_id' => 1,
                'sponsor_id' => 1,
                'start_date' => now()->setTimezone('Europe/Rome'),
                'end_date' => now()->setTimezone('Europe/Rome')->addHours(24),
            ],
            [
                'apartment_id' => 2,
                'sponsor_id' => 2,
                'start_date' => now()->setTimezone('Europe/Rome'),
                'end_date' => now()->setTimezone('Europe/Rome')->addHours(72),
            ],
            [
                'apartment_id' => 5,
                'sponsor_id' => 3,
                'start_date' => now()->setTimezone('Europe/Rome'),
                'end_date' => now()->setTimezone('Europe/Rome')->addHours(144),
            ],
            [
                'apartment_id' => 8,
                'sponsor_id' => 1,
                'start_date' => now()->setTimezone('Europe/Rome'),
                'end_date' => now()->setTimezone('Europe/Rome')->addHours(24),
            ],
            [
                'apartment_id' => 12,
                'sponsor_id' => 2,
                'start_date' => now()->setTimezone('Europe/Rome'),
                'end_date' => now()->setTimezone('Europe/Rome')->addHours(72),
            ],
            [
                'apartment_id' => 15,
                'sponsor_id' => 1,
                'start_date' => now()->setTimezone('Europe/Rome'),
                'end_date' => now()->setTimezone('Europe/Rome')->addHours(24),
            ],
            [
                'apartment_id' => 17,
                'sponsor_id' => 2,
                'start_date' => now()->setTimezone('Europe/Rome'),
                'end_date' => now()->setTimezone('Europe/Rome')->addHours(72),
            ],
            [
                'apartment_id' => 20,
                'sponsor_id' => 3,
                'start_date' => now()->setTimezone('Europe/Rome'),
                'end_date' => now()->setTimezone('Europe/Rome')->addHours(144),
            ],


        ];

        DB::table('apartment_sponsor')->insert($data);
    }
}
