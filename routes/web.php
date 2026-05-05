<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;

// ================= PUBLIC PAGES =================
Route::get('/', function () {
    $adminExists = \App\Models\Admin::count() > 0;
    return view('welcome', compact('adminExists'));
});

// ================= ADMIN ROUTES =================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/register', [AdminController::class, 'adminRegister'])->name('register');
    Route::post('/register', [AdminController::class, 'adminRegisterStore'])->name('register.store');
    Route::get('/login', [AdminController::class, 'adminLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'adminLoginStore'])->name('login.store');
    Route::get('/setting', [AdminController::class, 'setting'])->name('setting');
    Route::get('/learnmore', [AdminController::class, 'learnmore']);

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/doctors', [AdminController::class, 'doctorList'])->name('doctors');
    Route::get('/doctor/{id}/approve', [AdminController::class, 'approveDoctor'])->name('doctor.approve');
    Route::get('/doctor/{id}/reject', [AdminController::class, 'rejectDoctor'])->name('doctor.reject');
    Route::get('/patients', [AdminController::class, 'adminPatients'])->name('patients');
    Route::get('/add-city', [AdminController::class, 'addCity'])->name('add.city');
    Route::post('/save-city', [AdminController::class, 'saveCity'])->name('save.city');
    Route::post('/logout', [AdminController::class, 'adminLogout'])->name('logout');
    Route::get('/appointments', [AdminController::class, 'adminAppointments'])->name('appointments');
        Route::delete('/patients/{id}', [AdminController::class, 'destroyPatient'])->name('admin.patients.destroy');
});

// ================= PATIENT ROUTES =================
 // ================= PATIENT ROUTES =================

// Dashboard
Route::get('/patientdashboard', [PatientController::class, 'patientdashboard'])->name('patient.dashboard');

// Register & Login
Route::get('/patientregister', [PatientController::class, 'patientregister'])->name('patient.register');
Route::post('/patientregister', [PatientController::class, 'patregister'])->name('patient.register.submit');

Route::get('/patientlogin', [PatientController::class, 'patientlogin'])->name('patient.login');
Route::post('/patientlogin', [PatientController::class, 'patlogin'])->name('patient.login.submit');

// Profile
Route::get('/patientprofile', [PatientController::class, 'patientprofile'])->name('patient.profile');
Route::post('/patientprofile', [PatientController::class, 'patient_profile'])->name('patient.profile.update');

// Logout
Route::post('/logout', [PatientController::class, 'logout'])->name('patient.logout');

// Settings
Route::get('/patientsettings', [PatientController::class, 'patientsettings'])->name('patient.settings');
Route::post('/patientsettings/update', [PatientController::class, 'updatePatientProfile'])->name('patient.settings.update');
Route::post('/patientsettings/password', [PatientController::class, 'changePatientPassword'])->name('patient.settings.password');

// Search & doctors
Route::get('/search-doctor', [PatientController::class, 'searchDoctor']);
Route::get('/doctor/all', [PatientController::class, 'allDoctors']);
 Route::get('/learnmore', [patientController::class, 'learnmore']);

// ================= APPOINTMENT ROUTES =================
Route::get('/book-appointment/{doctor}', [AppointmentController::class, 'showBookingForm']);
Route::post('/book-appointment', [AppointmentController::class, 'storeAppointment']);

// ================= ADDED FROM ROUTE 1 ONLY (MISSING PARTS) =================

// My Appointments (missing in Route 2)
Route::get('/my-appointments', [AppointmentController::class, 'myAppointments']);

// Delete account (missing in Route 2)
Route::delete('/patientsettings/delete', [PatientController::class, 'deletePatientAccount'])
     ->name('patient.delete');

// Doctor profile view (missing in Route 2)
Route::get('/doctor/{id}/profile', [PatientController::class, 'showDoctorProfile'])
     ->name('doctor.profile');



// ================= DOCTOR ROUTES =================
Route::get('/doctorwelcome', function () { return view('doctor.doctorwelcome'); });
Route::get('/docdashboard', [DoctorController::class, 'docdashboard']);
Route::get('/doctorsetting', [DoctorController::class, 'doctorsetting']);
Route::post('/doctorsetting', [DoctorController::class, 'saveDoctorsetting']);
Route::delete('/doctorsetting/delete', [DoctorController::class, 'deleteDoctorAccount']);
Route::get('/doctorlogin', [DoctorController::class, 'doctorlogin']);
Route::post('/doctorlogin', [DoctorController::class, 'login']);
Route::get('/doctorregister', [DoctorController::class, 'doctorregister']);
Route::post('/doctorregister', [DoctorController::class, 'register']);
Route::get('/doctorprofile', [DoctorController::class, 'doctorprofile']);
Route::post('/doctorprofile', [DoctorController::class, 'doctor_profile']);
Route::get('/logout', [DoctorController::class, 'logout']);
Route::get('/doctor/appointments', [DoctorController::class, 'doctorAppointments']);
Route::post('/doctor/appointments/action', [DoctorController::class, 'appointmentAction']);
// Doctor appointments ✅
    Route::get('/patientdashboard', [PatientController::class, 'patientdashboard']);
    Route::get('/book-appointment/{doctor_id}', [AppointmentController::class, 'showBookingForm'])->name('book.appointment.form');
    Route::post('/book-appointment', [AppointmentController::class, 'storeAppointment'])->name('book.appointment');
