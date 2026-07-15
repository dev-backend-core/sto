<?php

namespace App\Filament\Resources\NewAppointments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DateTimePicker;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use App\Models\Appointment;


class NewAppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')->label('Клиент'),
                TextColumn::make('client.phone')->label('Телефон'),
                TextColumn::make('appointment_date')
                ->label('Дата / Время')
                ->dateTime('d.m.Y в H:i') // Выведет: 10.07.2026 в 14:15
                ->sortable()
                
            ])->actions([
                // Создаем кастомную кнопку "Подтвердить"
                Action::make('confirm')
                    ->label('Подтвердить запись')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    
                    // При клике откроется модалка, где админ ОБЯЗАН выбрать механика
                    ->form([
                        DateTimePicker::make('appointment_date')
                            ->label('Дата и время записи')
                            ->required()
                            ->default(fn ($record) => $record?->appointment_date)
                            ->reactive(),
                        Select::make('mechanic_id')
                            ->label('Выберите мастера')
                            ->relationship('mechanic', 'name', modifyQueryUsing: function ($query, $record) {
                                // 1. Берем только пользователей с ролью механика
                                $query->where('role', 'mechanic');
                                $date = $record->appointment_date;
                                // 2. Если у текущей заявки есть дата/время, отсекаем занятых
                                if ($date) {
                                    $query->whereDoesntHave('appointments', function ($q) use ($date) {
                                        $q->where('appointment_date', $date)
                                        ->where('status', '!=', 'cancelled'); // отмененные записи не считаем
                                    });
                                }
                            })
                            ->required()
                            ->placeholder('Выберите мастера'),
                    ])
                    
                    // Что происходит после нажатия кнопки "Сохранить" в модалке:
                    ->action(function (Appointment $record, array $data): void {
                        $record->update([
                            'mechanic_id' => $data['mechanic_id'],
                            'appointment_date' => $data['appointment_date'],
                            'status' => 'confirmed', // Меняем статус на "Подтверждено"
                        ]);

                        unset($data);
                        redirect(request()->header('Referer'));
                    })
                    ->requiresConfirmation() // Спросить "Вы уверены?"
            ])
            ->paginated(false);
    }
}
