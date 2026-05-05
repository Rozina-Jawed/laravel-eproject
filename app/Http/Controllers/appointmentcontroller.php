<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    // Show booking form
    public function showBookingForm($doctor_id)
    {
        $doctor = Doctor::findOrFail($doctor_id);
        return view('patient.book_appointment', compact('doctor'));
    }

    // Store appointment
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctor,doctor_id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'notes' => 'nullable|string'
        ]);

        $patient_id = session('patient_id');

        // Check double booking
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->exists();

        if($exists){
            return back()->with('error', 'This slot is already booked!');
        }

       Appointment::create([
    'doctor_id' => $request->doctor_id,
    'patient_id' => $patient_id,
    'appointment_date' => $request->appointment_date,
    'appointment_time' => $request->appointment_time,
    'notes' => $request->notes
]);

$doctor = Doctor::find($request->doctor_id);

return redirect('/patientdashboard')->with('success',
    'Your appointment is booked. Please wait until Dr. ' . $doctor->doctor_name . ' accepts your appointment.'
);
    }

    // Doctor sees appointments
    public function doctorAppointments()
    {
        $doctor_id = session('doctor_id');
        $appointments = Appointment::with('patient')
                        ->where('doctor_id', $doctor_id)
                        ->orderBy('appointment_date','asc')
                        ->get();

        return view('doctor.appointments', compact('appointments'));
    }

    // Accept appointment
public function updateStatus(Request $request, Appointment $appointment)
{
    $status = $request->input('status'); // Blade me 'status' diya hai
    if(!in_array($status, ['accepted', 'rejected'])){
        return back()->with('error', 'Invalid action!');
    }

    $appointment->status = $status;
    $appointment->save();

    return back()->with('success', 'Appointment ' . $status . ' successfully!');
}

public function myAppointments()
{
    $patient_id = session('patient_id');

    $appointments = Appointment::with('doctor')
        ->where('patient_id', $patient_id)
        ->orderBy('appointment_date', 'desc')
        ->get();

    return view('patient.appointments', compact('appointments'));
}
}
