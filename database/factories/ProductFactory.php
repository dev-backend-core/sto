<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'name' => $this->faker->randomElement(['Масло моторное 4L', 'Фильтр масляный', 'Тормозные колодки', 'Свеча зажигания', 'Антифриз 5L']),
            'stock_quantity' => $this->faker->numberBetween(5, 100),
            'price' => $this->faker->numberBetween(500, 8000),
        ];
    }
}
