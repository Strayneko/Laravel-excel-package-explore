<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'          => $this->faker->words(asText: true),
            'image_url'      => $this->faker->imageUrl(360, 360, 'movies', true),
            'description'    => $this->faker->paragraph(),
            'producer'       => $this->faker->company(),
            'production_fee' => $this->faker->numberBetween(10000, 100000),
            'release_date'   => $this->faker->date(),
            'revenue'        => $this->faker->numberBetween(10000, 100000),
        ];
    }
}
