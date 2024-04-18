<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->colorName,
            'description' => $this->faker->sentence, 
            'price'=>$this->faker->randomFloat(2,0,1000),
            'image' => $this->faker->imageUrl(), // Genera una URL aleatoria para una imagen
            'provider_id'=>\App\Models\Provider::factory(), 
        ];
    }
}
