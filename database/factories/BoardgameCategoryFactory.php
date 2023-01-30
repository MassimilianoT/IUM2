<?php

namespace Database\Factories;

use App\Models\Boardgame;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoardgameCategory>
 */
class BoardgameCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'boardgame_id' => Boardgame::factory(),
            'category_id' => Boardgame::factory(),
        ];
    }
}
