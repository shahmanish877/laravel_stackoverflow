<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'answer' => $this->faker->paragraph,
            'user_id' => rand(1,10),
            'question_id' => rand(1,10),
            'votes' => rand(0,100),
        ];
    }
}
