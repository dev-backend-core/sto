<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Box;
use App\Models\Car;
use App\Models\Client;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Хозяин СТО',
            'email' => 'boss@gmail.com',
        ]);

        $mechanics = User::factory(5)->create(); // 5 фейковых механиков (Николаевич, Васильевич и т.д.)

        // 2. Создаем Боксы, Услуги и Товары
        $boxes = Box::factory(4)->create(); // 4 рабочих бокса
        $products = Product::factory(10)->create(); // 20 видов товаров на складе
        $services = Service::factory(5)->create(); // 10 видов услуг


        // Связываем Услуги и Товары (Many-to-Many) через pivot
        $services->each(function ($service) use ($products) {
            $service->products()->attach(
                $products->random(rand(1, 3))->pluck('id')->toArray(),
                ['quantity_needed' => rand(1, 4)]
            );
        });

        $clients = Client::factory(5)->create(); // 15 клиентов
        $clients->each(function ($client) use ($mechanics, $services, $boxes) {
            // Создаем клиенту от 1 до 2 машин
            $cars = Car::factory(rand(1, 2))->create(['client_id' => $client->id]);

            // Для каждой машины генерируем несколько записей на ремонт
            $cars->each(function ($car) use ($client, $mechanics, $services, $boxes) {
                Appointment::factory(rand(1, 2))->create([
                    'client_id' => $client->id,
                    'car_id' => $car->id,
                    'service_id' => $services->random()->id,
                    'box_id' => $boxes->random()->id,
                    'mechanic_id' => $mechanics->random()->id,
                ]);
            });
        });
    }
}
