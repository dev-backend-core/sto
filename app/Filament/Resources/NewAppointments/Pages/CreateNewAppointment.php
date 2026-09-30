<?php

namespace App\Filament\Resources\NewAppointments\Pages;

use App\Filament\Resources\NewAppointments\NewAppointmentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewAppointment extends CreateRecord
{
    protected static string $resource = NewAppointmentResource::class;
}
