@extends('doctor')

@section('doctor')

<style>
.profile-wrapper{
    padding:20px;
}
.profile-left h3{
    text-shadow:0 5px 15px rgba(0,0,0,0.3);
}
/* HEADER */
.profile-header{
    background: linear-gradient(to right, #c084fc, #6366f1);
    color:white;
    padding:40px 35px;
    border-radius:25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 20px 40px rgba(0,0,0,0.25);
    transition:0.3s ease;
    width: 240%;
}

.profile-header:hover{
    transform: translateY(-3px);
}

.profile-left{
    display:flex;
    align-items:center;
    gap:20px;
}

/* IMAGE */
.profile-img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid white;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

.profile-img:hover{
    transform: scale(1.05);
}

/* INFO CARD */
.info-card{
    width:240%;
    background: linear-gradient(135deg, #ffffff, #f0f9ff, #f8fafc);
    padding:30px;
    border-radius:24px;
    box-shadow:0 25px 60px rgba(0,0,0,0.12);
    border:1px solid rgba(14,165,233,0.2);
    position:relative;
    overflow:hidden;
}

.info-row{
    display:flex;
    justify-content:space-between;
    padding:14px 18px;
    margin-bottom:12px;
    border-radius:14px;
    background:rgba(14,165,233,0.06);
}

.info-row:hover{
    background:rgba(99,102,241,0.12);
}

/* BUTTON */
.edit-btn{
    position:fixed;
    bottom:30px;
    right:30px;
    background: linear-gradient(135deg,#4f46e5,#06b6d4);
    color:white;
    padding:16px 22px;
    border:none;
    border-radius:50px;
    cursor:pointer;
}

/* MODAL */
.modal-box{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.6);
    justify-content:center;
    align-items:flex-start;
    padding:40px 20px;
    overflow-y:auto;
}

.modal-content{
    width:900px;
    max-width:95%;
    background:transparent;
    display:flex;
    justify-content:center;
    align-items:center;
}

.card{
    width:100%;
    background:white;
    border-radius:20px;
    box-shadow:0 20px 40px rgba(0,0,0,0.2);
    padding:30px;
}

.loginform{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

.loginform input,
.loginform select{
    width:100%;
    height:40px;
    border:1px solid #c084fc;
    border-radius:6px;
    padding:5px 10px;
}

.btn{
    background: linear-gradient(to right, #c084fc, #6366f1);
    color:white;
}

.top-form{
    height:60px;
    background: linear-gradient(to right, #c084fc, #6366f1);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
}

.closebtn{
    position:absolute;
    top:15px;
    right:15px;
}
</style>

<div class="profile-wrapper">

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <!-- HEADER -->
    <div class="profile-header">

        <div class="profile-left">

            <img
            src="{{ $profile && $profile->doctor_profile_image
                ? asset('doctor_profile_image/'.$profile->doctor_profile_image)
                : 'https://ui-avatars.com/api/?name=Doctor&background=ffffff&color=999999&size=128' }}"
            class="profile-img">

            <div>
                <h1>Dr. {{ $doctor->doctor_name ?? session('doctor_name') }}</h1>
                <small>{{ $doctor->doctor_specialization ?? 'Not set' }}</small>
            </div>

        </div>

        <div>
            <p>{{ $profile->doctor_hospital ?? '🏥 Not set' }}</p>
        </div>

    </div>

    <br>

    <!-- INFO -->
    <div class="info-card">

        <div class="info-row">
            <span>Email</span>
            <span>{{ $doctor->doctor_email ?? 'Not set' }}</span>
        </div>

        <div class="info-row">
            <span>Phone</span>
            <span>{{ $profile->doctor_phone_number ?? 'Not set' }}</span>
        </div>

        <div class="info-row">
            <span>Gender</span>
            <span>{{ $profile->doctor_gender ?? 'Not set' }}</span>
        </div>

        <div class="info-row">
            <span>Experience</span>
            <span>{{ $profile->doctor_experience ?? 'Not set' }}</span>
        </div>

        <div class="info-row">
            <span>Fee</span>
            <span>{{ $profile->doctor_first_fee ?? 'Not set' }} / {{ $profile->doctor_sale_fee ?? 'Not set' }}</span>
        </div>

        <div class="info-row">
            <span>Available Time</span>
            <span>{{ $profile->available_time ?? 'Not set' }}</span>
        </div>

        <div class="info-row">
            <span>Days</span>
            <span>
                {{-- ✅ FIX FROM SECOND VERSION --}}
                @if($profile && $profile->available_day)
                    {{ implode(', ', (array) $profile->available_day) }}
                @else
                    Not set
                @endif
            </span>
        </div>

    </div>

</div>

<!-- EDIT BUTTON -->
<button class="edit-btn" onclick="openModal()">Edit Profile</button>

<!-- MODAL -->
<div class="modal-box" id="modal">
   <div class="modal-content">
    <div class="card">

        <button class="closebtn" onclick="closeModal()">✖</button>

        <div class="top-form">
            <h2>Edit Form</h2>
        </div>

        <form class="loginform" method="POST" action="/doctorprofile" enctype="multipart/form-data">
@csrf

<div class="form-grid">

    <div class="form-group">
        <label>Profile Image</label>
        <input type="file" name="doctor_profile_image">
    </div>

    <div class="form-group">
        <label>Hospital</label>
        <input type="text" name="doctor_hospital" required>
    </div>

    <div class="form-group">
        <label>Available Time</label>
        <input type="time" name="available_time" required>
    </div>

    <div class="form-group">
        <label>Available Days</label>
        <select name="available_day[]" multiple style="height:100px;" required>
            <option>Mon</option>
            <option>Tue</option>
            <option>Wed</option>
            <option>Thu</option>
            <option>Fri</option>
            <option>Sat</option>
            <option>Sun</option>
        </select>
    </div>

    <div class="form-group">
        <label>Experience</label>
        <input type="text" name="doctor_experience">
    </div>

    <div class="form-group">
        <label>Degree</label>
        <input type="text" name="doctor_degree">
    </div>

    <div class="form-group">
        <label>Gender</label>
        <select name="doctor_gender">
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>

    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="doctor_phone_number">
    </div>

    <div class="form-group">
        <label>First Fee</label>
        <input type="number" name="doctor_first_fee" required>
    </div>

    <div class="form-group">
        <label>Follow Fee</label>
        <input type="number" name="doctor_sale_fee" required>
    </div>

</div>

<div style="margin-top:20px;text-align:center;">
    <button type="submit" class="btn">Save Profile</button>
</div>

</form>

    </div>
    </div>
</div>

<script>
function openModal(){
    document.getElementById('modal').style.display='flex';
}
function closeModal(){
    document.getElementById('modal').style.display='none';
}
</script>

@endsection
