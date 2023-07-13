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
                'image' => ''
            ],
            [
                'name' => 'TV',
                'image' => ''
            ],
            [
                'name' => 'Parcheggio',
                'image' => ''
            ],
            [
                'name' => 'Piscina',
                'image' => ''
            ],
            [
                'name' => 'Aria Condizionata',
                'image' => ''
            ],
            [
                'name' => 'Phon',
                'image' => ''
            ],
            [
                'name' => 'Palestra',
                'image' => ''
            ],
            [
                'name' => 'Biancheria',
                'image' => ''
            ],
            [
                'name' => 'Sauna',
                'image' => ''
            ],
            [
                'name' => 'Grucce',
                'image' => ''
            ],
            [
                'name' => 'Cassaforte',
                'image' => ''
            ],
            [
                'name' => 'Lavatrice',
                'image' => ''
            ],
            [
                'name' => 'Cucina',
                'image' => ''
            ],
            [
                'name' => 'Ascensore',
                'image' => ''
            ],
            [
                'name' => 'Accesso Disabili',
                'image' => ''
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
