<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_order' => $this->faker->dateTime(),
            'total' => $this->faker->randomFloat(2,0,0),
            'route'=> $this->faker->colorName(),
            'client_id'=>\App\Models\Client::factory(),
        ];
    }
}