@extends('patient')

@section('patient')

<style>
:root {
    --primary: linear-gradient(to right, #f87171, #ec4899);
}

/* WRAPPER */
.profile-wrapper {
    padding: 80px 20px 20px 20px; /* Top padding ko 80px kar diya, aur baaki same */
}
/* HEADER */
.profile-header {
    background: linear-gradient(to right, #f87171, #ec4899);
    color: white;
    padding: 40px 35px;
    border-radius: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: nowrap; /* wrap disable */
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    transition: 0.3s ease;
    width: 100%;
}

.profile-header:hover {
    transform: translateY(-3px);
}

/* PROFILE LEFT */
.profile-left {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-shrink: 1; /* allow shrinking */
}

.profile-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid white;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    transition: 0.3s ease;
}

.profile-img:hover {
    transform: scale(1.05);
}

/* INFO CARD */
.info-card {
    width: 100%;
    background: radial-gradient(circle at top left, rgba(248,113,113,0.25), transparent 60%),
                radial-gradient(circle at bottom right, rgba(236,72,153,0.20), transparent 60%);
    padding: 30px;
    border-radius: 24px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.12);
    transition: 0.3s ease;
}

.info-card:hover {
    transform: translateY(-6px);
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 14px 18px;
    margin-bottom: 12px;
    border-radius: 14px;
    background: rgba(14,165,233,0.06);
    transition: 0.3s ease;
}

.info-row:hover {
    background: rgba(248,113,113,0.12);
}

/* EDIT BUTTON */
.edit-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: linear-gradient(135deg,#f87171,#ec4899);
    color: white;
    padding: 16px 22px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

/* MODAL */
.modal-box {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.modal-content {
    width: 900px;
    max-width: 95%;
    background: transparent;
    position: relative;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 28px;
    cursor: pointer;
    font-weight: bold;
    color: #333;
}

.close-btn:hover {
    color: red;
}

.card {
    width: 100%;
    background: white;
    border-radius: 20px;
    padding: 30px;
}

/* FORM */
.loginform {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.loginform input,
.loginform select {
    width: 100%;
    height: 40px;
    border: 1px solid #f74d4d;
    border-radius: 6px;
    padding: 5px 10px;
}

/* BUTTON */
.btn {
    background: linear-gradient(to right, #f87171, #ec4899);
    color: white;
    border: none;
    padding: 10px;
    border-radius: 8px;
}

/* LOGOUT */
.logout-btn {
    background: white;
    color: #ec4899;
    border: none;
    padding: 10px 18px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    transition: 0.3s ease;
    white-space: nowrap; /* ek line me rahe */
}

.logout-btn:hover {
    background: #ec4899;
    color: white;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .profile-img {
        width: 100px;
        height: 100px;
    }

    .profile-left h1 {
        font-size: 1.2rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .logout-btn {
        padding: 8px 14px;
        font-size: 14px;
    }
}

@media (max-width: 768px) {
    .profile-header {
        padding: 25px 15px;
    }

    .profile-img {
        width: 80px;
        height: 80px;
    }

    .profile-left h1 {
        font-size: 1rem;
    }

    .logout-btn {
        padding: 6px 12px;
        font-size: 13px;
    }
}

@media (max-width: 576px) {
    .profile-header {
        gap: 10px;
    }

    .profile-left h1 {
        font-size: 0.95rem;
    }

    .logout-btn {
        padding: 5px 10px;
        font-size: 12px;
    }
}
</style>

<div class="profile-wrapper">

    <!-- HEADER -->
    <div class="profile-header">

        <div class="profile-left">
            <img
                src="{{ $profile && $profile->patient_profile_image
                    ? asset('patient_profile_image/'.$profile->patient_profile_image)
                    : 'https://ui-avatars.com/api/?name=PatientRegister' }}"
                class="profile-img">

            <div>
                <h1>Mr/Mrs. {{ $patient->patient_name ?? session('patient_name') }}</h1>
            </div>
        </div>

        <!-- LOGOUT -->
        <div>
            <form method="POST" action="{{ route('patient.logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>

    </div>

    <br>

    <!-- INFO -->
    <div class="info-card">
        <div class="info-row">
            <span>Email</span>
            <span>{{ $patient->patient_email ?? 'Not set' }}</span>
        </div>

        <div class="info-row">
            <span>Phone</span>
            <span>{{ $profile->patient_phone_number ?? 'Not set' }}</span>
        </div>

        <div class="info-row">
            <span>Gender</span>
            <span>{{ $profile->patient_gender ?? 'Not set' }}</span>
        </div>
    </div>

</div>

<!-- EDIT BUTTON -->
<button class="edit-btn" onclick="openModal()">Edit Profile</button>

<!-- MODAL -->
<div class="modal-box" id="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>

        <div class="card">
            <form class="loginform" method="POST" action="/patientprofile" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <input type="file" name="patient_profile_image">
                    <select name="patient_gender">
                        <option>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    <input type="text" name="patient_phone_number" placeholder="Phone">
                </div>

                <button class="btn">Save Profile</button>
            </form>
        </div>

    </div>
</div>

<script>
// Open modal
function openModal(){
    document.getElementById('modal').style.display = 'flex';
}

// Close modal
function closeModal(){
    document.getElementById('modal').style.display = 'none';
}

// Close modal on outside click
window.addEventListener('click', function(e){
    const modal = document.getElementById('modal');
    if(e.target === modal){
        modal.style.display = 'none';
    }
});
</script>

@endsection
