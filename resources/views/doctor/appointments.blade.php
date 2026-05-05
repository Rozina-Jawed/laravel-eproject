@extends('doctor')
@section('doctor')

<style>
.appointments-table {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
}
.table-header th {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
    color: white !important;
    font-weight: 600;
    border: none;
    padding: 15px 12px;
    position: sticky;
    top: 0;
    z-index: 10;
}
.table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.2s;
}
.table tbody tr:hover {
    background: #f8fafc;
    transform: scale(1.01);
}
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 12px;
}
.status-pending { background: #fef3c7; color: #d97706; }
.status-accepted { background: #d1fae5; color: #10b981; }
.status-rejected { background: #fee2e2; color: #ef4444; }
.action-btn {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    border: none;
    transition: all 0.3s;
}
.action-btn:hover {
    transform: translateY(-1px);
}
.no-data {
    text-align: center;
    padding: 60px 20px;
    color: #6b7280;
}
</style>

<div class="container-fluid mt-4">
    <!-- Compact Header with Pending Count -->
    <div class="row mb-3">
        <div class="col">
            <h4 class="mb-1 d-flex align-items-center">
                <i class="fas fa-calendar-check me-2 text-primary"></i>
                Appointments
                <span class="badge bg-warning ms-2 px-3 py-2">
                    <i class="fas fa-clock me-1"></i>
                    {{ $appointments->where('status', 'pending')->count() }} Pending
                </span>
            </h4>
            <small class="text-muted">Manage your patient bookings</small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- 🔥 PERFECT TABLE WITH HEADINGS -->
    <div class="appointments-table"style="width:900px">
        @if($appointments->count() > 0)
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-header">
                        <tr>
                            <th width="200">
                                <i class="fas fa-user-md me-1"></i>
                                Patient
                            </th>
                            <th width="120">
                                <i class="fas fa-calendar me-1"></i>
                                Date
                            </th>
                            <th width="100">
                                <i class="fas fa-clock me-1"></i>
                                Time
                            </th>
                            <th width="150">
                                <i class="fas fa-sticky-note me-1"></i>
                                Notes
                            </th>
                            <th width="120">
                                <i class="fas fa-circle-notch me-1"></i>
                                Status
                            </th>
                            <th width="200" class="text-center">
                                <i class="fas fa-cogs me-1"></i>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr class="align-middle">
                           <td>
    <div>
        <strong>{{ $appointment->patient->patient_name ?? 'Unknown Patient' }}</strong>
        <br><small class="text-muted">{{ $appointment->patient->patient_email ?? '' }}</small>
    </div>
</td>
                            <td>
                                <strong>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</strong>
                                <br><small class="text-muted">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l') }}</small>
                            </td>
                            <td>
                                <h6 class="mb-0 fw-bold">{{ $appointment->appointment_time }}</h6>
                            </td>
                            <td>
                                @if($appointment->notes && strlen($appointment->notes) > 0)
                                    <small class="text-muted d-block" style="max-height: 40px; overflow: hidden;">
                                        {{ Str::limit($appointment->notes, 50) }}
                                    </small>
                                @else
                                    <span class="badge bg-light text-dark px-2 py-1">No notes</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge
                                    @if($appointment->status == 'pending') status-pending
                                    @elseif($appointment->status == 'accepted') status-accepted
                                    @else status-rejected @endif
                                ">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($appointment->status == 'pending')
                                    <div class="btn-group btn-group-sm" role="group">
                                        <form method="POST" action="/doctor/appointments/action" class="d-inline me-1">
                                            @csrf
                                            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                            <button type="submit" name="action" value="accepted"
                                                    class="action-btn btn-success text-white">
                                                <i class="fas fa-check me-1"></i>Accept
                                            </button>
                                        </form>
                                        <form method="POST" action="/doctor/appointments/action" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                            <button type="submit" name="action" value="rejected"
                                                    class="action-btn btn-danger text-white">
                                                <i class="fas fa-times me-1"></i>Reject
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="badge bg-secondary px-3 py-2">
                                        <i class="fas fa-lock me-1"></i>{{ ucfirst($appointment->status) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="no-data">
                <i class="fas fa-calendar-times fa-4x mb-4 opacity-50"></i>
                <h4 class="mb-2">No Appointments Yet</h4>
                <p class="mb-4">Your first patient appointment will appear here.</p>
                <a href="/docdashboard" class="btn btn-primary btn-lg">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </div>
        @endif
    </div>
</div>

@endsection
