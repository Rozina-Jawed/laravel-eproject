@extends('admin.layout')

@section('admin')

<style>
.appointment-wrapper{
    padding:20px;
}

.appointment-card{
    background:white;
    border-radius:20px;
    padding:25px;
    box-shadow:0 20px 50px rgba(0,0,0,0.1);
}

.appointment-title{
    font-size:26px;
    font-weight:700;
    margin-bottom:20px;
    color:#4f46e5;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table thead{
    background:linear-gradient(135deg,#4f46e5,#06b6d4);
    color:white;
}

.table th, .table td{
    padding:14px;
    text-align:center;
}

.table tbody tr{
    border-bottom:1px solid #eee;
}

.status{
    padding:5px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.pending{ background:#facc15; }
.accepted{ background:#22c55e; color:white; }
.rejected{ background:#ef4444; color:white; }

.action-btn{
    border:none;
    padding:6px 12px;
    border-radius:8px;
    cursor:pointer;
    font-size:12px;
    margin:2px;
}

.accept-btn{
    background:#22c55e;
    color:white;
}

.reject-btn{
    background:#ef4444;
    color:white;
}
</style>

<div class="appointment-wrapper">

<div class="appointment-card">

    <div class="appointment-title">📅 Patient Appointments</div>

    @if(session('success'))
        <div style="color:green; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color:red; margin-bottom:10px;">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Problem</th>
                <th>Date</th>
                <th>Time</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @foreach($appointments as $app)

        <tr>
            <td>{{ $app->id }}</td>

            {{-- FIXED HERE --}}
            <td>{{ $app->patient_name ?? 'N/A' }}</td>

            <td>{{ $app->notes ?? 'N/A' }}</td>

            <td>{{ \Carbon\Carbon::parse($app->appointment_date)->format('d-m-Y') }}</td>

            <td>{{ \Carbon\Carbon::parse($app->appointment_time)->format('H:i') }}</td>

            {{-- FIXED HERE --}}
            <td>{{ $app->patient_email ?? 'N/A' }}</td>

            <td>
                <span class="status {{ $app->status }}">
                    {{ ucfirst($app->status) }}
                </span>
            </td>

            <td>
                @if($app->status == 'booked')
                    <form method="POST" action="/doctor/appointments/{{ $app->id }}/update-status" style="display:inline;">
                        @csrf
                        <input type="hidden" name="status" value="accepted">
                        <button class="action-btn accept-btn">Accept</button>
                    </form>

                    <form method="POST" action="/doctor/appointments/{{ $app->id }}/update-status" style="display:inline;">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <button class="action-btn reject-btn">Reject</button>
                    </form>
                @else
                    <span style="color: gray;">No actions</span>
                @endif
            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

</div>

</div>

@endsection
