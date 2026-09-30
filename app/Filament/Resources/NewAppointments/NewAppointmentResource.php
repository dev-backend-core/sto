<?php

namespace App\Filament\Resources\NewAppointments;


use App\Filament\Resources\NewAppointments\Pages\ListNewAppointments;
use App\Filament\Resources\NewAppointments\Schemas\NewAppointmentForm;
use App\Filament\Resources\NewAppointments\Tables\NewAppointmentsTable as TablesNewAppointmentsTable;
use App\Models\Appointment;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class NewAppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    // Меняем название вкладки в меню
    protected static ?string $navigationLabel = 'Новые заявки';
    protected static ?string $pluralModelLabel = 'Новые заявки';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bell';
    // Заставляет Filament проверять счетчик в меню каждые 3 секунды
    protected static string|Htmlable|null $navigationBadgeTooltip = 'Новые заявки с сайта';
   
   

    // Фильтруем: показывать ТОЛЬКО со статусом 'new'
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('status', 'new');
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return 'success'; // 'danger' сделает его красным, 'success' — зеленым
    }

    // public static function form(Schema $schema): Schema
    // {
    //     return NewAppointmentForm::configure($schema);
    // }

    public static function table(Table $table): Table
    {
        return TablesNewAppointmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNewAppointments::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
