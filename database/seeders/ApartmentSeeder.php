<?php

namespace Database\Seeders;

use App\Models\Admin\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) { 
            $new_apartment = new Apartment();
            $new_apartment->title = $faker->sentence(3);
            $new_apartment->room = $faker->numberBetween(1, 5);
            $new_apartment->bathroom = $faker->numberBetween(1, 5);
            $new_apartment->bed = $faker->numberBetween(1, 4);
            $new_apartment->sq_meters = $faker->numberBetween(60, 300);
            $new_apartment->address = $faker->address();
            $new_apartment->longitude = $faker->longitude($min = -180, $max = 180);
            $new_apartment->latitude = $faker->latitude($min = -90, $max = 90);
            $new_apartment->image = $faker->imageUrl(640, 480, 'animals', true);
            $new_apartment->visibility = 1;
            $new_apartment->slug = Str::slug($new_apartment->title,'-');
            $new_apartment->save();
        }



    }
}
