<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $users->each(function ($user) {
            Project::factory(2)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}

