<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;
use App\Models\PatientProfile;
use App\Models\Doctor;
use App\Models\City;
use App\Models\Appointment;

class PatientController extends Controller
{
    // patientdashboard function
public function patientdashboard() {
    $doctors = Doctor::where('status', 'approved')->with('city')->get(); // only approved doctors
    $cities = City::all();

    return view('patient.patientdashboard', compact('doctors', 'cities'));
}

public function showDoctorProfile($id)
{
    $doctor = Doctor::with(['profile', 'city'])->findOrFail($id);

    return view('patient.doctorview', compact('doctor'));
}
    // 🔹 REGISTER
    public function patientregister() {
        return view('patient.patientregister');
    }

    public function patregister(Request $req) {
        $req->validate([
            "patient_name" => "required",
            "patient_age" => "required|numeric",
            "patient_email" => "required|email|unique:patient,patient_email",
            "patient_password" => "required|min:6",
        ]);

        $patient = new Patient();
        $patient->patient_name = $req->patient_name;
        $patient->patient_age = $req->patient_age;
        $patient->patient_email = $req->patient_email;
        $patient->patient_password = Hash::make($req->patient_password);
        $patient->save();

        return redirect('/patientlogin')->with('success', 'Registered successfully');
    }

    // 🔹 LOGIN
    public function patientlogin() {
        return view('patient.patientlogin');
    }

    public function patlogin(Request $request) {
        $request->validate([
            "patient_email" => "required|email",
            "patient_password" => "required"
        ]);

        $patient = Patient::where('patient_email', $request->patient_email)->first();

        if ($patient && Hash::check($request->patient_password, $patient->patient_password)) {
            $request->session()->regenerate();
            session([
                  'patient_id' => $patient->id,
                'patient_name' => $patient->patient_name,
                'patient_email' => $patient->patient_email,
                'patient_logged_in' => true
            ]);
            return redirect('/patientprofile');
        }

        return back()->with('error', 'Invalid email or password');
    }

    // 🔹 PATIENT PROFILE
    public function patientprofile() {
        if (!session()->has('patient_id')) {
            return redirect('/patientlogin')->with('error', 'Please login first');
        }

        $patient = Patient::find(session('patient_id'));
        $profile = PatientProfile::firstOrNew(['patient_id' => session('patient_id')]);

        return view('patient.patientprofile', compact('patient', 'profile'));
    }

    public function patient_profile(Request $request) {
        $request->validate([
            "patient_profile_image" => "nullable|image|mimes:jpg,jpeg,png",
            "patient_gender" => "nullable|string",
            "patient_phone_number" => "nullable|string",
        ]);

        $patientId = session('patient_id');
        $profile = PatientProfile::firstOrNew(['patient_id' => $patientId]);
        $profile->patient_id = $patientId;

        if ($request->hasFile('patient_profile_image')) {
            $file = $request->file('patient_profile_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('patient_profile_image'), $filename);
            $profile->patient_profile_image = $filename;
        }

        $profile->patient_gender = $request->patient_gender;
        $profile->patient_phone_number = $request->patient_phone_number;
        $profile->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    // Settings page view
public function patientsettings() {
    $patientId = session('patient_id');

    if (!$patientId) {
        return redirect('/patientlogin')->with('error', 'Please login first');
    }

    $patient = Patient::find($patientId);
    $profile = PatientProfile::firstOrNew(['patient_id' => $patientId]);

    return view('patient.patientsettings', compact('patient', 'profile'));
}
// update method
   public function updatePatientProfile(Request $request) {
    $patientId = session('patient_id');

    if (!$patientId) {
        return redirect('/patientlogin')->with('error', 'Please login first');
    }

    $profile = PatientProfile::firstOrNew(['patient_id' => $patientId]);
    $profile->patient_id = $patientId; // must set

    $request->validate([
        'patient_profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'patient_gender' => 'nullable|string',
        'patient_phone_number' => 'nullable|string|max:20',
    ]);

    $profile->patient_gender = $request->patient_gender;
    $profile->patient_phone_number = $request->patient_phone_number;

    if ($request->hasFile('patient_profile_image')) {
        $file = $request->file('patient_profile_image');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('patient_profile_image'), $filename);
        $profile->patient_profile_image = $filename;
    }

    $profile->save();

    return back()->with('success', 'Profile updated successfully!');
}

// Change password
public function changePatientPassword(Request $request) {
    $patientId = session('patient_id');
    $patient = Patient::findOrFail($patientId);

    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:6',
    ]);

