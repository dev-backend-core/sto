<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::User; //изменение icon таблицы
    protected static ?string $modelLabel = 'cliente'; 
    protected static ?string $navigationLabel = 'Mis Clientes';//изменение названия таблицы
    protected static string | UnitEnum | null $navigationGroup = 'Shop';
    protected static ?string $slug = 'pending-orders'; //url
    
    protected static string|Htmlable|null $navigationBadgeTooltip = 'The number of users';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    // Добавлено: Этот метод управляет цветом бэйджа в зависимости от условий
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 1 ? 'primary' : 'primary';
    }

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->role === 'admin';
    }
}
