<?php

namespace Database\Factories;

use App\Models\PostGenre;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostGenreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostGenre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => $this->faker->numberBetween(1, 2),
            'genre_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
