<?php

namespace Database\Seeders;

use App\Models\Admin\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                'apartment_id' => 1,
                'mail' => 'mircorossi@gmail.it',
                'name' => 'Mirco',
                'surname' => 'Rossi',
                'date' => '2022-06-30 11.25.50',
                'content' => "Salve, sarei interessato all'appartamento pubblicato, potete fornirmi ulteriori dettagli?",
            ],
            [
                'apartment_id' => 1,
                'mail' => 'elenabianchi@gmail.it',
                'name' => 'Elena',
                'surname' => 'Bianchi',
                'date' => '2023-02-17 17.49.20',
                'content' => "Vorrei sapere se l'affitto dell'appartamento è comprensivo di spese condominiali.",
            ],
            [
                'apartment_id' => 1,
                'mail' => 'andreamartini@gmail.it',
                'name' => 'Andrea',
                'surname' => 'Martini',
                'date' => '2023-06-30 19.02.47',
                'content' => "Ciao, potreste indicarmi la zona esatta dell'appartamento? Grazie!",
            ],
            [
                'apartment_id' => 2,
                'mail' => 'laurarusso@gmail.it',
                'name' => 'Laura',
                'surname' => 'Russo',
                'date' => '2022-04-10 20.22.49',
                'content' => "Buongiorno, è possibile fissare un'appuntamento per visionare l'appartamento di persona?",
            ],
            [
                'apartment_id' => 3,
                'mail' => 'alessioconti@gmail.it',
                'name' => 'Alessio',
                'surname' => 'Conti',
                'date' => '2023-07-25 08.14.58',
                'content' => 'Richiedo informazioni sulla durata minima del contratto di locazione per questo appartamento.',
            ],
            [
                'apartment_id' => 4,
                'mail' => 'chiaraesposito@gmail.it',
                'name' => 'Chiara',
                'surname' => 'Esposito',
                'date' => '2023-03-05 14.31.02',
                'content' => "Vorrei sapere se sono ammessi animali domestici nell'appartamento in affitto.",
            ],
            [
                'apartment_id' => 4,
                'mail' => 'lucaferrari@gmail.it',
                'name' => 'Luca',
                'surname' => 'Ferrari',
                'date' => '2022-12-06 18.10.33',
                'content' => "Salve, ci sono servizi pubblici e negozi nelle vicinanze dell'appartamento?",
            ],
            [
                'apartment_id' => 5,
                'mail' => 'giuliaromano@gmail.it',
                'name' => 'Giulia',
                'surname' => 'Romano',
                'date' => '2023-05-02 09.03.22',
                'content' => "Per favore, potreste farmi sapere quali elettrodomestici sono inclusi nell'affitto?",
            ],
        ];

        foreach ($messages as $elem) {
            $new_message = new Message();
            $new_message->apartment_id = $elem['apartment_id'];
            $new_message->mail = $elem['mail'];
            $new_message->name = $elem['name'];
            $new_message->surname = $elem['surname'];
            $new_message->date = $elem['date'];
            $new_message->content = $elem['content'];
            $new_message->save();
        }
    }
}
