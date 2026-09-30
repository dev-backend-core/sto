<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // ID связей закинет сидер
            'appointment_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'), // Записи за прошлый и будущий месяц
            'status' => $this->faker->randomElement(['new', 'confirmed', 'in_work', 'completed', 'canceled']),
            'payment_status' => $this->faker->randomElement(['unpaid', 'paid']),
        ];
    }
}
