<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Doctor;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use App\Models\PatientProfile;
use Exception;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin_logged_in')) {
                return redirect('/admin/login')->with('error', 'Please login first!');
            }
            return $next($request);
        })->except([
            'adminRegister',
            'adminRegisterStore',
            'adminLogin',
            'adminLoginStore',
            'adminLogout'
        ]);
    }

    // Admin Registration Form (Only First Time)
    public function adminRegister()
    {
        if (Admin::count() > 0) {
            return redirect('/admin/login')->with('error', 'Admin already registered! Please login.');
        }
        return view('admin.auth.register');
    }

    // Admin Registration Store
    public function adminRegisterStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/admin/login')->with('success', 'Admin registered successfully!');
    }

    // Admin Login Form
    public function adminLogin()
    {
        return view('admin.auth.login');
    }

    // Admin Login Store (SECURE VERSION)
    public function adminLoginStore(Request $request)
    {
        // Rate Limiting
        $key = 'admin-login:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->with('error', 'Too many login attempts. Try again in 1 minute.');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Clear previous failed attempts
            RateLimiter::clear($key);

            // Secure Session
            Session::put('admin_logged_in', true);
            Session::put('admin_name', $admin->name);
            Session::put('admin_id', $admin->id);
            Session::put('admin_email', $admin->email);
            Session::put('admin_login_time', time());
            Session::put('admin_ip', $request->ip());

            return redirect('/admin/dashboard')->with('success', 'Welcome ' . $admin->name . '!');
        }

        // Increment failed attempts
        RateLimiter::hit($key, 60);
        return back()->with('error', 'Invalid email or password!');
    }

    // Admin Logout
 public function adminLogout()
{
    // Get admin id from session
    $adminId = Session::get('admin_id');

    // Delete admin from database
    \DB::table('admins')->where('id', $adminId)->delete();

    // Clear session
    Session::flush();

    return redirect('/admin/register')->with('success', 'Admin removed. Please register again.');
}


// public function dashboard()
// {
//     $pendingDoctors = Doctor::where('status', 'pending')->with('city')->get();
//     $totalDoctors = Doctor::count();
//     $approvedDoctors = Doctor::where('status', 'approved')->count();
//     $rejectedDoctors = Doctor::where('status', 'rejected')->count();

//     return view('admin.dashboard', compact(
//         'pendingDoctors', 'totalDoctors', 'approvedDoctors', 'rejectedDoctors'
//     ));

// }




    // ✅ SINGLE doctorList METHOD (DUPLICATE REMOVED)
 public function doctorList()
{
    // ✅ care_cities table के साथ JOIN
    $doctors = \DB::table('doctor')
        ->leftJoin('care_cities', 'doctor.city_id', '=', 'care_cities.id')  // ✅ care_cities
        ->select('doctor.*', 'care_cities.city_name as city_name')
        ->when(request('status'), function($query, $status) {
            return $status === 'all' ? $query : $query->where('doctor.status', $status);
        })
        ->when(request('search'), function($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('doctor.doctor_name', 'like', "%{$search}%")
                  ->orWhere('doctor.doctor_email', 'like', "%{$search}%")
                  ->orWhere('doctor.doctor_specialization', 'like', "%{$search}%");
            });
        })
        ->orderByRaw("FIELD(doctor.status, 'pending', 'approved', 'rejected')")
        ->orderBy('doctor.created_at', 'desc')
        ->paginate(15);

    $pendingCount = \DB::table('doctor')->where('status', 'pending')->count();
    $approvedCount = \DB::table('doctor')->where('status', 'approved')->count();
    $rejectedCount = \DB::table('doctor')->where('status', 'rejected')->count();

    $pendingDoctors = \DB::table('doctor')
        ->leftJoin('care_cities', 'doctor.city_id', '=', 'care_cities.id')
        ->select('doctor.*', 'care_cities.city_name')
        ->where('doctor.status', 'pending')
        ->limit(5)
        ->get();

    return view('admin.doctor.index', compact(
        'doctors',
        'pendingCount',
        'approvedCount',
        'rejectedCount',
        'pendingDoctors'
    ));
}
    // Approve Doctor
   // AdminController.php
// AdminController.php - Replace approve/reject methods
// ✅ APPROVE DOCTOR - Direct DB
public function approveDoctor($id)
{
    DB::table('doctor')  // ✅ Table 'doctor'
        ->where('doctor_id', $id)
        ->update(['status' => 'approved']);

    return redirect('/admin/dashboard')->with('success', 'Doctor Approved! ✅');
}

// ✅ REJECT DOCTOR - Direct DB
public function rejectDoctor($id)
{
    DB::table('doctor')  // ✅ Table 'doctor'
        ->where('doctor_id', $id)
        ->update(['status' => 'rejected']);

    return redirect('/admin/dashboard')->with('success', 'Doctor Rejected! ❌');
}

