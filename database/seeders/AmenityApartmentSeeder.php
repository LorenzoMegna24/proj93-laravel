<?php

namespace Database\Seeders;

use App\Models\Admin\Amenity;
use App\Models\Admin\Apartment;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenityApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { {

            $amenities = Amenity::all();
            $apartments = Apartment::all();


            foreach ($apartments as $apartment) {
                $selectedAmenities = $amenities->random(9);
                $apartment->amenities()->attach(
                    $selectedAmenities->pluck('id')->toArray()
                );
            }
        }
    }
}
