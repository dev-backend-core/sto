<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use SoftDeletes,HasFactory;
    protected $fillable = [
        'client_id', 
        'car_id', 
        'service_id', 
        'box_id', 
        'mechanic_id', 
        'appointment_date', 
        'status', 
        'payment_status'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(User::class,'mechanic_id');
    }
}
