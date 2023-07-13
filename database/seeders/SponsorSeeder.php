<?php

namespace Database\Seeders;

use App\Models\Admin\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'name' => 'Silver',
                'price' => 2.99,
                'duration' => '24h'
            ],
            [
                'name' => 'Gold',
                'price' => 5.99,
                'duration' => '72h'
            ],
            [
                'name' => 'Platinum',
                'price' => 9.99,
                'duration' => '144h'
            ],
        ];

        foreach ($sponsors as $elem) {
            $new_sponsor = new Sponsor();
            $new_sponsor->name = $elem['name'];
            $new_sponsor->price = $elem['price'];
            $new_sponsor->duration = $elem['duration'];
            $new_sponsor->save();
        }
    }
}
