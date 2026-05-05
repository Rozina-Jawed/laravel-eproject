@extends('doctor')

@section('doctor')

<style>
.settings-container{
    width:285%;
    padding:20px;
}

/* MAIN CARD */
.settings-card{
    width:100%;
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(18px);
    border-radius:24px;
    padding:30px;
    box-shadow:0 25px 60px rgba(0,0,0,0.12);
    border:1px solid rgba(99,102,241,0.2);
}

/* HEADER */
.settings-title{
    font-size:28px;
    font-weight:700;
    margin-bottom:25px;
    color:#1e293b;
}

/* ROW */
.setting-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 20px;
    margin-bottom:15px;
    border-radius:16px;
    background:rgba(99,102,241,0.06);
    transition:0.3s;
}

.setting-row:hover{
    transform:scale(1.01);
    background:rgba(99,102,241,0.12);
}

/* TEXT */
.setting-text{
    display:flex;
    flex-direction:column;
}

.setting-text h4{
    margin:0;
    font-size:16px;
    color:#4f46e5;
}

.setting-text p{
    margin:2px 0 0;
    font-size:13px;
    color:#64748b;
}

/* TOGGLE SWITCH */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 26px;
}

.switch input { display:none; }

.slider {
  position: absolute;
  cursor: pointer;
  top:0; left:0; right:0; bottom:0;
  background-color: #cbd5e1;
  transition: .4s;
  border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background: linear-gradient(135deg,#4f46e5,#06b6d4);
}

input:checked + .slider:before {
  transform: translateX(24px);
}

/* SAVE BUTTON */
.save-btn{
    margin-top:20px;
    background:linear-gradient(135deg,#4f46e5,#06b6d4);
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:14px;
    cursor:pointer;
    font-weight:600;
    transition:0.3s;
}

.save-btn:hover{
    transform:scale(1.05);
}
</style>

<div class="settings-container">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="settings-card">

        <div class="settings-title">⚙ Doctor Settings</div>
<form method="POST" action="/doctorsetting">
@csrf
        <!-- Availability -->
        <div class="setting-row">
            <div class="setting-text">
                <h4>Availability Status</h4>
                <p>Turn ON/OFF your profile visibility</p>
            </div>
            <label class="switch">
               <input type="checkbox" name="availability_status"
@if($settings && $settings->availability_status) checked @endif>
                <span class="slider"></span>
            </label>
        </div>

        <!-- Online Mode -->
        <div class="setting-row">
            <div class="setting-text">
                <h4>Online Consultation</h4>
                <p>Allow patients to book online consultation</p>
            </div>
            <label class="switch">
                <input type="checkbox" name="online_consultation"
@if($settings && $settings->online_consultation) checked @endif>
                <span class="slider"></span>
            </label>
        </div>

        <!-- Emergency -->
        <div class="setting-row">
            <div class="setting-text">
                <h4>Emergency Booking</h4>
                <p>Allow urgent patient requests</p>
            </div>
            <label class="switch">
                <input type="checkbox" name="emergency_booking"
@if($settings && $settings->emergency_booking) checked @endif>
                <span class="slider"></span>
            </label>
        </div>

        <!-- Notifications -->
        <div class="setting-row">
            <div class="setting-text">
                <h4>SMS Notifications</h4>
                <p>Get SMS alerts for appointments</p>
            </div>
            <label class="switch">
               <input type="checkbox" name="sms_notifications"
@if($settings && $settings->sms_notifications) checked @endif>
                <span class="slider"></span>
            </label>
        </div>

        <!-- Email -->
        <div class="setting-row">
            <div class="setting-text">
                <h4>Email Notifications</h4>
                <p>Receive email updates</p>
            </div>
            <label class="switch">
                <input type="checkbox" name="email_notifications"
@if($settings && $settings->email_notifications) checked @endif>
                <span class="slider"></span>
            </label>
        </div>

        <!-- Save -->
        <button type="submit" class="save-btn">Save Settings</button>
</form>
<!-- DELETE ACCOUNT -->
<form method="POST" action="/doctorsetting/delete" onsubmit="return confirm('⚠ Are you sure you want to delete your account? This cannot be undone!')">
    @csrf
    @method('DELETE')

    <button type="submit" style="
        margin-top:20px;
        width:100%;
        background:linear-gradient(135deg,#ef4444,#dc2626);
        color:white;
        border:none;
        padding:12px;
        border-radius:14px;
        font-weight:600;
        cursor:pointer;
    ">
        Delete My Account
    </button>
</form>
    </div>

</div>

@endsection
