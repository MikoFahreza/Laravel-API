<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run()
    {
        Task::create([
            'title' => 'Finish Alpha Documentation',
            'description' => 'Complete the documentation for Project Alpha.',
            'user_id' => 1,
            'project_id' => 1,
        ]);

        Task::create([
            'title' => 'Start Beta Development',
            'description' => 'Begin the development of Project Beta.',
            'user_id' => 2,
            'project_id' => 2,
        ]);
    }
}
