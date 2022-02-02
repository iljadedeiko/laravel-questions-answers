<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Question::class;

    public function definition()
    {
        return [
            'title' => rtrim($this->faker->sentence(rand(5, 10)), "."),
            'body' => $this->faker->paragraphs(rand(3, 7), true),
            'views' => rand(0, 10),
            'answers' => rand(0, 10),
            'votes' => rand(-3, 10)
        ];
    }
}
