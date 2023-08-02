<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Paolo',
                'surname' => 'Rossi',
                'email' => 'paolorossi@gmail.com',
                'password' => Hash::make('password'),
                'birth_date' => '1982-07-11',
            ],
            [
                'name' => 'Mario',
                'surname' => 'Bianchi',
                'email' => 'mail2@gmail.com',
                'password' => Hash::make('password'),
                'birth_date' => '1989-11-09',
            ],
            [
                'name' => 'Luigi',
                'surname' => 'Verdi',
                'email' => 'mail3@gmail.com',
                'password' => Hash::make('password'),
                'birth_date' => '1993-01-28',
            ],
            [
                'name' => 'Sofia',
                'surname' => 'Ferrari',
                'email' => 'mail4@gmail.com',
                'password' => Hash::make('password'),
                'birth_date' => '1995-03-05',
            ],
            [
                'name' => 'Marta',
                'surname' => 'Russo',
                'email' => 'mail5@gmail.com',
                'password' => Hash::make('password'),
                'birth_date' => '2001-09-11',
            ],
        ];

        foreach ($users as $elem) {
            $new_user = new User();
            $new_user->name = $elem['name'];
            $new_user->surname = $elem['surname'];
            $new_user->email = $elem['email'];
            $new_user->password = $elem['password'];
            $new_user->birth_date = $elem['birth_date'];
            $new_user->save();
        }
    }
}
