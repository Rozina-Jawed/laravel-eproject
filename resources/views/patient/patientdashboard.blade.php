@extends('patient')

@section('patient')

<style>
    .page-wrapper {
        background: #f8f9fb;
        min-height: 100vh;
        padding: 25px 15px;
    }

    /* 🔴 HEADER */
    .welcome-box {
        background: linear-gradient(to right, #f87171, #ec4899);
        color: white;
        padding: 20px 25px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        margin-bottom: 25px;
    }

    /* 🔍 SEARCH */
    .search-box {
        background: #fff;
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .form-control, select {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1px solid #e1e5e9;
        width: 100%;
        height: 52px;
        box-sizing: border-box;
        font-size: 14px;
    }

    /* 🎯 ALL BUTTONS */
    .btn-gradient {
        background: linear-gradient(to right, #f87171, #ec4899) !important;
        color: white !important;
        border: none !important;
        border-radius: 25px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        box-shadow: 0 8px 20px rgba(248, 113, 113, 0.3) !important;
        transition: all 0.3s ease !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        position: relative !important;
        box-sizing: border-box !important;
        width: 100%;
    }

    .search-btn {
        width: 100% !important;
        max-width: 120px;
        height: 52px !important;
        font-size: 14px !important;
        padding: 0 20px !important;
        line-height: 1.2 !important;
    }

    .doctor-book-btn {
        width: 100% !important;
        height: 44px !important;
        font-size: 13px !important;
        padding: 0 16px !important;
        line-height: 1.3 !important;
        border-radius: 20px !important;
        margin-top: auto !important;
    }

    .action-btn {
        max-width: 280px;
        width: 100%;
        height: 50px !important;
        font-size: 14px !important;
        padding: 0 24px !important;
        margin: 0 auto;
    }

    .btn-gradient:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 12px 25px rgba(248, 113, 113, 0.4) !important;
        color: white !important;
    }

    /* 🧑‍⚕️ DOCTOR CARDS */
    .doctors-grid {
        --card-gap: 30px;
    }

    .doctors-grid .row {
        --bs-gutter-x: var(--card-gap);
        --bs-gutter-y: var(--card-gap);
        margin: 0 calc(var(--card-gap) * -0.5);
    }

    .doctors-grid [class*="col"] {
        padding: calc(var(--card-gap) * 0.5);
    }

    .doctor-card {
        background: #fff;
        border-radius: 20px;
        padding: 25px 20px 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #f1f3f4;
        position: relative;
        overflow: hidden;
    }

    .card-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .card-footer {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #f1f3f4;
    }

    .doctor-name {
        font-size: 1.2rem !important;
        font-weight: 700;
        margin-bottom: 12px !important;
        color: #1f2937;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        line-height: 1.3;
    }

    .doctor-hospital {
        font-size: 0.88rem !important;
        margin-bottom: 8px !important;
        color: #6b7280;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        line-height: 1.3;
    }

    .doctor-city {
        font-size: 0.88rem !important;
        color: #6b7280;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        line-height: 1.3;
        margin-bottom: 0 !important;
    }

    .doctor-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }

    /* Responsive */
    @media (max-width: 1200px) { .doctors-grid { --card-gap: 25px; } }
    @media (max-width: 992px) { .doctors-grid { --card-gap: 22px; } .doctor-name { font-size:1.15rem !important; } }
    @media (max-width: 768px) {
        .page-wrapper { padding: 20px 10px; }
        .welcome-box { padding: 18px 20px; margin-bottom: 20px; }
        .search-box { padding: 20px 15px; }
        .doctors-grid { --card-gap: 20px; }
        .doctor-card { padding: 22px 16px 12px; }
        .doctor-name { font-size: 1.1rem !important; }
        .doctor-book-btn { height: 42px !important; font-size: 12.5px !important; }
        .search-btn { height: 48px !important; }
        .action-btn { height: 46px !important; font-size: 13px !important; }
    }
    @media (max-width: 576px) {
        .doctors-grid { --card-gap: 18px; }
        .welcome-box h4 { font-size: 1.3rem; }
        .search-box { padding: 18px 12px; }
        .doctor-card { padding: 20px 14px 10px; }
        .doctor-name { font-size: 1rem !important; }
        .doctor-book-btn { height: 40px !important; font-size: 12px !important; padding: 0 12px !important; }
        .search-btn { height: 46px !important; font-size: 13px !important; }
        .action-btn { height: 44px !important; font-size: 13px !important; }
    }
</style>

<div class="page-wrapper">
    <div class="container">
        <!-- HEADER -->
        <div class="welcome-box">
            <h4>Welcome {{ session('patient_name') }}</h4>
            <small>Find your best doctor easily</small>
        </div>

        @if(session('success'))
            <div style="background:#d1fae5;color:#065f46;padding:14px 18px;border-radius:12px;margin-bottom:20px;box-shadow: 0 5px 15px rgba(0,0,0,0.08);font-weight:500;text-align:center;">
                {{ session('success') }}
            </div>
        @endif

        <!-- SEARCH -->
        <div class="search-box">
            <form method="GET" action="/search-doctor" class="row g-3">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <select name="city_id" class="form-control">
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->city_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12">
                    <input type="text" name="specialization" class="form-control" placeholder="Search Specialist" value="{{ request('specialization') }}">
                </div>

                <div class="col-lg-2 col-md-2 col-sm-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-gradient search-btn">Search</button>
                </div>
            </form>
        </div>

        <!-- DOCTORS -->
        <div class="doctors-grid">
            <div class="row g-0">
                @forelse($doctors as $doctor)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="doctor-card h-100">
                            <div class="card-content">
                                <h5 class="doctor-name">Dr. {{ $doctor->doctor_name }}</h5>
                                <p class="doctor-hospital">{{ Str::limit($doctor->profile->doctor_hospital ?? 'No Hospital', 28, '...') }}</p>
                                <p class="doctor-city">{{ $doctor->city->city_name ?? 'No City' }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('doctor.profile', $doctor->doctor_id) }}" class="btn btn-gradient doctor-book-btn">Check Availability</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h5 class="text-muted mb-4">No doctors found</h5>
                        <a href="/doctor/all" class="btn btn-gradient action-btn" style="max-width: 280px; display: inline-block;">Browse All Doctors</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- PROFILE & SETTINGS BUTTONS -->
        <div class="row mt-5 g-3 justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-12 d-flex justify-content-center">
                <button onclick="location.href='/patientprofile'" class="btn btn-gradient action-btn">My Profile</button>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 d-flex justify-content-center">
                <button onclick="location.href='/patientsettings'" class="btn btn-gradient action-btn">Settings</button>
            </div>
        </div>

    </div>
</div>

@endsection
