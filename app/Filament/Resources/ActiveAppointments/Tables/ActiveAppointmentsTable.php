<?php

namespace App\Filament\Resources\ActiveAppointments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\PaginationMode;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;

class ActiveAppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            // БЛОК 1: Клиент (Имя + Телефон снизу серым цветом)
                TextColumn::make('client.name')
                    ->label('Клиент')
                    ->description(fn ($record) => $record->client?->phone),

                // БЛОК 2: Автомобиль (Марка/Модель + Номер и VIN снизу)
                // Мы тянем это через связь с таблицей машин (car)
                TextColumn::make('car.brand') 
                    ->label('Автомобиль')
                    ->description(fn ($record) => "Госномер: {$record->car?->number_plate} | VIN: {$record->car?->vin}")
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->orWhereHas('car', function (Builder $query) use ($search) {
                            $query->where('number_plate', 'like', "%{$search}%")->orWhere('vin', 'like', "%{$search}%");
                        });
                    }), // ВОТ ОН, поиск по госномеру и вин-коду!

                // БЛОК 3: Работа (Какой механик делает + какая услуга)
                TextColumn::make('mechanic.name')
                    ->label('Исполнитель')
                    ->description(fn ($record) => $record->service?->name ?? 'Услуга не выбрана')
                    ->searchable(),

                // БЛОК 4: Время и Статус выполнения
                TextColumn::make('appointment_date')
                    ->label('Дата записи')
                    ->dateTime('d.m.Y H:i')
                    ->badge() 
                    ->sortable()
                    ->color(fn ($record) => match($record->status) {
                        'in_work' => 'primary',
                        'completed' => 'success',
                        'canceled' => 'danger',
                        default => 'info'
                    }),

                // БЛОК 5: Деньги и Оплата (Цена + иконка статуса рядом)
                TextColumn::make('service.price')
                    ->label('Стоимость')
                    ->money('RUB', locale:'ru') 
                    ->sortable(),

                IconColumn::make('payment_status')
                    ->label('Оплата')
                    ->options([
                        'heroicon-o-check-circle' => 'paid',
                        'heroicon-o-x-circle' => 'unpaid',
                    ])
                    ->colors([
                        'success' => 'paid',
                        'danger' => 'unpaid',
                    ]),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ])
            ->paginationMode(PaginationMode::Simple);
    }
}
