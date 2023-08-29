<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\Project\src\Models\Project;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $priority = ['high', 'medium', 'low'];
        // for ($i=1; $i<=10; $i++){
        //     $project = new Project();
        //     $project->name = fake()->text(30);
        //     //$project->priority = $priority[array_rand($priority)];
        //     $project->priority = random_int(1,3);
        //     $project->start_date = Carbon::now();
        //     $project->due_date = Carbon::tomorrow();
        //     $project->creator_id = random_int(1, 7);
        //     $project->comment = fake()->text(50);
        //     $project->save();
        // }

        for ($i=1; $i<=10; $i++){
            DB::table('users_projects')->insert([
                'user_id'       => random_int(1,7),
                'project_id'    => random_int(1, 21),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }


    }
}
