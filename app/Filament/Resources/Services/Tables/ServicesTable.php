<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Enums\PaginationMode;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название услуги')
                    ->searchable(),
                TextColumn::make('duration_minutes')
                    ->label('Длительность')
                    ->numeric()
                    ->suffix(' мин')
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Базовая стоимость')
                    ->money('RUB',locale:'ru')
                    ->sortable(),
                TextColumn::make('id')
                    ->label('Расходники (кол-во)')
                    // formatStateUsing позволяет нам дописать количество к имени товара
                    ->formatStateUsing(function ($record) {

                        if ($record->products->isEmpty()) {
                            return 'Без расходников';
                        }
                        // Перебираем все связанные продукты этой услуги
                        return $record->products->map(function ($product) {
                            $qty = $product->pivot->quantity_needed ?? 0; 
                            return "• {$product->name} ({$qty} шт.)";
                        })->implode("<br>"); // Разделяем их переносом строки
                    })
                    ->html(), // Разрешаем перенос строк

                TextColumn::make('id')
                    ->label('Статус')
                    ->badge()
                    ->formatStateUsing(fn ($record) => $record->deleted_at ? 'Неактивно' : 'Активно')
                    ->color(fn ($record) => $record->deleted_at ? 'danger' : 'success')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->paginationMode(PaginationMode::Simple)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
