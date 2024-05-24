<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model
{
    use HasFactory;
    protected $table = 'evaluate';
    protected $fillable =[
        'id_user',
        'id_book',
        'level',
        'created_at',
        'updated_at',
    ];
}
