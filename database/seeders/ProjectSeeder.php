<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // Recover ids types
        $type_ids = Type::select('id')->pluck('id')->toArray();
        $type_ids[] = null;

        // Recover ids technologies
        $technologies_ids = Technology::select('id')->pluck('id')->toArray();

        // Recover ids users
        $user_ids = User::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $project = new Project();

            $project->type_id = Arr::random($type_ids);
            $project->user_id = Arr::random($user_ids);
            $project->title = $faker->sentence;
            $project->description = $faker->paragraph();
            // $project->image = "https://picsum.photos/id/" . $faker->numberBetween(1, 50) . "/200";
            $project->slug = Str::slug($project->title, '-');
            $project->url = $faker->url();
            $project->is_public = $faker->boolean();
            $project->save();

            // Generate random ids related to projects
            $project_technologies = [];
            foreach ($technologies_ids as $technology_id) {
                if ($faker->boolean()) $project_technologies[] = $technology_id;
            }
            $project->technologies()->attach($project_technologies);
        }
    }
}
