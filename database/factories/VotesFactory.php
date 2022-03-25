<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class VotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique(true)->numberBetween(1, 10),
            'answer_id' => $this->faker->unique(true)->numberBetween(1, 50),
            'vote' => Arr::random([-1, 1]),
        ];
    }
}
