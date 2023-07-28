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
    public function run()
    {
        $apartments = [
            [
                'user_id' => 1,
                'title' => 'Casa Blu',
                'room' => 2,
                'bathroom' => 1,
                'bed' => 3,
                'sq_meters' => 80,
                'address' => 'Via Giorgio Washington, 10, Milano',
                'longitude' => 9.155164,
                'latitude' => 45.465105,
                'image' => 'apartment_image/01.jpg',
                'visibility' => 1,
            ],

            [
                'user_id' => 1,
                'title' => 'Casa Bianca',
                'room' => 4,
                'bathroom' => 2,
                'bed' => 6,
                'sq_meters' => 145,
                'address' => 'Via Plutarco, 12, Milano',
                'longitude' => 9.157465,
                'latitude' => 45.474811,
                'image' => 'apartment_image/02.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 1,
                'title' => 'Appartamento White Style',
                'room' => 3,
                'bathroom' => 2,
                'bed' => 6,
                'sq_meters' => 115,
                'address' => 'Via della Moscova, 31, Milano',
                'longitude' => 9.188225,
                'latitude' => 45.477040,
                'image' => 'apartment_image/03.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 1,
                'title' => 'Villa Mare Blu',
                'room' => 5,
                'bathroom' => 4,
                'bed' => 12,
                'sq_meters' => 245,
                'address' => 'Isola di San Pietro Località Carloforte',
                'longitude' => 8.258760,
                'latitude' => 39.106213,
                'image' => 'apartment_image/04.jpg',
                'visibility' => 0,
            ],
            [
                'user_id' => 2,
                'title' => 'Luxury Villa',
                'room' => 6,
                'bathroom' => 5,
                'bed' => 12,
                'sq_meters' => 260,
                'address' => 'Largo XXV Aprile, Monza',
                'longitude' => 9.273004,
                'latitude' => 45.584347,
                'image' => 'apartment_image/05.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 2,
                'title' => 'Loft Rosso',
                'room' => 2,
                'bathroom' => 1,
                'bed' => 2,
                'sq_meters' => 85,
                'address' => 'Via Magenta 21, Torino',
                'longitude' => 7.672213,
                'latitude' => 45.064101,
                'image' => 'apartment_image/06.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 2,
                'title' => 'Mansarda Bianca',
                'room' => 1,
                'bathroom' => 1,
                'bed' => 2,
                'sq_meters' => 70,
                'address' => 'Via San Gallo 18, Firenze',
                'longitude' => 11.257073,
                'latitude' => 43.778217,
                'image' => 'apartment_image/07.jpg',
                'visibility' => 0,
            ],
            [
                'user_id' => 2,
                'title' => 'Villa Ginevra',
                'room' => 5,
                'bathroom' => 5,
                'bed' => 10,
                'sq_meters' => 200,
                'address' => 'Via Francesco Atenasio, 18, Taormina',
                'longitude' => 15.287651,
                'latitude' => 37.858085,
                'image' => 'apartment_image/08.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 3,
                'title' => 'Casa Vacanze Sole&Mare',
                'room' => 5,
                'bathroom' => 5,
                'bed' => 10,
                'sq_meters' => 200,
                'address' => 'Via Grottone, 2, Polignano a Mare',
                'longitude' => 17.216203,
                'latitude' => 40.997887,
                'image' => 'apartment_image/09.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 3,
                'title' => 'Appartamento Perla Bianca',
                'room' => 2,
                'bathroom' => 1,
                'bed' => 2,
                'sq_meters' => 105,
                'address' => 'Via Giovanni Berchet, 26, Ostuni',
                'longitude' => 17.580187,
                'latitude' => 40.727272,
                'image' => 'apartment_image/10.jpg',
                'visibility' => 0,
            ],
            [
                'user_id' => 3,
                'title' => 'Casa sul Lago',
                'room' => 4,
                'bathroom' => 2,
                'bed' => 10,
                'sq_meters' => 150,
                'address' => 'Via Benaco, Nago-Torbole',
                'longitude' => 10.875061,
                'latitude' => 45.868772,
                'image' => 'apartment_image/11.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 3,
                'title' => 'Chalet Nora',
                'room' => 6,
                'bathroom' => 4,
                'bed' => 14,
                'sq_meters' => 210,
                'address' => 'Via Canneto, 1, Iseo',
                'longitude' => 10.043830,
                'latitude' => 45.657914,
                'image' => 'apartment_image/12.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 4,
                'title' => 'Villa Margherita',
                'room' => 8,
                'bathroom' => 6,
                'bed' => 16,
                'sq_meters' => 270,
                'address' => 'Via Brigantino, 17,Porto Cervo',
                'longitude' => 9.534806,
                'latitude' => 41.128690,
                'image' => 'apartment_image/13.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 4,
                'title' => 'Villa Apollo',
                'room' => 5,
                'bathroom' => 4,
                'bed' => 9,
                'sq_meters' => 175,
                'address' => 'Via Marina Grande, 123, Capri',
                'longitude' => 14.241320,
                'latitude' => 40.552411,
                'image' => 'apartment_image/14.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 4,
                'title' => 'Chalet Stella Alpina',
                'room' => 5,
                'bathroom' => 4,
                'bed' => 9,
                'sq_meters' => 175,
                'address' => 'Località Pecol, 62, Cortina d`Ampezzo',
                'longitude' => 12.142922,
                'latitude' => 46.539443,
                'image' => 'apartment_image/15.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 4,
                'title' => 'Garni Belvedere',
                'room' => 2,
                'bathroom' => 1,
                'bed' => 4,
                'sq_meters' => 110,
                'address' => 'Via Condemines, Morgex',
                'longitude' => 7.035667,
                'latitude' => 45.760478,
                'image' => 'apartment_image/16.jpg',
                'visibility' => 0,
            ],
            [
                'user_id' => 5,
                'title' => 'Masseria La Luna',
                'room' => 5,
                'bathroom' => 3,
                'bed' => 12,
                'sq_meters' => 195,
                'address' => 'Via Orte, Otranto',
                'longitude' => 18.502175,
                'latitude' => 40.139146,
                'image' => 'apartment_image/17.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 5,
                'title' => 'Appartamento Bosco Verticale',
                'room' => 2,
                'bathroom' => 1,
                'bed' => 4,
                'sq_meters' => 90,
                'address' => 'Via Gaetano de Castillia, 11, Milano',
                'longitude' => 9.190577,
                'latitude' =>  45.485556,
                'image' => 'apartment_image/18.jpg',
                'visibility' => 1,
            ],
            [
                'user_id' => 5,
                'title' => 'Appartamento vista Colosseo',
                'room' => 3,
                'bathroom' => 2,
                'bed' => 5,
                'sq_meters' => 115,
                'address' => 'Via di S. Giovanni in Laterano, Roma',
                'longitude' => 12.494600,
                'latitude' =>  41.890016,
                'image' => 'apartment_image/19.jpg',
                'visibility' => 0,
            ],
            [
                'user_id' => 5,
                'title' => 'Casa Mare Blu',
                'room' => 4,
                'bathroom' => 2,
                'bed' => 8,
                'sq_meters' => 140,
                'address' => 'Via Colombo, 6, Forte dei Marmi',
                'longitude' => 10.178384,
                'latitude' =>  43.948818,
                'image' => 'apartment_image/20.jpg',
                'visibility' => 1,
            ],


        ];

        foreach ($apartments as $elem) {
            $new_apartment = new Apartment();
            $new_apartment->user_id = $elem['user_id'];
            $new_apartment->title = $elem['title'];
            $new_apartment->room = $elem['room'];
            $new_apartment->bathroom = $elem['bathroom'];
            $new_apartment->bed = $elem['bed'];
            $new_apartment->sq_meters = $elem['sq_meters'];
            $new_apartment->address = $elem['address'];
            $new_apartment->longitude = $elem['longitude'];
            $new_apartment->latitude = $elem['latitude'];
            $new_apartment->image = $elem['image'];
            $new_apartment->visibility = $elem['visibility'];
            $new_apartment->slug = Str::slug($new_apartment->title, '-');
            $new_apartment->save();
        }
    }
}
