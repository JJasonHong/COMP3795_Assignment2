<?php

namespace Database\Factories;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticlesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Articles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Title' => $this->faker->sentence,
            'Body'  => $this->faker->paragraph,
            'CreatDate' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'StartDate' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'EndDate'   => $this->faker->dateTimeBetween('now', '+3 months'),
            'ContributorUsername' => $this->faker->userName,
        ];
    }
}
