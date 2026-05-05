@extends('doctor')
@section('doctor')

<h2 class="welcome">Welcome Dr. {{ session('doctor_name') }} </h2>
<div class="flex-grow-1">
<div class="row mb-4">

  <div class="col-md-3">
    <div class="card-modern card-4">
      <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
      <div class="text-center mt-5 fs-5">Today Appointments</div>
      <div class="text-center fs-4 fw-bold">18</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card-modern card-1">
      <div class="icon"><i class="fa-solid fa-user-doctor"></i></div>
      <div class="text-center mt-5 fs-5">Total Appointments</div>
      <div class="text-center fs-4 fw-bold">18</div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card-modern card-2">
      <div class="icon"><i class="fa fa-user"></i></div>
      <div class="text-center mt-5 fs-5">Total Slots</div>
      <div class="text-center fs-4 fw-bold">60</div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card-modern card-3">
      <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
      <div class="text-center mt-5 fs-5">Remaining slots</div>
      <div class="text-center fs-4 fw-bold">32</div>
    </div>
  </div>

</div>

<div class="btn-group">
    <button onclick="location.href='/doctorsetting'">Add Availability</button>
    <button onclick="location.href='/doctorprofile'">Edit Profile</button>
    <button onclick="location.href='/doctor/appointments'">View Appointments</button>
    <!-- Logout button -->
<button onclick="location.href='/logout'"
        style="background: linear-gradient(135deg,#ef4444,#f87171);
               border:none;
               border-radius:10px;
               padding:10px 20px;
               color:white;
               font-size:16px;
               display:flex;
               align-items:center;
               gap:8px;">
    <i class="fa-solid fa-right-from-bracket"></i>
    Logout
</button></div>

@endsection
