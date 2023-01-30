<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Boardgame;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuthorBoardgame>
 */
class AuthorBoardgameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author_id' => Author::factory(),
            'boardgame_id' => Boardgame::factory(),
        ];
    }
}
