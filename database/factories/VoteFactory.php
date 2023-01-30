<?php

namespace Database\Factories;

use App\Models\Boardgame;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'vote' => $this->faker->numberBetween(1,10),
            'boardgame_id' => Boardgame::factory()
        ];
    }
}
