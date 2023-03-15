<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $user = new User();

        $user->name = 'Samuele Passiatore';
        $user->email = 'semmisno2@protonmail.com';
        $user->password = 'ciaobianca';

        $user->save();

        for ($i = 0; $i < 2; $i++) {

            $user = new User();
            $user->name = $faker->firstName();
            $user->email = $faker->email();
            $user->password = 'password';

            $user->save();
        }
    }
}
