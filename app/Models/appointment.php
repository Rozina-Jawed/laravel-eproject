<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'appointment_date',
        'appointment_time',
        'notes',
        'status'
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    // Doctor relation (OK)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }

    // ✅ FIXED patient relation
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
