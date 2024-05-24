<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatPublic extends Model
{
    use HasFactory;
    protected $table = 'chatpublic';
    protected $fillable =[
        'id_user',
        'id_send',
        'message',
        'created_at',
        'updated_at',
    ];
}
