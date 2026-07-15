<?php

namespace App\Filament\Resources\ActiveAppointments\Pages;

use App\Filament\Resources\ActiveAppointments\ActiveAppointmentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateActiveAppointment extends CreateRecord
{
    protected static string $resource = ActiveAppointmentResource::class;
}
