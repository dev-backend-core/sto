<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;
use Carbon\Carbon;

class StatsOverview extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '15s';
   
    protected static ?int $sort = 1;
    
    
    protected function getStats(): array
    {
        $monthlyRevenue = Appointment::where([
                ['status', '=', 'completed'],
                ['payment_status', '=', 'paid'],
            ])
            ->whereMonth('updated_at', Carbon::now()->month)
            ->withSum('service', 'price') // Laravel добавит виртуальное поле service_sum_price
            ->get()
            ->sum('service_sum_price'); // Складываем полученные суммы в коллекции

        return [
            Stat::make('Машин в работе', Appointment::where('status', 'in_work')
            ->count())
                ->description('Прямо сейчас в боксах')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('primary'),
            Stat::make('Выручка за месяц', number_format($monthlyRevenue, 0, '.', ' ') . ' ₽')
                ->description('За текущий календарный месяц')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Новые заявки', Appointment::where('status', 'new')->count())
                ->description('Ожидают обработки')
                ->descriptionIcon('heroicon-m-bell-alert', IconPosition::Before)
                ->color(Appointment::where('status', 'new')->exists() ? 'danger' : 'gray'),
        ];
    }

    protected function getHeading(): ?string
    {
        return 'Analytics';
    }

    protected function getDescription(): ?string
    {
        return 'An overview of some analytics.';
    }
}