    if (!\Hash::check($request->current_password, $patient->patient_password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    $patient->patient_password = \Hash::make($request->new_password);
    $patient->save();

    return back()->with('success', 'Password changed successfully!');
}

    // 🔹 LOGOUT
public function logout(Request $request) {
    $request->session()->flush(); // session clear
    return redirect('/patientlogin')->with('success', 'Logged out successfully');
}


// searchDoctor function
public function searchDoctor(Request $request) {
    $query = Doctor::where('status', 'approved'); // filter approved only

    if ($request->city_id) {
        $query->where('city_id', $request->city_id);
    }

    if ($request->specialization) {
        $query->where('doctor_specialization', 'like', '%'.$request->specialization.'%');
    }

    $doctors = $query->with('city')->get();
    $cities = City::all();

    return view('patient.patientdashboard', compact('doctors','cities'));
}

    // 🔹 SHOW ALL DOCTORS
public function allDoctors() {
    $doctors = Doctor::where('status', 'approved')->with('city')->get(); // only approved doctors
    $cities = City::all();

    return view('patient.patientdashboard', compact('doctors', 'cities'));
}

    // 🔹 APPOINTMENT FORM
public function appointmentForm($doctor_id) {
    $doctor = Doctor::with('profile','city')->findOrFail($doctor_id);
    return view('patient.appointment_form', compact('doctor'));
}
    // 🔹 BOOK APPOINTMENT
  public function bookAppointment(Request $request) {
    $request->validate([
        'doctor_id' => 'required|exists:doctors,doctor_id',
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required',
        'notes' => 'nullable|string|max:500'
    ]);

    $exists = Appointment::where('doctor_id', $request->doctor_id)
                ->where('date', $request->date)
                ->where('time', $request->time)
                ->exists();

    if ($exists) {
        return back()->with('error', 'This slot is already booked.');
    }

    Appointment::create([
        'doctor_id' => $request->doctor_id,
        'patient_id' => session('patient_id'),
        'date' => $request->date,
        'time' => $request->time,
        'notes' => $request->notes,
        'status' => 'pending'
    ]);

    return redirect('/patientdashboard')->with('success','Appointment booked successfully.');
}



                 //DELETE LOGIC
public function deletePatientAccount(Request $request)
{
    $patientId = session('patient_id');

    if (!$patientId) {
        return redirect('/patientregister')->with('error', 'You must be logged in to delete your account.');
    }

    $patient = Patient::find($patientId);
    if (!$patient) {
        return redirect('/patientregister')->with('error', 'Patient not found.');
    }

    try {
        // Delete profile image if exists
        $profile = PatientProfile::where('patient_id', $patientId)->first();
        if ($profile && $profile->patient_profile_image) {
            $filePath = public_path('patient_profile_image/' . $profile->patient_profile_image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete related data: appointments
        Appointment::where('patient_id', $patientId)->delete();

        // Delete profile record
        if ($profile) {
            $profile->delete();
        }

        // Delete patient
        $patient->delete();

        // Clear session
        $request->session()->flush();

        // Redirect to register page with success message
        return redirect('/patientregister')->with('success', 'Your account has been deleted successfully.');
    } catch (\Exception $e) {
        // Redirect back with error message if something fails
        return back()->with('error', 'Failed to delete account. Please try again.');
    }
}
 public function learnmore() {
        return view('learnmore');
    }


}
