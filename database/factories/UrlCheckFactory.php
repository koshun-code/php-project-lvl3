<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class UrlCheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url_id' => $this->faker->numberBetween(1, 5),
            'updated_at' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),            
        ];
    }
}
