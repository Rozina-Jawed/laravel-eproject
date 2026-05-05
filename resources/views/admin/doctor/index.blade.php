@extends('admin.layout')
@section('admin')
<div class="container-fluid px-3 py-5" style="max-width: 1400px; margin: 0 auto; overflow-x: hidden;">

    <!-- Header (same) -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h3 mb-1 fw-bold text-dark lh-1">
                <i class="fas fa-user-md me-2 text-primary"></i>
                Doctors Directory 
                <span class="badge bg-light text-dark fs-6 px-3 py-1 ms-2">{{ $doctors->total() }}</span>
            </h1>
            <p class="text-muted mb-0">Manage all registered doctors</p>
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-success fs-6 px-3 py-2 fw-semibold shadow-sm">
                {{ $doctors->filter(fn($d) => $d->status == 'approved')->count() }} Approved
            </span>
            <span class="badge bg-warning fs-6 px-3 py-2 fw-semibold shadow-sm text-dark">
                {{ $doctors->filter(fn($d) => $d->status == 'pending')->count() }} Pending
            </span>
        </div>
    </div>

    <!-- Search & Filter (same) -->
    <div class="card border-0 shadow-sm mb-4 overflow-hidden" style="border-radius: 16px;">
        <div class="card-body p-3">
            <div class="row g-3 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0 shadow-none border-0" 
                               id="doctorSearch" placeholder="Search doctors...">
                    </div>
                </div>
                <div class="col-md-7 text-end">
                    <div class="btn-group btn-group-sm" role="group">
                        <button class="btn btn-outline-primary active px-3 py-1" data-status="all">All</button>
                        <button class="btn btn-outline-warning px-3 py-1 text-dark" data-status="pending">Pending</button>
                        <button class="btn btn-outline-success px-3 py-1" data-status="approved">Approved</button>
                        <button class="btn btn-outline-danger px-3 py-1" data-status="rejected">Rejected</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PERFECT 100% WIDTH TABLE -->
    <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 16px;">
        <div class="table-responsive" style="max-height: 700px;">
            <table class="table table-hover mb-0 perfect-table">
                <thead class="table-light sticky-top">
                    <tr>
                        <!-- PERFECT WIDTHS - TOTAL 100% -->
                        <th style="width: 6% !important; padding: 16px 6px !important; min-width: 55px;" class="text-center border-0 fw-semibold">
                            <i class="fas fa-user-circle text-muted fs-5"></i>
                        </th>
                        <th style="width: 22% !important; padding: 16px 10px !important; min-width: 200px;" class="fw-semibold border-0">Doctor</th>
                        <th style="width: 14% !important; padding: 16px 8px !important; min-width: 130px;" class="fw-semibold text-center border-0">Specialty</th>
                        <th style="width: 14% !important; padding: 16px 8px !important; min-width: 130px;" class="fw-semibold text-center border-0">Hospital</th>
                        <th style="width: 9% !important; padding: 16px 8px !important; min-width: 85px;" class="fw-semibold text-center border-0">City</th>
                        <th style="width: 8% !important; padding: 16px 10px !important; min-width: 75px;" class="fw-semibold text-center border-0">Age</th>
                        <th style="width: 10% !important; padding: 16px 12px !important; min-width: 105px;" class="fw-semibold text-center border-0">Status</th>
                        <th style="width: 17% !important; padding: 16px 12px !important; min-width: 145px;" class="fw-semibold text-center border-0">Actions</th>
                    </tr>
                </thead>
                <tbody id="doctorTableBody">
                    @forelse($doctors as $doctor)
                    <tr class="align-middle doctor-row" 
                        data-status="{{ $doctor->status }}"
                        data-name="{{ strtolower($doctor->doctor_name) }}"
                        data-email="{{ strtolower($doctor->doctor_email) }}"
                        data-specialty="{{ strtolower($doctor->doctor_specialization) }}"
                        data-hospital="{{ strtolower($doctor->hospital_name ?? '') }}">
                        
                        <!-- Avatar -->
                        <td style="padding: 16px 6px !important; vertical-align: middle !important;">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mx-auto shadow-sm" 
                                 style="width: 44px; height: 44px; font-weight: 700; font-size: 0.95rem;">
                                {{ strtoupper(substr($doctor->doctor_name, 0, 1)) }}
                            </div>
                        </td>

                        <!-- Doctor Info -->
                        <td style="padding: 16px 10px !important; vertical-align: middle !important;">
                            <div style="max-width: 190px;">
                                <div class="fw-semibold text-dark mb-1 text-truncate" style="font-size: 0.95rem;">
                                    {{ $doctor->doctor_name }}
                                </div>
                                <small class="text-muted d-block text-truncate" style="font-size: 0.82rem;">
                                    {{ Str::limit($doctor->doctor_email, 22) }}
                                </small>
                            </div>
                        </td>

                        <!-- Specialty -->
                        <td style="padding: 16px 8px !important; vertical-align: middle !important;" class="text-center position-relative">
                            <span class="badge bg-primary-subtle text-primary px-2 py-1.5 fw-semibold rounded-pill text-truncate d-inline-block position-absolute" 
                                  style="font-size: 0.82rem; max-width: 120px; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                {{ Str::limit($doctor->doctor_specialization, 15) }}
                            </span>
                        </td>

                        <!-- Hospital -->
                        <td style="padding: 16px 8px !important; vertical-align: middle !important;" class="text-center position-relative">
                            <span class="text-muted fw-medium text-truncate d-inline-block position-absolute" 
                                  style="font-size: 0.82rem; max-width: 120px; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                {{ Str::limit($doctor->hospital_name ?? 'Not set', 16) }}
                            </span>
                        </td>

                        <!-- City - FIXED -->
                        <td style="padding: 16px 8px !important; vertical-align: middle !important;" class="text-center position-relative">
                            <span class="badge bg-light text-dark px-2 py-1.5 fw-semibold rounded-pill text-truncate d-inline-block position-absolute" 
                                  style="font-size: 0.82rem; max-width: 75px; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                {{ Str::limit($doctor->city->city_name ?? '-', 10) }}
                            </span>
                        </td>

                        <!-- Age -->
                        <td style="padding: 16px 10px !important; vertical-align: middle !important;" class="text-center position-relative">
                            <span class="fw-bold text-primary fs-5 position-absolute" 
                                  style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                {{ $doctor->doctor_age }}
                            </span>
                        </td>

                        <!-- Status - PERFECT CENTER -->
                        <td style="padding: 16px 12px !important; vertical-align: middle !important;" class="text-center position-relative">
                            @php
                                $statusClass = [
                                    'pending' => 'bg-warning text-dark',
                                    'approved' => 'bg-success text-white',
                                    'rejected' => 'bg-danger text-white'
                                ];
                            @endphp
                            <span class="badge {{ $statusClass[$doctor->status] ?? 'bg-secondary text-white' }} px-3 py-2 fw-semibold position-absolute" 
                                  style="font-size: 0.85rem; top: 50%; left: 50%; transform: translate(-50%, -50%); min-width: 85px;">
                                {{ ucfirst($doctor->status) }}
                            </span>
                        </td>

                        <!-- Actions - FULL WIDTH & CENTERED -->
                        <td style="padding: 16px 8px !important; vertical-align: middle !important;" class="text-center position-relative">
                            @if($doctor->status === 'pending')
                                <div class="btn-group-vertical btn-group-sm gap-1 d-flex align-items-center justify-content-center h-100 w-100" style="width: 140px !important; height: 100%;">
                                    <a href="{{ route('admin.doctor.approve', $doctor->doctor_id) }}" 
                                       class="btn btn-success btn-sm px-3 py-1.5 border-0 shadow-sm mb-1 rounded w-100 flex-fill"
                                       title="Approve Doctor"
                                       style="font-size: 0.8rem; line-height: 1.2; min-height: 32px;">
                                        <i class="fas fa-check me-1"></i>Approve
                                    </a>
                                    <a href="{{ route('admin.doctor.reject', $doctor->doctor_id) }}" 
                                       class="btn btn-danger btn-sm px-3 py-1.5 border-0 shadow-sm rounded w-100 flex-fill"
                                       onclick="return confirm('Reject Dr. {{ $doctor->doctor_name }}?')"
                                       title="Reject Doctor"
                                       style="font-size: 0.8rem; line-height: 1.2; min-height: 32px;">
                                        <i class="fas fa-times me-1"></i>Reject
                                    </a>
                                </div>
                            @else
                                <span class="badge bg-light text-dark px-3 py-2 fw-semibold shadow-sm rounded-pill position-absolute" 
                                      style="font-size: 0.85rem; top: 50%; left: 50%; transform: translate(-50%, -50%); min-width: 90px;">
                                    <i class="fas fa-lock me-1"></i>{{ ucfirst($doctor->status) }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-8 bg-light">
                            <i class="fas fa-users fa-3x text-muted mb-3 opacity-50"></i>
                            <h5 class="text-muted mb-2">No doctors found</h5>
                            <p class="text-muted mb-0">Try adjusting your search or filter</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer bg-transparent border-0 p-3 pt-0">
            {{ $doctors->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<style>
/* PERFECT TABLE - 100% WIDTH GUARANTEED */
.perfect-table {
    table-layout: fixed !important;
    width: 100% !important;
    background: white;
    border-collapse: collapse !important;
}

.perfect-table thead th {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef) !important;
    border-bottom: 2px solid #dee2e6 !important;
    color: #495057 !important;
    font-weight: 600 !important;
    position: sticky !important;
    top: 0 !important;
    z-index: 10 !important;
    font-size: 0.88rem !important;
    box-sizing: border-box !important;
}

.perfect-table tbody tr {
    height: 85px !important;
    border-bottom: 1px solid #f8f9fa;
    transition: all 0.2s ease;
}

.perfect-table tbody tr:hover {
    background-color: #f8f9ff !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

/* ALL CELLS PERFECTLY CENTERED */
.perfect-table td {
    vertical-align: middle !important;
    position: relative !important;
    padding: 16px 8px !important;
    box-sizing: border-box !important;
    overflow: hidden !important;
}

/* ABSOLUTE CENTERING FOR ALL CONTENT */
.position-absolute {
    position: absolute !important;
    top: 50% !important;
    left: 50% !important;
    transform: translate(-50%, -50%) !important;
}

/* TEXT TRUNCATION */
.text-truncate {
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
}

/* BUTTONS PERFECT */
.btn-group-vertical {
    gap: 4px !important;
    height: 100% !important;
    width: 100% !important;
    justify-content: center !important;
    align-items: center !important;
    padding: 0 !important;
}

.btn-group-vertical .btn {
    font-size: 0.8rem !important;
    padding: 6px 12px !important;
    line-height: 1.3 !important;
    min-height: 32px !important;
    flex: 1 !important;
    margin: 0 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.btn-group-vertical .btn:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
}

/* RESPONSIVE PERFECTION */
@media (max-width: 1200px) {
    .perfect-table tbody tr { height: 82px !important; }
    .perfect-table td { padding: 14px 6px !important; }
    .btn-group-vertical { width: 135px !important; }
}

@media (max-width: 992px) {
    .perfect-table tbody tr { height: 80px !important; }
    .btn-group-vertical { width: 130px !important; }
}

@media (max-width: 768px) {
    .btn-group-vertical { 
        flex-direction: row !important; 
        gap: 3px !important; 
        height: auto !important;
    }
    .btn-group-vertical .btn { 
        flex: 1 !important; 
        max-width: 75px !important;
        padding: 5px 8px !important; 
        font-size: 0.78rem !important;
        min-height: 30px !important;
    }
    .perfect-table tbody tr { height: 76px !important; }
}

@media (max-width: 576px) {
    .container-fluid { padding: 0.5rem !important; }
    .perfect-table tbody tr { height: 72px !important; }
    .perfect-table td { padding: 12px 4px !important; }
    .btn-group-vertical .btn { 
        padding: 4px 6px !important; 
        font-size: 0.75rem !important;
        min-height: 28px !important;
    }
}
</style>

<script>
// Same script
document.getElementById('doctorSearch').addEventListener('input', function() {
    const term = this.value.toLowerCase().trim();
    const activeStatus = document.querySelector('.btn-group .active').dataset.status || 'all';
    
    document.querySelectorAll('.doctor-row').forEach(row => {
        const name = row.dataset.name;
        const email = row.dataset.email;
        const specialty = row.dataset.specialty;
        const hospital = row.dataset.hospital;
        
        const matchesSearch = !term || 
            name.includes(term) || 
            email.includes(term) || 
            specialty.includes(term) ||
            hospital.includes(term);
            
        const matchesStatus = activeStatus === 'all' || row.dataset.status === activeStatus;
        
        row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
    });
});

document.querySelectorAll('[data-status]').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('[data-status]').forEach(b => {
            b.classList.remove('active', 'btn-primary');
            b.classList.add('btn-outline-primary');
        });
        
        this.classList.remove('btn-outline-primary');
        this.classList.add('active', 'btn-primary');
        
        document.getElementById('doctorSearch').dispatchEvent(new Event('input'));
    });
});
</script>
@endsection