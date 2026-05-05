@extends('patient')

@section('patient')

<style>
body{
    font-family:Arial;
}

.container{
    padding:20px;
}

.card{
    background:rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding:25px;
    border-radius:15px;
    margin-bottom:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

input, select{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
}

button{
    background:linear-gradient(to right,#f87171,#ec4899);
    border:none;
    padding:10px;
    color:white;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    transform:scale(1.05);
}

/* Message styling */
.message {
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: bold;
}
.message-success {
    background: rgba(72, 187, 120, 0.2);
    color: #48bb78;
    border: 1px solid #48bb78;
}
.message-error {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border: 1px solid #ef4444;
}
</style>

<div class="container">

<!-- SUCCESS / ERROR MESSAGES -->
@if(session('success'))
<div class="message message-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="message message-error">
    {{ session('error') }}
</div>
@endif

<!-- PROFILE UPDATE -->
<div class="card">
<h2>Update Profile</h2>

<form method="POST" action="/patientsettings/update" enctype="multipart/form-data">
@csrf

<input type="file" name="patient_profile_image">

<select name="patient_gender">
    <option value="">Select Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
</select>

<input type="text" name="patient_phone_number" placeholder="Phone">

<button>Update Profile</button>
</form>
</div>

<!-- PASSWORD CHANGE -->
<div class="card">
<h2>Change Password</h2>

<form method="POST" action="/patientsettings/password">
@csrf

<input type="password" name="current_password" placeholder="Current Password">
<input type="password" name="new_password" placeholder="New Password">

<button>Change Password</button>
</form>
</div>

<!-- DELETE ACCOUNT -->
<div class="card">
    <h2 style="margin-bottom: 20px; color: #333;">Delete My Account</h2>
    <p style="margin-bottom: 20px; color: #555;">
        Warning: This action is irreversible. Deleting your account will remove all your data permanently.
    </p>
    <form method="POST" action="{{ route('patient.delete') }}"
          onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
        @csrf
        @method('DELETE')
        <button style="
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e74c3c;
            background: white;
            color: #e74c3c;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        "
        type="submit"
        onmouseover="this.style.background='#e74c3c'; this.style.color='white'; this.style.transform='scale(1.03)';"
        onmouseout="this.style.background='white'; this.style.color='#e74c3c'; this.style.transform='scale(1)';">
            Delete My Account
        </button>
    </form>
</div>

</div>

@endsection
