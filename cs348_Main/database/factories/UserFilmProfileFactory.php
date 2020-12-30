<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserFilmProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFilmProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserFilmProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'favourite_film' => $this->faker->unique()->company,
            'film_reasoning' => $this->faker->paragraph,
            'profile_description' => $this->faker->paragraph,
            'image' => 'noImageUploaded.jpg',
        ];
    }
}
