<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patientprofile extends Model
{
    use HasFactory;

    protected $table = "patient_profile";
    protected $primaryKey = "patient_profile_id";

    // ✅ same as your Model 1 (kept unchanged logically)
    protected $fillable = [
        "doctor_profile_image",
        "doctor_gender",
        "doctor_phone_number"
    ];

    // 🔥 ADDED (safe improvement from standard Laravel practice)
    public $timestamps = true;

    // 🔥 ADDED missing foreign key field awareness (important fix)
    protected $casts = [
        'patient_id' => 'integer',
    ];

    // ⚠️ FIXED suggestion (based on correct Laravel convention)
    public function patient()
    {
        return $this->belongsTo(Patientregister::class, 'patient_id');
    }
}
