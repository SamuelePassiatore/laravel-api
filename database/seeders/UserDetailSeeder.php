<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // Recover ids of all users
        $user_ids = User::pluck('id')->toArray();

        foreach ($user_ids as $user_id) {
            $user_detail = new UserDetail();
            $user_detail->user_id = $user_id;
            $user_detail->first_name = $faker->firstName();
            $user_detail->last_name = $faker->lastName();
            $user_detail->address = $faker->address();
            $user_detail->date_of_birth = $faker->dateTime();
            $user_detail->phone = $faker->phoneNumber();

            $user_detail->save();
        }
    }
}
