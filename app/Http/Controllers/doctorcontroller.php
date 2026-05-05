<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;
use App\Models\DoctorProfile;
use App\Models\DoctorSetting;
use App\Models\City;
use App\Models\appointment;

class DoctorController extends Controller
{
    // 🔹 LOGIN PAGE
    public function doctorlogin() {
        return view('doctor.doctorwelcome');
    }

    // 🔹 LOGIN PROCESS
    public function login(Request $request) {
        $request->validate([
            "doctor_email" => "required|email",
            "doctor_password" => "required"
        ]);

        $doctor = Doctor::where('doctor_email', $request->doctor_email)->first();

        if ($doctor && Hash::check($request->doctor_password, $doctor->doctor_password)) {

            $request->session()->regenerate();

            session([
                'doctor_id' => $doctor->doctor_id,
                'doctor_name' => $doctor->doctor_name,
                'doctor_email' => $doctor->doctor_email,
                'doctor_specialization' => $doctor->doctor_specialization,
                'doctor_logged_in' => true
            ]);

            return redirect('/docdashboard'); // dashboard pe redirect
        }

        return back()->with('error', 'Invalid email or password');
    }

    // 🔹 DASHBOARD
    public function docdashboard() {
        $doctor = Doctor::find(session('doctor_id'));
        return view('doctor.doctordashboard', compact('doctor'));
    }

    // 🔹 APPOINTMENTS LIST
   public function doctorAppointments() {
    $doctorId = session('doctor_id'); // ya login session
   $appointments = Appointment::where('doctor_id', $doctorId)
    ->with('patient')
    ->orderBy('appointment_date', 'asc')
    ->orderBy('appointment_time', 'asc')
    ->get();
    return view('doctor.appointments', compact('appointments'));
}

    // 🔹 ACCEPT APPOINTMENT
   public function appointmentAction(Request $request) {
    $request->validate([
        'appointment_id' => 'required|exists:appointments,id',
        'action' => 'required|in:accepted,rejected'
    ]);

    $appointment = Appointment::findOrFail($request->appointment_id);
    $appointment->status = $request->action;
    $appointment->save();

    return back()->with('success', 'Appointment status updated.');
}

    // 🔹 PROFILE VIEW
    public function doctorprofile() {
        $doctor = Doctor::find(session('doctor_id'));
        $profile = DoctorProfile::firstOrNew(['doctor_id' => session('doctor_id')]);
        return view('doctor.doctorprofile', compact('doctor', 'profile'));
    }

    // REGISTER PAGE
    public function doctorregister() {
        $cities = \DB::table('care_cities')->get(); // 👈 Correct table name
        return view('doctor.doctorregister', compact('cities'));
    }

    // REGISTER PROCESS
   public function register(Request $req) {
    $req->validate([
        "doctor_name" => "required",
        "doctor_age" => "required|numeric",
        "doctor_email" => "required|email|unique:doctor,doctor_email",
        "doctor_password" => "required|min:6",
        "doctor_cv" => "required|file|mimes:pdf,doc,docx,png,jpg,jpeg",
        "doctor_specialization" => "required",
        "city_id" => "required|exists:care_cities,id"
    ]);

    $doctor = new Doctor();
    $doctor->doctor_name = $req->doctor_name;
    $doctor->doctor_age = $req->doctor_age;
    $doctor->doctor_email = $req->doctor_email;
    $doctor->doctor_password = $req->doctor_password; // ✅ no Hash::make here, model does it

    if ($req->hasFile('doctor_cv')) {
        $file = $req->file('doctor_cv');
        $name = time() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('doctor_cv'), $name);
        $doctor->doctor_cv = $name;
    }

    $doctor->doctor_specialization = $req->doctor_specialization;
    $doctor->city_id = $req->city_id;
    $doctor->save();

    return redirect('/doctorlogin')->with('success', 'Registered successfully, wait until admin approves');
}

    // 🔹 PROFILE SAVE/UPDATE
    public function doctor_profile(Request $request) {
        $request->validate([
            "doctor_profile_image" => "nullable|image|mimes:jpg,jpeg,png",
            "doctor_hospital" => "required|string",
            "available_time" => "required|string",
            "available_day" => "required|array",
            "doctor_first_fee" => "required|numeric",
            "doctor_sale_fee" => "required|numeric"
        ]);

        $profile = DoctorProfile::firstOrNew(['doctor_id' => session('doctor_id')]);

        if ($request->hasFile('doctor_profile_image')) {
            $file = $request->file('doctor_profile_image');
            $name = time().".".$file->getClientOriginalExtension();
            $file->move(public_path('doctor_profile_image'), $name);
            $profile->doctor_profile_image = $name;
        }

        $profile->doctor_id = session('doctor_id');
        $profile->doctor_hospital = $request->doctor_hospital;
        $profile->available_day = json_encode($request->available_day);
        $profile->available_time = $request->available_time;
        $profile->doctor_experience = $request->doctor_experience ?? null;
        $profile->doctor_degree = $request->doctor_degree ?? null;
        $profile->doctor_gender = $request->doctor_gender ?? null;
        $profile->doctor_phone_number = $request->doctor_phone_number ?? null;
        $profile->doctor_first_fee = $request->doctor_first_fee;
        $profile->doctor_sale_fee = $request->doctor_sale_fee;

        $profile->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    // 🔹 LOGOUT
    public function logout() {
        session()->flush();
        return redirect('/doctorlogin')->with('success', 'Logged out successfully!');
    }

    // 🔹 SETTINGS PAGE
    public function doctorsetting() {
        $settings = DoctorSetting::firstOrNew(['doctor_id' => session('doctor_id')]);
        return view('doctor.doctorsetting', compact('settings'));
    }

    // 🔹 SAVE SETTINGS
    public function saveDoctorsetting(Request $request) {
        DoctorSetting::updateOrCreate(
            ['doctor_id' => session('doctor_id')],
            [
                'availability_status' => $request->has('availability_status'),
                'online_consultation' => $request->has('online_consultation'),
                'emergency_booking' => $request->has('emergency_booking'),
                'sms_notifications' => $request->has('sms_notifications'),
                'email_notifications' => $request->has('email_notifications'),
            ]
        );

        return back()->with('success', 'Settings updated successfully!');
    }

    // 🔹 DELETE ACCOUNT
    public function deleteDoctorAccount() {
        $doctorId = session('doctor_id');

        DoctorProfile::where('doctor_id', $doctorId)->delete();
        Doctor::where('doctor_id', $doctorId)->delete();

        session()->flush();
        return redirect('/')->with('success', 'Account deleted successfully');
    }




}
