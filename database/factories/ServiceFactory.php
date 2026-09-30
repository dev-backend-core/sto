<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Замена масла', 'Ремонт подвески', 'Шиномонтаж', 'Развал-схождение', 'Диагностика электрики']),
            'price' => $this->faker->numberBetween(1000, 15000), // Цена в рублях/гривнах
            'duration_minutes' => $this->faker->randomElement([30, 60, 90, 120]),
        ];
    }
}
