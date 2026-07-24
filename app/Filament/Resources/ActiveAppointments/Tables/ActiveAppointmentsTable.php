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
use Illuminate\Support\Facades\Auth;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;

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
                    ->visible(fn () => Auth::user()->role === 'admin')
                    ->money('RUB', locale:'ru') 
                    ->sortable(),

                IconColumn::make('payment_status')
                    ->label('Оплата')
                    ->visible(fn () => Auth::user()->role === 'admin')
                    ->options([
                        'heroicon-o-check-circle' => 'paid',
                        'heroicon-o-x-circle' => 'unpaid',
                    ])
                    ->colors([
                        'success' => 'paid',
                        'danger' => 'unpaid',
                    ]),
            ])
            ->actions([
            // Кнопка "Принять"
                Action::make('accept')
                    ->label('Принять заказ')
                    ->color('success')
                    // Кнопка видна ТОЛЬКО механику и ТОЛЬКО для записей со статусом 'pending'
                    ->visible(fn ($record) => Auth::user()->role === 'mechanic' && $record->status === 'confirmed')
                    
                    // Открываем форму внутри модалки для ввода VIN и номера
                    ->form([
                        TextInput::make('vin')
                            ->label('VIN-номер')
                            ->length(17),
                        TextInput::make('number_plate')
                            ->label('Номер машины')
                            ->required(),
                    ])
                    // Сохраняем данные при отправке формы
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => 'in_work',
                        ]);

                        // 2. Обновляем VIN и госномер в связанной таблице машин (car)
                        if ($record->car) {
                            $record->car->update([
                                'vin' => $data['vin'],
                                'number_plate' => $data['number_plate'],
                            ]);
                        }
                    }),

                // Кнопка "Отклонить"
                Action::make('decline')
                    ->label('Отклонить')
                    ->color('danger')
                    ->visible(fn ($record) => Auth::user()->role === 'mechanic' && $record->status === 'confirmed')
                    ->requiresConfirmation() // Спросить "Вы уверены?"
                    ->action(fn ($record) => $record->update(['status' => 'canceled'])),
            ])
            ->paginationMode(PaginationMode::Simple);
    }
}
