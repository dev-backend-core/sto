<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes,HasFactory;
    protected $fillable = ['name', 'price', 'duration_minutes'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity_needed')->withTimestamps();
    }
}