// ✅ DASHBOARD - Also Fix
public function dashboard()
{
    // ✅ Direct DB Queries - NO Model issues
    $pendingDoctors = \DB::table('doctor')
        ->where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->limit(8)
        ->get();

    $totalDoctors = \DB::table('doctor')->count();
    $approvedDoctors = \DB::table('doctor')->where('status', 'approved')->count();
    $rejectedDoctors = \DB::table('doctor')->where('status', 'rejected')->count();

    $totalPatients = \DB::table('patient')->count();
    $totalAppointments = \DB::table('appointments')->count();
    $pendingAppointments = \DB::table('appointments')->where('status', 'pending')->count();

    return view('admin.dashboard', compact(
        'pendingDoctors',
        'totalDoctors',
        'approvedDoctors',
        'rejectedDoctors',
        'totalPatients',
        'totalAppointments',
        'pendingAppointments'
    ));
}
    // Other methods...
   public function setting()
{
    return view('admin.setting');
}

    public function saveCity(Request $request)
    {
        $request->validate([
            'city_name' => 'required'
        ]);

        City::create([
            'city_name' => $request->city_name
        ]);

        return back()->with('success', 'City added successfully!');
    }

    public function register(Request $request)
{
    $request->validate([
        'doctor_name' => 'required',
        'doctor_email' => 'required|email|unique:doctors',
        'doctor_password' => 'required|min:6',
        // other fields...
    ]);

    Doctor::create([
        'doctor_name' => $request->doctor_name,
        'doctor_email' => $request->doctor_email,
        'doctor_password' => Hash::make($request->doctor_password),
        'doctor_status' => 'pending'  // ✅ PENDING STATUS
    ]);

    return redirect('/doctorlogin')->with('success', 'Registration successful! Wait for admin approval.');
}

public function login(Request $request)
{
    $request->validate([
        'doctor_email' => 'required|email',
        'doctor_password' => 'required|min:6'
    ]);

    $doctor = Doctor::where('doctor_email', $request->doctor_email)->first();

    // ✅ More specific error messages
    if (!$doctor) {
        return back()->with('error', 'Doctor account not found!');
    }

    // ✅ Status-wise clear messages
    if ($doctor->doctor_status === 'pending') {
        return back()->with('error', '⏳ Account pending admin approval!');
    }

    if ($doctor->doctor_status === 'rejected') {
        return back()->with('error', '❌ Account rejected by admin!');
    }

    if ($doctor->doctor_status !== 'approved') {
        return back()->with('error', 'Account not approved yet!');
    }

    // ✅ Password check
    if (!Hash::check($request->doctor_password, $doctor->doctor_password)) {
        return back()->with('error', 'Invalid password!');
    }

    // ✅ Session + Redirect
    session([
        'doctor_logged_in' => true,
        'doctor_id' => $doctor->id,  // ya doctor_id
        'doctor_name' => $doctor->doctor_name,
        'doctor_email' => $doctor->doctor_email
    ]);

    return redirect('/doctordashboard')->with('success', 'Welcome ' . $doctor->doctor_name . '!');
}

// app/Http/Controllers/AdminController.php

public function adminAppointments()
{
    $appointments = \DB::table('appointments')
        ->leftJoin('doctor', 'appointments.doctor_id', '=', 'doctor.doctor_id')
        ->leftJoin('patient', 'appointments.patient_id', '=', 'patient.id')
        ->select(
            'appointments.*',
            'patient.patient_name as patient_name',
            'patient.patient_email as patient_email'
        )
        ->orderBy('appointments.appointment_date', 'asc')
        ->orderBy('appointments.appointment_time', 'asc')
        ->paginate(15);

    return view('admin.appointments', compact('appointments'));
}
public function adminPatients(Request $request)
{
    // ✅ DIRECT DB QUERY - Bypass Model Issue
    $patientsQuery = \DB::table('patient')  // ✅ YOUR TABLE NAME
        ->leftJoin('patient_profile', 'patient.id', '=', 'patient_profile.patient_id')
        ->leftJoin('appointments', 'patient.id', '=', 'appointments.patient_id')
        ->select('patient.*', 'patient_profile.patient_phone_number', 'patient_profile.patient_gender')
        ->when($request->search, function($query, $search) {
            return $query->where('patient_name', 'like', "%{$search}%")
                         ->orWhere('patient_email', 'like', "%{$search}%");
        });

    $patients = $patientsQuery->paginate(15);

    $stats = [
        'total' => \DB::table('patient')->count(),
        'pending' => \DB::table('appointments')->where('status', 'pending')->count(),
        'confirmed' => \DB::table('appointments')->where('status', 'accepted')->count(),
    ];

    return view('admin.patients', compact('patients', 'stats'));
}
    // public function saveCity(Request $request)
    // {
    //     $request->validate(['city_name' => 'required|string|max:255']);
    //     City::create(['city_name' => $request->city_name]);
    //     return back()->with('success', 'City added successfully!');
    // }

    public function destroyPatient($id)
{
    try {
        DB::beginTransaction();

        // Delete related records FIRST
        \DB::table('appointments')->where('patient_id', $id)->delete();
        \DB::table('patient_profile')->where('patient_id', $id)->delete();

        // Then delete patient
        \DB::table('patient')->where('id', $id)->delete();

        DB::commit();

        return redirect()->route('admin.patients')->with('success', 'Patient deleted successfully!');

    } catch (\Exception $e) {
        DB::rollBack();

        // 🔥 TEMP: Show real error
        return dd($e->getMessage());
    }
}


}
