<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(5,10)),
            'description' => $this->faker->paragraph,
            'user_id' => rand(1,10),
        ];
    }
}
