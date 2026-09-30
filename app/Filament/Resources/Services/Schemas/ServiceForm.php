<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use App\Models\Product;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
       return $schema
    ->components([
        // БЛОК 1: Основная информация об услуге
        Section::make('Основная информация')
            ->description('Укажите базовые параметры услуги')
            ->schema([
                Grid::make(3) // Делим эту секцию на 3 колонки в один ряд
                    ->schema([
                        TextInput::make('name')
                            ->label('Название услуги')
                            ->required(),

                        TextInput::make('duration_minutes')
                            ->label('Длительность (мин.)')
                            ->required()
                            ->numeric(),

                        TextInput::make('price')
                            ->label('Стоимость (₽)')
                            ->required()
                            ->numeric(),
                    ]),
            ])
            ->compact(), // Делает отступы внутри секции чуть аккуратнее

        // БЛОК 2: Расходники (автоматически встанет ниже первого блока)
        Section::make('Расходные материалы')
            ->description('Материалы и продукты, используемые при оказании услуги')
            ->schema([
                Repeater::make('serviceProducts')
                    ->relationship('serviceProducts')
                    ->label('Расходные материалы для этой услуги') 
                    ->schema([
                        Select::make('product_id')
                            ->label('Расходник')
                            ->options(Product::pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('quantity_needed')
                            ->label('Количество')
                            ->numeric()
                            ->required()
                            ->default(1),
                    ])
                    ->columns(2)
                    ->defaultItems(0)
                    ->addActionLabel('Добавить расходник'),
            ]),
    ]);
    }
}
