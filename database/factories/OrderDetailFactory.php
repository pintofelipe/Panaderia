<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subtotal' => $this->faker->numberBetween(1,10000),
            'quantity'=>$this->faker->numberBetween(1,10),
            'product_id'=>\App\Models\Product::factory(),
            'order_id'=>\App\Models\Order::factory(),
        ];
    }
}