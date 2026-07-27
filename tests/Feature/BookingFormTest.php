<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Service;
use App\Models\User;
use Livewire\Livewire;
use Filament\Facades\Filament;
use App\Filament\Resources\ActiveAppointments\Pages\ListActiveAppointments;
use App\Filament\Resources\Clients\Pages\ListClients;
use App\Models\Appointment;

class BookingFormTest extends TestCase
{
    use RefreshDatabase;
    public function test_order_to_sto(): void
    {
        $service = Service::factory()->create();
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->post(route('form'), [
            'name'       => 'Иван Иванов',
            'email'      => 'ivan@example.com',
            'phone'      => '+79991112233',
            'car_brand'  => 'Toyota (RAV4)',
            'service_id' => $service->id,
            'date'       => now()->addDay()->format('Y-m-d'),
            'time'       => '14:30',
        ]);

        $response->assertSessionHasNoErrors();

        // Посмотрим, что реально лежит в таблице clients:
        // dd(\App\Models\Client::all()->toArray());

        // Проверяем, что запись сохранилась в БД
        $this->assertDatabaseHas('clients', [
            'email' => 'ivan@example.com',
            'name' => 'Иван Иванов',
        ]);

        $this->assertDatabaseHas('cars', [
            'brand' => 'Toyota',
            'model' => 'RAV4',
        ]);

        // Проверяем редирект (или статус 200/302)
        $response->assertSessionHasNoErrors();

        // 2. Админ заходит в админку и проверяет таблицу заявок
        $appointment = Appointment::latest()->first();
        $appointment->update([
            'status' => 'confirmed', // подставьте статус, который ожидает страница
        ]);

        Livewire::actingAs($admin)
        ->test(ListActiveAppointments::class)
        ->assertCanSeeTableRecords([$appointment]); // Спец-метод Filament для проверки записей в таблице!
    }

    public function test_guest_is_redirected_to_login_page()
    {
        $response = $this->get(ListActiveAppointments::getUrl());

        // Перенаправляет на страницу логина админки
        $response->assertRedirect(route('filament.admin.auth.login')); 
    }

    public function test_mechanic_gets_forbidden_status()
    {
        $client = User::factory()->create(['role' => 'mechanic']);

        $response = $this->actingAs($client)
            ->get(ListClients::getUrl());

        $response->assertRedirect('admin/active-appointments');
    }

    public function test_admin_can_access_active_appointments_page(){
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)
            ->get(ListActiveAppointments::getUrl());

        $response->assertStatus(200);
    }
}
