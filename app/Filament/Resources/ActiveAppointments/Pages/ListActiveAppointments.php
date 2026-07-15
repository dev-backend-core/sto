<?php

namespace App\Filament\Resources\ActiveAppointments\Pages;

use App\Filament\Resources\ActiveAppointments\ActiveAppointmentResource;
use App\Filament\Widgets\TableLegendWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;


class ListActiveAppointments extends ListRecords
{
    protected static string $resource = ActiveAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TableLegendWidget::class, // Подключаем наш созданный виджет
        ];
    }

}
