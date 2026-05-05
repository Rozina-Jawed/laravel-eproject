@extends('patient')

@section('patient')

<style>
    .profile-wrapper{
        background:#f4f6fb;
        min-height:100vh;
        padding:30px 15px;
        display:flex;
        justify-content:center;
        align-items:flex-start;
    }

    .profile-card{
        background:#fff;
        width:100%;
        max-width:850px;
        border-radius:20px;
        box-shadow:0 15px 40px rgba(0,0,0,0.1);
        overflow:hidden;
    }

    .profile-header{
        background:linear-gradient(to right, #f87171, #ec4899);
        padding:30px;
        text-align:center;
        color:#fff;
    }

    .profile-img{
        width:130px;
        height:130px;
        object-fit:cover;
        border-radius:50%;
        border:5px solid #fff;
        background:#fff;
    }

    .doctor-name{
        font-size:24px;
        font-weight:700;
        margin-top:10px;
    }

    .profile-body{
        padding:30px;
    }

    .info-grid{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:15px;
        margin-top:20px;
    }

    .info-box{
        background:#f9fafb;
        padding:12px 15px;
        border-radius:12px;
        border:1px solid #eee;
    }

    .label{
        font-weight:600;
        color:#111827;
    }

    .full-width{
        grid-column:1 / -1;
    }

    .btn-book{
        margin-top:25px;
        width:100%;
        padding:12px;
        border:none;
        border-radius:12px;
        background:linear-gradient(to right, #f87171, #ec4899);
        color:#fff;
        font-weight:600;
    }

    @media(max-width:768px){
        .info-grid{ grid-template-columns:1fr; }
    }
</style>

@php
    $profile = $doctor->profile ?? null;
@endphp

<div class="profile-wrapper">

    <div class="profile-card">

        <!-- HEADER -->
        <div class="profile-header">

            @if($profile && $profile->doctor_profile_image)
                <img src="{{ asset('doctor_profile_image/'.$profile->doctor_profile_image) }}" class="profile-img">
            @else
                <img src="{{ asset('doctor_profile_image/default.png') }}" class="profile-img">
            @endif

            <div class="doctor-name">Dr. {{ $doctor->doctor_name }}</div>
            <div>{{ $doctor->doctor_specialization }}</div>

        </div>

        <!-- BODY -->
        <div class="profile-body">

            <div class="info-grid">

                <div class="info-box">
                    <span class="label">Hospital:</span>
                    {{ $profile->doctor_hospital ?? 'Not available' }}
                </div>

                <div class="info-box">
                    <span class="label">City:</span>
                    {{ $doctor->city->city_name ?? 'Not available' }}
                </div>

                <div class="info-box">
                    <span class="label">Experience:</span>
                    {{ $profile->doctor_experience ?? 'N/A' }} years
                </div>

                <div class="info-box">
                    <span class="label">Degree:</span>
                    {{ $profile->doctor_degree ?? 'Not available' }}
                </div>

                <div class="info-box">
                    <span class="label">Gender:</span>
                    {{ $profile->doctor_gender ?? 'Not available' }}
                </div>

                <div class="info-box">
                    <span class="label">Phone:</span>
                    {{ $profile->doctor_phone_number ?? 'Not available' }}
                </div>

                <div class="info-box full-width">
                    <span class="label">Available Days:</span>
                @if($profile && $profile->available_day)
    {{ is_array($profile->available_day)
        ? implode(', ', $profile->available_day)
        : implode(', ', json_decode($profile->available_day, true) ?? []) }}
@else
    Not set
@endif
                </div>

                <div class="info-box full-width">
                    <span class="label">Available Time:</span>
                    {{ $profile->available_time ?? 'Not available' }}
                </div>

                <div class="info-box full-width">
                    <span class="label">Fees:</span>
                    {{ $profile->doctor_first_fee ?? 'Not available' }} PKR
                </div>

            </div>

            <a href="{{ url('/book-appointment/' . $doctor->doctor_id) }}">
                <button class="btn-book">Book Appointment</button>
            </a>

        </div>

    </div>

</div>

@endsection
