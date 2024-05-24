<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatPrivate extends Model
{
    use HasFactory;
    protected $table = 'chatprivate';
    protected $fillable = [
        'id',
        'id_send',
        'id_sent',
        'created_at',
        'updated_at',
    ];
    // Define the relationship with the User model
    public function sender()
    {
        return $this->belongsTo(User::class, 'id_send');
    }

    public function mymessage(){
        return $this->hasMany(PrivateMessage::class,"private_chat_id","id");
    }
}
