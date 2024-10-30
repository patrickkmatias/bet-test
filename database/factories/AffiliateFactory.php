<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Affiliate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Affiliate>
 */
class AffiliateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'birthdate' => fake()->date(),
            'cpf' => fake()->unique()->cpf(),
            'phone_number' => fake()->cellphoneNumber()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Affiliate $affiliate) {
            $affiliate->address()->create(Address::factory()->make()->toArray());
        });
    }
}
