<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProduct extends Model
{
    protected $table = 'product_service'; // имя вашей промежуточной таблицы

    protected $fillable = ['service_id', 'product_id', 'quantity_needed'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
