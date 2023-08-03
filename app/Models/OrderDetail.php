<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'size', 'color', 'quantity', 'total', 'review'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        if ($this->order) {
            return $this->order->user;
        }

        return null;
    }

    public function shippings()
    {
        return $this->order()->with('shippings');
    }

    public function transactions()
    {
        return $this->order()->with('transactions');
    }
}
