<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Route;

class TableLegendWidget extends Widget
{
    protected string $view = 'filament.widgets.table-legend-widget';
    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        // Получаем имя текущего роута Laravel/Filament
        $currentRoute = Route::currentRouteName();

        // Разрешаем показ виджета ТОЛЬКО на странице списка услуг (записей СТО)
        // Замените 'filament.admin.resources.services.index' на имя вашего роута
        return $currentRoute === 'filament.admin.resources.active-appointments.index';
    }
}
