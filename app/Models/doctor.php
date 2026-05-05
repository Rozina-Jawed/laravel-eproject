<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\City;
use App\Models\DoctorProfile;
use App\Models\Appointment;

class Doctor extends Model
{
    use HasFactory;

  protected $table = 'doctor';
    protected $primaryKey = 'doctor_id';
    public $incrementing = true;

    protected $fillable = [
        'doctor_name',
        'doctor_email',
        'doctor_password',
        'doctor_age',
        'doctor_cv',
        'doctor_specialization',
        'city_id',
        'status',   // ✅ added from Model-2 (important)
        'doctor_phone' // ✅ added from Model-2
    ];

    // ✅ Default status pending (from Model-2)
    protected $attributes = [
        'status' => 'pending'
    ];

    // ✅ Password hashing (from Model-2)
    public function setDoctorPasswordAttribute($value)
    {
        $this->attributes['doctor_password'] = Hash::make($value);
    }

    // =========================
    // RELATIONS (merged safe)
    // =========================

    // City relation (same)
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    // Appointments (Model-1 + improved imports)
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'doctor_id');
    }

    // Profile relation (same)
    public function profile()
    {
        return $this->hasOne(DoctorProfile::class, 'doctor_id', 'doctor_id');
    }
}
