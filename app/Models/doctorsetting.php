<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctorsetting extends Model
{
    use HasFactory;
protected $table = 'doctor_settings';

    protected $fillable = [
        'doctor_id',
        'availability_status',
        'online_consultation',
        'emergency_booking',
        'sms_notifications',
        'email_notifications'
    ];
}

    