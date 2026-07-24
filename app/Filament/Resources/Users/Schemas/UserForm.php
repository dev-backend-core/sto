<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state)) // Сохранять в БД только если поле заполнено
                    ->required(fn (string $context): bool => $context === 'create') // Обязательно только при создании
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                Select::make('role')
                    ->options(['admin' => 'Admin', 'owner' => 'Owner', 'mechanic' => 'Mechanic'])
                    ->default('mechanic')
                    ->required(),
            ]);
    }
}
