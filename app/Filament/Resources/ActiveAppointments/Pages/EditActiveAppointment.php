<?php

namespace App\Filament\Resources\ActiveAppointments\Pages;

use App\Filament\Resources\ActiveAppointments\ActiveAppointmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditActiveAppointment extends EditRecord
{
    protected static string $resource = ActiveAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
