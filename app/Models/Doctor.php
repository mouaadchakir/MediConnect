<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'specialization',
        'sex',
        'license_number',
        'email',
        'phone_number',
        'address',
        'working_hours',
        'status',
        'number_of_patients',
        'rating',
        'experience',
        'certifications',
    ];
}
