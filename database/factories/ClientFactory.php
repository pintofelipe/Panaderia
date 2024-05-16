<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'document' => $this->faker->numberBetween(1234567890, 2134567890),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'registered_by' => \App\Models\User::factory(),
            'status' => "1",
        ];
    }
}