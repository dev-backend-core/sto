<?php

namespace App\Filament\Resources\ActiveAppointments\Pages;

use App\Filament\Resources\ActiveAppointments\ActiveAppointmentResource;
use App\Filament\Widgets\TableLegendWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()->role ==='mechanic'){
            return [];
        }

        return [
            TableLegendWidget::class, // Подключаем наш созданный виджет
        ];
    }

    public function getTabs(): array
    {
        if(Auth::user()->role ==='mechanic'){
             return [
                'pending' => Tab::make('Ожидают')
                    ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'confirmed')),
                'accepted' => Tab::make('В работе')
                    ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'in_work')),
             ];
        }
        return [];
    }

}
