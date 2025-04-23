<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_user extends Model
{
      use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'email',
        'phone_number',
        'address',
        'sex',
    ];  
}
