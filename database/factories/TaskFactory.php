<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'id' => $this->faker->uuid(),
            'title' => $this->faker->sentence(),
            'user_id' => $user->id,
            'description' => $this->faker->paragraph(),
            'completed' => $this->faker->boolean(),
        ];
    }
}
