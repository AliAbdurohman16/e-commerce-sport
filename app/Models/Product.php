<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'colors', 'sizes'];

    protected $casts = [
        'colors' => 'json',
        'sizes' => 'json',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
