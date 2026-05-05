@extends('admin.layout')
@section('admin')

<div class="admin-dashboard">
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-4 end-4 z-3" style="max-width: 400px;">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container-fluid px-0">
        {{-- HEADER --}}
        <div class="dashboard-header mb-4 pb-3">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="mb-2">
                        <i class="fas fa-tachometer-alt me-2 text-primary"></i>
                        Dashboard Overview
                    </h2>
                    <div class="text-muted">Manage doctors, patients & system settings</div>
                </div>
                <div class="col-auto">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Quick Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.doctors') }}"><i class="fas fa-list me-2"></i>View All Doctors</a></li>
                           <li><a class="dropdown-item" href="/admin/patients"><i class="fas fa-users me-2"></i>Patients</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('admin.setting') }}"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATS CARDS --}}
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stats-card primary-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon mb-3">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="stats-number">{{ $totalDoctors }}</div>
                        <h6 class="stats-label mb-0">Total Doctors</h6>
                        <small class="text-success fw-semibold">
                            <i class="fas fa-arrow-up me-1"></i>+12% this month
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stats-card success-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon mb-3">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stats-number">{{ $approvedDoctors }}</div>
                        <h6 class="stats-label mb-0">Approved</h6>
                        <small class="text-success fw-semibold">
                            <i class="fas fa-arrow-up me-1"></i>Active
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stats-card warning-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon mb-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stats-number">{{ $pendingDoctors->count() }}</div>
                        <h6 class="stats-label mb-0">Pending Review</h6>
                        <small class="text-warning fw-semibold">
                            <i class="fas fa-clock me-1"></i>Needs attention
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stats-card danger-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon mb-3">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div class="stats-number">{{ $rejectedDoctors }}</div>
                        <h6 class="stats-label mb-0">Rejected</h6>
                        <small class="text-danger fw-semibold">
                            <i class="fas fa-exclamation-triangle me-1"></i>Review logs
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- DOCTORS TABLE - FIXED OVERFLOW --}}
            <div class="col-xl-8">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center py-3 px-3 bg-light border-bottom">
                        <div>
                            <h5 class="mb-1 fw-bold text-dark mb-0">Pending Doctor Requests</h5>
                            <small class="text-muted">{{ $pendingDoctors->count() }} waiting for approval</small>
                        </div>
                        <a href="{{ route('admin.doctors') }}" class="btn btn-primary btn-sm px-3 py-1">
                            <i class="fas fa-list me-1"></i>View All
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-container">
                            <table class="table mb-0 table-fixed">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th style="width: 35%; min-width: 280px;" class="py-2 px-2 fw-semibold border-0">Doctor</th>
                                        <th style="width: 20%; min-width: 140px;" class="py-2 px-2 fw-semibold border-0 text-center">Specialty</th>
                                        <th style="width: 10%; min-width: 80px;" class="py-2 px-2 fw-semibold border-0 text-center">Age</th>
                                        <th style="width: 15%; min-width: 120px;" class="py-2 px-2 fw-semibold border-0 text-center">Location</th>
                                        <th style="width: 20%; min-width: 140px;" class="py-2 px-2 fw-semibold border-0 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @forelse($pendingDoctors as $doctor)
                                    <tr class="hover-row">
                                        <td class="py-2 px-2 align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2" style="flex-shrink: 0;">
                                                    <div class="avatar-bg">
                                                        {{ strtoupper(substr($doctor->doctor_name, 0, 1)) }}
                                                    </div>
                                                    @if($doctor->doctor_cv)
                                                        <div class="avatar-status bg-success"></div>
                                                    @endif
                                                </div>
                                                <div style="max-width: 180px;">
                                                    <div class="fw-semibold text-dark mb-1 text-truncate lh-1" style="font-size: 0.9rem;">{{ $doctor->doctor_name }}</div>
                                                    <small class="text-muted text-truncate d-block" style="font-size: 0.8rem;">{{ Str::limit($doctor->doctor_email, 22) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-2 px-2 align-middle text-center">
                                            <span class="badge bg-primary px-2 py-1 fw-semibold text-truncate d-inline-block" style="font-size: 0.8rem; max-width: 110px;">
                                                {{ Str::limit($doctor->doctor_specialization, 12) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-2 align-middle text-center">
                                            <div class="fw-bold text-primary" style="font-size: 1.1rem;">{{ $doctor->doctor_age }}</div>
                                            <small class="text-muted" style="font-size: 0.75rem;">yrs</small>
                                        </td>
                                        <td class="py-2 px-2 align-middle text-center">
                                            <span class="badge bg-light text-dark px-2 py-1 fw-semibold text-truncate d-inline-block" style="font-size: 0.8rem; max-width: 90px;">
                                                {{ Str::limit($doctor->city->city_name ?? 'N/A', 10) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-2 align-middle text-end">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.doctor.approve', $doctor->doctor_id) }}" 
                                                   class="btn btn-success px-2 py-1 me-1 shadow-none"
                                                   title="Approve">
                                                    <i class="fas fa-check fs-6"></i>
                                                </a>
                                                <a href="{{ route('admin.doctor.reject', $doctor->doctor_id) }}" 
                                                   class="btn btn-danger px-2 py-1 shadow-none"
                                                   onclick="return confirm('Reject Dr. {{ $doctor->doctor_name }}?')"
                                                   title="Reject">
                                                    <i class="fas fa-times fs-6"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-6">
                                            <div class="empty-state">
                                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                                <h5 class="fw-bold text-success mb-2">All Clear!</h5>
                                                <p class="text-muted mb-4">No pending doctor requests.</p>
                                                <a href="{{ route('admin.doctors') }}" class="btn btn-primary btn-sm">Browse Doctors</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="col-xl-4">
                <div class="card h-100">
                    <div class="card-header bg-info text-white py-3 px-3">
                        <h6 class="mb-0 fw-bold">
                            <i class="fas fa-city me-2"></i>Add New City
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('admin.save.city') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold mb-2 small">City Name</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-map-marker-alt text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           name="city_name" 
                                           class="form-control border-start-0 shadow-none @error('city_name') is-invalid @enderror" 
                                           placeholder="e.g. Mumbai" 
                                           value="{{ old('city_name') }}" 
                                           required>
                                </div>
                                @error('city_name')
                                    <div class="invalid-feedback d-block small">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm fs-6">
                                <i class="fas fa-plus me-2"></i>Add City
                            </button>
                        </form>
                    </div>
                    
                    <div class="card-footer bg-light border-top p-3">
                        <h6 class="fw-bold mb-2 text-uppercase text-muted small">Quick Stats</h6>
                        <div class="row text-center g-2">
                            <div class="col-6 border-end">
                                <div class="fw-bold fs-5 text-primary">{{ $totalDoctors }}</div>
                                <small class="text-muted">Doctors</small>
                            </div>
                            <div class="col-6">
                                <div class="fw-bold fs-5 text-success">{{ $approvedDoctors }}</div>
                                <small class="text-muted">Active</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTTOM ACTION BUTTONS --}}
        <div class="row g-3 mt-4">
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.doctors') }}" class="action-btn primary-action h-100 text-center text-white text-decoration-none">
                    <i class="fas fa-list mb-1 fs-3 d-block"></i>
                    <span class="fs-6 fw-semibold d-block">Doctor Directory</span>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="/admin/patients" class="action-btn warning-action h-100 text-center text-decoration-none">
                    <i class="fas fa-users mb-1 fs-3 d-block"></i>
                    <span class="fs-6 fw-semibold d-block">Patients</span>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.setting') }}" class="action-btn info-action h-100 text-center text-white text-decoration-none">
                    <i class="fas fa-cog mb-1 fs-3 d-block"></i>
                    <span class="fs-6 fw-semibold d-block">Settings</span>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button onclick="document.getElementById('logout-form').submit()" class="action-btn danger-action h-100 w-100 text-center text-white text-decoration-none border-0 bg-transparent p-0">
                    <i class="fas fa-sign-out-alt mb-1 fs-3 d-block"></i>
                    <span class="fs-6 fw-semibold d-block">Logout</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* RESET & GLOBAL */
.admin-dashboard {
    background: #f8f9fa;
    min-height: 100vh;
    overflow-x: hidden;
}

* {
    box-sizing: border-box;
}

/* Header */
.dashboard-header {
    background: white;
    padding: 1.5rem;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
    margin-bottom: 1.5rem;
}

/* Stats Cards */
.stats-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
    background: white;
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    z-index: 1;
}

.primary-card::before { background: linear-gradient(90deg, #007bff, #0056b3); }
.success-card::before { background: linear-gradient(90deg, #28a745, #1e7e34); }
.warning-card::before { background: linear-gradient(90deg, #ffc107, #e0a800); }
.danger-card::before { background: linear-gradient(90deg, #dc3545, #c82333); }

.stats-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.15);
}

.stats-icon i { font-size: 2.5rem; opacity: 0.9; }
.stats-number { font-size: 2.5rem; font-weight: 800; line-height: 1; margin-bottom: 4px; }
.stats-label { color: #495057; font-weight: 600; }

/* TABLE - NO OVERFLOW */
.table-container {
    max-height: 450px;
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
}

.table-fixed {
    table-layout: fixed;
    width: 100%;
}

.table-fixed th,
.table-fixed td {
    word-break: break-word;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.hover-row:hover { background-color: #f8f9ff !important; }

/* Avatar */
.avatar {
    width: 40px !important;
    height: 40px !important;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: white;
    position: relative;
}

.avatar-bg {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 10px;
}

.avatar-status {
    position: absolute;
    bottom: -1px;
    right: -1px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
}

/* ACTION BUTTONS - PERFECT HEIGHT */
.action-btn {
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0.875rem 0.5rem !important;
    border-radius: 12px !important;
    height: 100% !important;
    min-height: 75px !important;
    transition: all 0.3s ease !important;
    border: none !important;
    box-shadow: 0 4px 16px rgba(0,0,0,0.12) !important;
    text-decoration: none !important;
    position: relative !important;
    overflow: hidden !important;
}

.action-btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 24px rgba(0,0,0,0.18) !important;
    color: inherit !important;
}

.action-btn i { margin-bottom: 0.25rem !important; }

.primary-action { background: linear-gradient(135deg, #007bff, #0056b3); color: white !important; }
.warning-action { 
    background: linear-gradient(135deg, #ffc107, #e0a800); 
    color: #212529 !important; 
}
.info-action { background: linear-gradient(135deg, #17a2b8, #117a8b); color: white !important; }
.danger-action { background: linear-gradient(135deg, #dc3545, #c82333); color: white !important; }

/* Empty State */
.empty-state { padding: 2rem 1rem; }

/* RESPONSIVE */
@media (max-width: 992px) {
    .table-container { max-height: 400px; }
}

@media (max-width: 768px) {
    .dashboard-header { padding: 1rem; margin-bottom: 1rem; }
    .stats-number { font-size: 2rem !important; }
    .stats-icon i { font-size: 2rem !important; }
    
    .action-btn { 
        min-height: 65px !important; 
        padding: 0.75rem 0.375rem !important;
        font-size: 0.85rem !important;
    }
    
    .action-btn i { font-size: 1.5rem !important; }
    
    .table-fixed th,
    .table-fixed td {
        padding: 0.5rem 0.25rem !important;
        font-size: 0.8rem !important;
    }
    
    .avatar {
        width: 36px !important;
        height: 36px !important;
        font-size: 12px !important;
    }
}

@media (max-width: 576px) {
    .table-container { max-height: 350px; }
    .card-header { padding: 0.75rem !important; }
    .card-body { padding: 0.75rem !important; }
}
</style>

@endsection