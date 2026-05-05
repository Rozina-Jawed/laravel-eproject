@extends('admin.layout')
@section('admin')
<div class="table-container mx-5 mb-5">
    {{-- ALERT MESSAGES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0 fw-semibold text-dark fs-3">
                    <i class="fa-solid fa-table me-2 text-primary"></i>
                    Patients List ({{ $stats['total'] ?? 0 }})
                </h5>

            </div>
              <br>
                <br>
                <br>
            <div class="col-auto">
                <span class="badge bg-success fs-6 px-4 py-2 rounded-pill shadow-sm">
                    {{ $patients->count() }} Patients
                </span>
            </div>
        </div>
    </div>

    <div class="table-responsive" style="width:900px;">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="border-0 py-4">ID</th>
                    <th class="border-0 py-4 fw-semibold">Patient Details</th>
                    <th class="border-0 py-4 fw-semibold">Contact</th>
                    <th class="border-0 py-4 fw-semibold">Appointments</th>
                    <th class="border-0 py-4 fw-semibold">Status</th>
                    <th class="border-0 py-4 fw-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr>
                    <td class="fw-bold text-primary">{{ $patient->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="patient-avatar me-3 bg-light rounded-circle p-2">
                                <i class="fa fa-user text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold">{{ $patient->patient_name }}</h6>
                                <small class="text-muted">{{ $patient->patient_age ?? 'N/A' }} years</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="small">
                            <div class="fw-semibold text-dark">{{ $patient->patient_email }}</div>
                            <small class="text-muted">Phone: {{ $patient->patient_profile->patient_phone_number ?? 'Not Available' }}</small>
                        </div>
                    </td>
                    <td>
                        {{-- ✅ FIXED: Use stats or simple count --}}
                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                            {{ $stats['pending'] ?? 0 }} Appointments
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-success px-3 py-2 rounded-pill fs-6">Active</span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="#" class="btn btn-outline-primary btn-sm me-1" title="View Profile">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-outline-info btn-sm me-1" title="Appointments">
                                <i class="fa fa-calendar-check"></i>
                            </a>
                            <a href="#" class="btn btn-outline-warning btn-sm me-1" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            {{-- ✅ WORKING DELETE FORM --}}
                            <form action="{{ url('admin/patients/' . $patient->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure? This will delete patient + all appointments!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="fa-solid fa-users-slash fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted mb-1">No Patients Found</h5>
                        <p class="text-muted">Register some patients first!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($patients->hasPages())
    <div class="mt-4">
        {{ $patients->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
