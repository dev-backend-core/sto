<?php

namespace App\Filament\Resources\NewAppointments\Pages;

use App\Filament\Resources\NewAppointments\NewAppointmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNewAppointment extends EditRecord
{
    protected static string $resource = NewAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
