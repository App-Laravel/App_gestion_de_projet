<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\Project\src\Models\Project;
use Modules\Task\src\Models\Task;
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

        // Seeder for table projects
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


        // Seeder for table users_projects
        // for ($i=1; $i<=10; $i++){
        //     DB::table('users_projects')->insert([
        //         'user_id'       => random_int(1,7),
        //         'project_id'    => random_int(1, 21),
        //         'created_at'    => now(),
        //         'updated_at'    => now()
        //     ]);
        // }


        // Seeder for table tasks
        // for ($i=1; $i<=20; $i++){
        //     $tasks = new Task();
        //     $tasks->title = fake()->text(30);
        //     $tasks->status = random_int(1,3);
        //     $tasks->priority = random_int(1,3);
        //     $tasks->due_date = Carbon::tomorrow();
        //     $tasks->project_id = random_int(1, 31);
        //     $tasks->creator_id = random_int(1, 10);
        //     $tasks->comment = fake()->text(50);
        //     $tasks->save();
        // }


        // Seeder for table users_tasks
        // for ($i=1; $i<=20; $i++){
        //     DB::table('users_tasks')->insert([
        //         'user_id'       => random_int(1,7),
        //         'task_id'    => random_int(2, 21),
        //         'created_at'    => now(),
        //         'updated_at'    => now()
        //     ]);
        // }


    }
}
