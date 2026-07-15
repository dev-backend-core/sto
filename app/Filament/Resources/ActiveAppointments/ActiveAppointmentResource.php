<?php

namespace App\Filament\Resources\ActiveAppointments;

use App\Filament\Resources\ActiveAppointments\Pages\CreateActiveAppointment;
use App\Filament\Resources\ActiveAppointments\Pages\EditActiveAppointment;
use App\Filament\Resources\ActiveAppointments\Pages\ListActiveAppointments;
use App\Filament\Resources\ActiveAppointments\Schemas\ActiveAppointmentForm;
use App\Filament\Resources\ActiveAppointments\Tables\ActiveAppointmentsTable;
use App\Models\Appointment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ActiveAppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationLabel = 'Все записи СТО';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    // Фильтруем: исключаем статус 'pending'
    public static function getEloquentQuery(): Builder
    {
        if(Auth::user()->role === 'mechanic'){
            $user = Auth::id();
            return parent::getEloquentQuery()->where('mechanic_id', $user);
        }
        return parent::getEloquentQuery()->where('status', '!=', 'new');
    }

    public static function form(Schema $schema): Schema
    {
        return ActiveAppointmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActiveAppointmentsTable::configure($table);
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
            'index' => ListActiveAppointments::route('/'),
            // 'create' => CreateActiveAppointment::route('/create'),
            // 'edit' => EditActiveAppointment::route('/{record}/edit'),
        ];
    }
}
