<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Boardgame>
 */
class BoardgameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'minPlayers' => 1,
            'maxPlayers' => 10,
            'editor' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(2)
        ];
    }
}
