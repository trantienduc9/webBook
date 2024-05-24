<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    use HasFactory;
    protected $table = 'private_messages';
    protected $fillable = [
        'private_chat_id',
        'sender_id',
        'message',
        'created_at',
        'updated_at',
    ];

    public function mychat()
    {
        return $this->belongsTo(ChatPrivate::class,'private_chat_id', 'id');
    }

}
