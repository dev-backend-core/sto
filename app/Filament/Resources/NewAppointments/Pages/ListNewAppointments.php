<?php

namespace App\Filament\Resources\NewAppointments\Pages;

use App\Filament\Resources\NewAppointments\NewAppointmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNewAppointments extends ListRecords
{
    protected static string $resource = NewAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
