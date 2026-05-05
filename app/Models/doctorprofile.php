<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    use HasFactory;

    protected $table = "doctor_profile";
    protected $primaryKey = "doctor_profile_id";

    protected $fillable = [
        "doctor_id",
        "doctor_profile_image",
        "doctor_hospital",
        "available_time",
        "available_day",
        "doctor_experience",
        "doctor_degree",
        "doctor_gender",
        "doctor_phone_number",
        "doctor_first_fee",
        "doctor_sale_fee"
    ];

    // ✅ ADDED from Model 2 (IMPORTANT FIX)
    protected $casts = [
        'available_day' => 'array',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
