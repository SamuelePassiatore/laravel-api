<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $labels = ['HTML', 'CSS', 'Bootstrap', 'Vue JS', 'PHP', 'MySQL', 'SASS', 'Laravel'];

        foreach ($labels as $label) {
            $new_technology = new Technology();
            $new_technology->label = $label;
            $new_technology->color = $faker->hexColor();
            $new_technology->save();
        }
    }
}
