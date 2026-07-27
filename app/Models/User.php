<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

#[Fillable(['name', 'email', 'password','role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;


    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMechanic(): bool
    {
        return $this->role === 'mechanic';
    }

    public function appointments()
    {
        // Указываем чужой ключ 'mechanic_id', потому что Ларавель по умолчанию искал бы 'user_id'
        return $this->hasMany(Appointment::class, 'mechanic_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Разрешаем доступ и админу, и механику (всем, у кого есть роль)
        return in_array($this->role, ['admin', 'mechanic']);
    }
}
