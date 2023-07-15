<?php

namespace Database\Seeders;

use App\Models\Admin\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = [
            [
                'name' => 'WiFi',
                'image' => 'amenities_image/001-wi-fi.png'
            ],
            [
                'name' => 'TV',
                'image' => 'amenities_image/002-television.png'
            ],
            [
                'name' => 'Parcheggio',
                'image' => 'amenities_image/003-parking.png'
            ],
            [
                'name' => 'Piscina',
                'image' => 'amenities_image/004-pool.png'
            ],
            [
                'name' => 'Aria Condizionata',
                'image' => 'amenities_image/006-air-conditioner.png'
            ],
            [
                'name' => 'Phon',
                'image' => 'amenities_image/007-hair-dryer.png'
            ],
            [
                'name' => 'Palestra',
                'image' => 'amenities_image/008-gym.png'
            ],
            [
                'name' => 'Biancheria',
                'image' => 'amenities_image/005-towel.png'
            ],
            [
                'name' => 'Sauna',
                'image' => 'amenities_image/004-jacuzzi.png'
            ],
            [
                'name' => 'Grucce',
                'image' => 'amenities_image/009-hanger.png'
            ],
            [
                'name' => 'Cassaforte',
                'image' => 'amenities_image/010-safe.png'
            ],
            [
                'name' => 'Lavatrice',
                'image' => 'amenities_image/002-washing-machine.png'
            ],
            [
                'name' => 'Cucina',
                'image' => 'amenities_image/003-restaurant.png'
            ],
            [
                'name' => 'Ascensore',
                'image' => 'amenities_image/005-elevator.png'
            ],
            [
                'name' => 'Accesso Disabili',
                'image' => 'amenities_image/001-disability.png'
            ],
        ];

        foreach ($amenities as $elem) {
            $new_sponsor = new Amenity();
            $new_sponsor->name = $elem['name'];
            $new_sponsor->image = $elem['image'];
            $new_sponsor->save();
        }
    }
}
