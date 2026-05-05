@extends('admin')
@section('admin')
        @if(session('admin_logged_in'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-4" style="z-index: 9999;" role="alert">
            <i class="fas fa-check-circle me-2"></i>Welcome {{ session('admin_name') }}!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

   

<form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
    @csrf
</form>
  <div class="flex-grow-1">
<div class="row mb-4">
  <div class="col-md-4">
    <div class="card-modern card-1">
      <div class="icon"><i class="fa-solid fa-user-doctor"></i></div>
      <div class="text-center mt-5 fs-5">Total Doctors</div>
      <div class="text-center fs-4 fw-bold">12</div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card-modern card-2">
      <div class="icon"><i class="fa fa-user"></i></div>
      <div class="text-center mt-5 fs-5">Total Patients</div>
      <div class="text-center fs-4 fw-bold">156</div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card-modern card-3">
      <div class="icon"><i class="fa-solid fa-calendar-days"></i></div>
      <div class="text-center mt-5 fs-5">Appointments</div>
      <div class="text-center fs-4 fw-bold">58</div>
    </div>
  </div>
</div>
<div class="row g-4">

    <!-- LEFT: SIMPLE ADD CITY FORM -->
    <div class="col-md-5">

      <div class="card p-4 shadow-sm"
           style="border-radius:15px; background:#F5F0FF;">

        <h5>Add City</h5>

        <form action="/save-city" method="POST">
          @csrf

          <input type="text"
                 name="city_name"
                 class="form-control mb-3"
                 placeholder="Enter city name">

          <button class="btn btn-primary w-100">
            Save City
          </button>

        </form>

      </div>

    </div>




 <div class="container-fluid px-4 py-5" style="max-width: 1400px; margin: 0 auto;">
    <div class="card border-0 shadow-xl mx-auto" style="border-radius: 24px; max-width: 100%; overflow: hidden;">
        
        <!-- SINGLE Div - Header + Table -->
        <div class="p-0">
            <!-- Header Section -->
            <div class="p-5 pb-3" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 24px 24px 0 0;">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-4">
                    <div class="flex-grow-1">
                        <h2 class="mb-2 fw-bold fs-2 lh-1 text-dark" style="font-family: 'Segoe UI', system-ui, sans-serif;">
                            <i class="fas fa-user-md me-3 text-primary" style="font-size: 1.8rem;"></i>
                            Doctor Requests
                        </h2>
                        <p class="mb-0 text-muted fs-5 fw-medium" style="font-family: 'Segoe UI', system-ui, sans-serif;">
                            Review and approve new doctor registrations
                        </p>
                    </div>
                    <div class="text-end flex-shrink-0">
                    <span class="badge bg-primary fs-4 px-5 py-3 fw-bold shadow-lg border border-warning-subtle rounded-xl">
                     {{ $pendingDoctors ?? 0 }} Pending
                       </span>
                    </div>
                </div>
            </div>

            <!-- Table Section - SAME Div -->
           <!-- Table Section -->
<div class="table-responsive px-5 pt-0 pb-5" style="border-radius: 0 0 24px 24px;">
    <table class="table table-hover mb-0 align-middle w-100">
        <thead style="background: #ffffff; border-bottom: 3px solid #e2e8f0;">
            <tr>
                <th class="py-4 px-3 text-center fw-bold fs-6" style="width: 70px;">Avatar</th>
                <th class="py-4 px-4 fw-bold fs-6">Doctor Details</th>
                <th class="py-4 px-3 text-center fw-bold fs-6" style="width: 180px;">Specialization</th>
                <th class="py-4 px-3 text-center fw-bold fs-6" style="width: 140px;">Hospital</th>
                <th class="py-4 px-3 text-center fw-bold fs-6" style="width: 120px;">City</th>
                <th class="py-4 px-3 text-center fw-bold fs-6" style="width: 100px;">Age</th>
                <th class="py-4 px-3 text-center fw-bold fs-6" style="width: 220px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- ✅ YOUR SAFE FOREACH -->
            @forelse($pendingDoctors ?? collect([]) as $doc)
                <tr class="border-bottom border-light hover-table-row">
                    <!-- Avatar -->
                    <td class="px-3 py-4 text-center">
                        <div class="mx-auto rounded-circle bg-primary bg-opacity-10 p-3 shadow-sm d-flex align-items-center justify-content-center"
                             style="width: 55px; height: 55px;">
                            <span class="fw-bold fs-5 text-primary">
                                {{ strtoupper(substr($doc->doctor_name ?? 'N/A', 0, 1)) }}
                            </span>
                        </div>
                    </td>

                    <!-- Doctor Details -->
                    <td class="px-4 py-4">
                        <div class="lh-1_3">
                            <h6 class="fw-bold mb-1 text-dark">{{ $doc->doctor_name ?? 'N/A' }}</h6>
                            <small class="text-muted d-block">{{ $doc->doctor_email ?? 'N/A' }}</small>
                            @if($doc->doctor_cv)
                                <span class="badge bg-info text-dark px-2 py-1 small mt-1">CV</span>
                            @endif
                        </div>
                    </td>

                    <!-- Specialization -->
                    <td class="px-3 py-4 text-center">
                        <span class="badge bg-primary px-3 py-2 fw-semibold">
                            {{ $doc->doctor_specialization ?? 'N/A' }}
                        </span>
                    </td>

                    <!-- Hospital -->
                    <td class="px-3 py-4 text-center">
                        <span class="fw-semibold">{{ $doc->hospital_name ?? 'Not Set' }}</span>
                    </td>

                    <!-- City -->
                    <td class="px-3 py-4 text-center">
                        <span class="badge bg-light text-dark px-3 py-2">
                            {{ $doc->city->city_name ?? 'N/A' }}
                        </span>
                    </td>

                    <!-- Age -->
                    <td class="px-3 py-4 text-center">
                        <span class="fw-bold fs-5 text-primary">{{ $doc->doctor_age ?? 'N/A' }}</span>
                    </td>

                    <!-- Actions -->
                    <td class="px-4 py-4 text-center">
                        <div class="btn-group-vertical btn-group-sm w-100 gap-1">
                            <a href="{{ route('admin.doctor.approve', $doc->doctor_id) }}" 
                               class="btn btn-success btn-sm shadow-sm border-0 px-3 py-2">
                                <i class="fas fa-check me-1"></i>Approve
                            </a>
                            <a href="{{ route('admin.doctor.reject', $doc->doctor_id) }}" 
                               class="btn btn-danger btn-sm shadow-sm border-0 px-3 py-2"
                               onclick="return confirm('Reject {{ $doc->doctor_name ?? '' }}?')">
                                <i class="fas fa-times me-1"></i>Reject
                            </a>
                            <a href="#" class="btn btn-outline-primary btn-sm px-3 py-2">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-12 bg-light rounded-3">
                        <div class="p-5">
                            <i class="fas fa-users-slash fa-4x text-muted mb-4 opacity-50"></i>
                            <h4 class="text-muted fw-semibold mb-3">No Pending Doctors</h4>
                            <p class="text-muted fs-5 mb-0">All doctors are reviewed</p>
                          <a href="{{ route('admin.doctors') }}" class="menu-btn {{ request()->routeIs('admin.doctors.list') ? 'clicked' : '' }}">
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
            <!-- Footer -->
        @if(isset($pendingDoctors) && count($pendingDoctors) > 0)
            <div class="p-4 pt-0 px-5 bg-light border-top">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 small text-muted">
                    <span>Showing {{ count($pendingDoctors) }} doctors</span>
                    <button class="btn btn-outline-primary btn-sm px-4 fw-semibold" onclick="location.reload()">
                        <i class="fas fa-sync me-2"></i>Refresh
                    </button>
                </div>
            </div>
            @endif
            
        </div>
    </div>
     <a href="#" onclick="event.preventDefault(); 
        if(confirm('Are you sure you want to logout?')) {
            document.getElementById('logout-form').submit();
        }" 
       class="menu-btn d-flex align-items-center text-decoration-none p-3 rounded-3 shadow-sm border-0 w-100"
       style="background: linear-gradient(135deg, #3d35dc, #2331c8) !important; 
              color: white !important; font-weight: 600; transition: all 0.3s ease;">
        <i class="fas fa-sign-out-alt me-3 fa-fw"></i>
        <span>Logout</span>
        <i class="fas fa-power-off ms-auto opacity-75"></i>
    </a>
</div>

<style>
/* Width Perfect Control */
.container-fluid { max-width: 1400px !important; }

/* Single Card Perfect Shadow */
.shadow-xl { 
    box-shadow: 0 20px 80px rgba(0,0,0,0.12) !important; 
}

/* Table Perfect Spacing */
.table th { 
    padding: 1.5rem 1rem !important; 
    border: none !important;
    font-weight: 600 !important;
    letter-spacing: 0.5px;
}
.table td { 
    padding: 1.25rem 0.75rem !important;
    border-color: #f8fafc !important;
}

/* Hover Perfect */
.hover-table-row:hover {
    background: #f8fafc !important;
    box-shadow: inset 0 0 0 1px #e2e8f0;
    transition: all 0.25s ease;
}

/* Buttons Perfect */
.btn-group .btn {
    border-radius: 12px !important;
    font-weight: 600 !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}
.btn:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .btn-group { flex-direction: column !important; }
    .p-5 { padding: 2rem 1.5rem !important; }
}

/* Typography Clean */
.fs-2 { font-size: 2.1rem !important; line-height: 1.2 !important; }
.fs-5 { font-size: 1.05rem !important; }
.fs-6 { font-size: 0.95rem !important; }
</style>


<!-- Charts Section -->
<div class="row mt-4 mb-4">
  <div class="col-md-6">
    <div class="chart-container">
      <h5>Patient Visits</h5>
      <canvas id="visitsChart"></canvas>
    </div>
  </div>

  <div class="col-md-6">
    <div class="chart-container">
      <h5>Revenue ($)</h5>
      <canvas id="revenueChart"></canvas>
    </div>
  </div>
</div>
</div>
<script>
     // Patient Visits Chart
  const ctx1 = document.getElementById('visitsChart').getContext('2d');
  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun'],
      datasets: [{ label:'Patient Visits', data:[50,60,70,65,80,90], backgroundColor:'rgba(0,123,255,0.2)', borderColor:'rgba(0,123,255,1)', borderWidth:2, fill:true, tension:0.3 }]
    },
    options: { responsive:true, plugins:{legend:{display:false}} }
  });

  // Revenue Chart
  const ctx2 = document.getElementById('revenueChart').getContext('2d');
  new Chart(ctx2, {
    type:'bar',
    data: {
      labels:['Jan','Feb','Mar','Apr','May','Jun'],
      datasets:[{ label:'Revenue', data:[1000,1200,1500,1300,1600,2000], backgroundColor:'rgba(40,167,69,0.7)', borderColor:'rgba(40,167,69,1)', borderWidth:1 }]
    },
    options:{ responsive:true, plugins:{legend:{display:false}} }
  });
  </script>
@endsection