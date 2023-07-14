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
                'image' => 'amenity_image/001-wi-fi.png'
            ],
            [
                'name' => 'TV',
                'image' => 'amenity_image/002-television.png'
            ],
            [
                'name' => 'Parcheggio',
                'image' => 'amenity_image/003-parking.png'
            ],
            [
                'name' => 'Piscina',
                'image' => 'amenity_image/004-pool.png'
            ],
            [
                'name' => 'Aria Condizionata',
                'image' => 'amenity_image/006-air-conditioner.png'
            ],
            [
                'name' => 'Phon',
                'image' => 'amenity_image/007-hair-dryer.png'
            ],
            [
                'name' => 'Palestra',
                'image' => 'amenity_image/008-gym.png'
            ],
            [
                'name' => 'Biancheria',
                'image' => 'amenity_image/005-towel.png'
            ],
            [
                'name' => 'Sauna',
                'image' => 'amenity_image/004-jacuzzi.png'
            ],
            [
                'name' => 'Grucce',
                'image' => 'amenity_image/009-hanger.png'
            ],
            [
                'name' => 'Cassaforte',
                'image' => 'amenity_image/010-safe.png'
            ],
            [
                'name' => 'Lavatrice',
                'image' => 'amenity_image/002-washing-machine.png'
            ],
            [
                'name' => 'Cucina',
                'image' => 'amenity_image/003-restaurant.png'
            ],
            [
                'name' => 'Ascensore',
                'image' => 'amenity_image/005-elevator.png'
            ],
            [
                'name' => 'Accesso Disabili',
                'image' => 'amenity_image/001-disability.png'
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
