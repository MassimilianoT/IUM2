<?php

namespace Database\Factories;

use App\Models\Play;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlayUser>
 */
class PlayUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'play_id' => Play::factory(),
            'user_id' => User::factory(),
        ];
    }
}
