<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes,HasFactory;
    protected $fillable = ['name', 'phone', 'email'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
