<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Grid::make(1) // Указываем 1 колонку, чтобы всё встало друг под друга
                ->schema([
                    TextInput::make('name')
                        ->label('Название') // Желательно добавить человеческое название
                        ->required(),
                        
                    TextInput::make('stock_quantity')
                        ->label('Количество на складе')
                        ->required()
                        ->numeric()
                        ->default(0),
                        
                    TextInput::make('price')
                        ->label('Цена')
                        ->required()
                        ->numeric(),
            ]),
        ]);
    }
}
