<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;

class Product extends Model
{
    use HasFactory, Taggable;

    protected $fillable = ['name', 'slug', 'description', 'price', 'stock', 'colors', 'sizes', 'weight', 'unit', 'category_id'];

    // protected $casts = [
    //     'colors' => 'json',
    //     'sizes' => 'json',
    // ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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
