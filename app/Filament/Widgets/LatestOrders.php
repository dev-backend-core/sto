<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class LatestOrders extends TableWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    
    // Живое обновление таблицы каждые 10 секунд
    protected static ?string $pollingInterval = '10s'; 

    protected static ?string $heading = 'Живая очередь (Последние 5 записей)';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Вытягиваем последние 5 записей, у которых статус НЕ завершен (они еще в очереди или в работе)
                Appointment::query()
                    ->whereIn('status', ['new', 'in_work']) 
                    ->latest()
                    ->limit(6)
            )
            ->columns([
                TextColumn::make('appointment_date')
                    ->label('Дата/Время')
                    ->dateTime('M j, Y  / H:i')
                    
                    ->sortable(),
                // Выводим название услуги через связь 'service'
                TextColumn::make('service.name')
                    ->label('Услуга'),

                TextColumn::make('service.price')
                    ->label('Стоимость')
                    ->money('RUB', locale: 'ru'),

                // Статус в виде красивого цветного бэйджа
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',     // Красный для новых
                        'in_work' => 'warning', // Желтый/Оранжевый для тех, что в работе
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'Новая заявка',
                        'in_work' => 'В работе',
                        default => $state,
                    }),
            ])
            // Отключаем пагинацию, так как это мини-виджет строго на 5 строк
            ->paginated(false)
            ->defaultSort('status', direction: 'desc');
    
    }
}
