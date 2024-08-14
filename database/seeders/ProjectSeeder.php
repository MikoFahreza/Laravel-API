<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'name' => 'Project Alpha',
            'description' => 'This is the first project.',
        ]);

        Project::create([
            'name' => 'Project Beta',
            'description' => 'This is the second project.',
        ]);
    }
}
