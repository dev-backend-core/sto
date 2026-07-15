<?php

namespace App\Filament\Resources\Clients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Enums\PaginationMode;
use Illuminate\Support\HtmlString;
use Filament\Tables\Table;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->description(function ($record): HtmlString {
                        return new HtmlString("Тел: {$record?->phone} <br> Email: {$record?->email}");
                    })
                    ->searchable(),

                    // Алгоритм для предотвращения дублирования записей
                TextColumn::make('client_car')
                    ->label('Автомобиль клиента')
                    ->state(function($record){
                        if ($record->cars->isEmpty()) {
                            return 'Нет автомобиля';
                        }

                        return $record->cars->map(function ($car){
                            return "<strong>{$car->brand}</strong>  {$car->model} <em>({$car->number_plate})</em>";
                        })->implode('<br>');
                        
                    })->html()
                   // Указываем Filament, в каких именно полях связанной таблицы искать!
                    ->searchable(query: function ($query, string $search) {
                        $query->whereHas('cars', function ($q) use ($search) {
                            $q->where('brand', 'like', "%{$search}%")
                            ->orWhere('model', 'like', "%{$search}%")
                            ->orWhere('number_plate', 'like', "%{$search}%");
                        });
                    }),
                TextColumn::make('appointments_count')
                    ->label('Кол-во визитов')
                    ->badge()
                    ->suffix(' раз')
                    ->color('info')
                    ->sortable(),

                TextColumn::make('appointments_sum_price')
                    ->label('Всего оплачено услуг:')
                    ->money('RUB',locale:'ru')
                    ->color('success')
                    ->weight('bold')
                    ->sortable(),
                TextColumn::make('latestAppointment.created_at') // Указываем связь.поле
                    ->label('Последнее обслуживание:')
                    ->color('gray')
                    ->state(function ($record): HtmlString {
                        if (! $record->latestAppointment) {
                            return new HtmlString('<em>Нет записей</em>');
                        }

                        $date = $record->latestAppointment->created_at->format('d.m.Y');
                        $mechanic = $record->latestAppointment?->mechanic->name;
                        $service = $record->latestAppointment->service->name;
                        // Оборачиваем в HtmlString, чтобы сработали теги <strong> или <em>
                        return new HtmlString("<em>{$date} — {$service} <br> (Механик: {$mechanic})</em>");
                    })->html()
                    ->sortable(), 
                    
            ])
            ->filters([
                // TrashedFilter::make(),
            ])
            ->recordActions([
                // EditAction::make(),
            ])
            ->paginationMode(PaginationMode::Simple)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    // ForceDeleteBulkAction::make(),
                    // RestoreBulkAction::make(),
                ]),
            ]);
    }
}
