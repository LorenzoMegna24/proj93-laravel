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
        $messages=[
            [
                'apartment_id' => 1,
                'mail' => 'message@test.it',
                'name' => 'prova',
                'surname' => 'messaggio',
                'date' => '2022-06-30 11.18.50',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus dolor ullam non optio? Consequatur, deleniti obcaecati eligendi ab accusantium, est autem accusamus, velit commodi modi fugiat blanditiis quaerat ipsam expedita?',
            ],
            [
                'apartment_id' => 1,
                'mail' => 'message1@test.it',
                'name' => 'prova',
                'surname' => 'messaggio',
                'date' => '2022-06-30 11.18.50',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus dolor ullam non optio? Consequatur, deleniti obcaecati eligendi ab accusantium, est autem accusamus, velit commodi modi fugiat blanditiis quaerat ipsam expedita?',
            ],
            [
                'apartment_id' => 3,
                'mail' => 'message@test.it',
                'name' => 'prova',
                'surname' => 'messaggio',
                'date' => '2022-06-30 11.18.50',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus dolor ullam non optio? Consequatur, deleniti obcaecati eligendi ab accusantium, est autem accusamus, velit commodi modi fugiat blanditiis quaerat ipsam expedita?',
            ],
            [
                'apartment_id' => 4,
                'mail' => 'message@test.it',
                'name' => 'prova',
                'surname' => 'messaggio',
                'date' => '2022-06-30 11.18.50',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus dolor ullam non optio? Consequatur, deleniti obcaecati eligendi ab accusantium, est autem accusamus, velit commodi modi fugiat blanditiis quaerat ipsam expedita?',
            ],
            [
                'apartment_id' => 5,
                'mail' => 'message@test.it',
                'name' => 'prova',
                'surname' => 'messaggio',
                'date' => '2022-06-30 11.18.50',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus dolor ullam non optio? Consequatur, deleniti obcaecati eligendi ab accusantium, est autem accusamus, velit commodi modi fugiat blanditiis quaerat ipsam expedita?',
            ]
        ];

        foreach ($messages as $elem){
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
