<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'status', 'subtotal'];

    protected static function boot()
    {
        parent::boot();

        // Creates a new order id when the model is saved to the database
        static::creating(function ($model) {
            $model->id = 'ORD' . str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
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
}
