<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'recipient_id', 'message', 'read'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function getSenderNameAttribute()
    {
        return $this->sender->name;
    }

    public function getRecipientNameAttribute()
    {
        return $this->recipient->name;
    }
}
