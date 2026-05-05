<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patient';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'patient_name',
        'patient_age',
        'patient_email',
        'patient_password',
        'status'
    ];

    protected $hidden = [
        'patient_password',
        'remember_token',
    ];

    // Relationships
    public function patientprofile()
    {
        return $this->hasOne(PatientProfile::class, 'patient_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
