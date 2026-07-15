<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Enums\PaginationMode;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Стоимость')
                    ->money('RUB',locale:'ru')
                    ->sortable(),
                TextColumn::make('stock_quantity')
                    ->label('Остаток на складе')
                    ->numeric()
                    ->suffix(' шт.')
                    ->sortable(),
                TextColumn::make('id')
                    ->label('Статус')
                    ->badge()
                    ->sortable(query: function ($query, string $direction) {
                        return $query
                            ->orderByRaw('deleted_at IS NOT NULL ' . $direction)
                            ->orderBy('stock_quantity', $direction === 'asc' ? 'desc' : 'asc');
                    })
                    ->formatStateUsing(function ($record) {
                        if ($record->deleted_at) {
                            return 'Неактивно';
                        }

                        if ($record->stock_quantity === 0) {
                            return 'Нет в наличии';
                        }

                        return 'Активно';
                    })
                    ->color(function ($record) {
                        if($record->deleted_at){
                            return 'danger';
                        }
                        if ($record->stock_quantity === 0) {
                            return 'gray';
                        }
                        return 'success';
                    }),
                
            ])
            ->filters([
                // TrashedFilter::make(),
            ])
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
