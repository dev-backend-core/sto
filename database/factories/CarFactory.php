<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // client_id мы не пишем жестко, его назначит Сидер
            'brand' => $this->faker->randomElement(['Toyota', 'BMW', 'Mercedes', 'Audi', 'Kia', 'Hyundai']),
            'model' => $this->faker->randomElement(['X5', 'Camry', 'E-Class', 'A6', 'Rio', 'Tucson']),
            'number_plate' => strtoupper($this->faker->bothify('?###??##')), // Имитация госномера
            'vin' => strtoupper($this->faker->bothify('*****************')), // 17 символов
        ];
    }
}
