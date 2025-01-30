<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'deadline' => $this->faker->date(),
            'completed' => $this->faker->boolean,
            'user_id' => User::factory(),
        ];
    }
}
