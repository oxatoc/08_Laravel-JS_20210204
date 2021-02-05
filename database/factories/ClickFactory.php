<?php

namespace Database\Factories;

use App\Models\Click;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClickFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Click::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'clickX' => $this->faker->randomFloat(5, 0, 1000)
            , 'clickY' => $this->faker->randomFloat(5, 0, 1000)
            , 'click_unix_time_utc' => $this->faker->dateTimeBetween('-2 weeks')
        ];
    }
}
