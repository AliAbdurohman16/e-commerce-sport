<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'user_id', 'subtotal', 'is_checkout'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = 'ORD' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }
}
