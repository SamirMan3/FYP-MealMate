<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentLog extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $fillable = [
        'doctor_id',
        'user_id',
    ];
}
