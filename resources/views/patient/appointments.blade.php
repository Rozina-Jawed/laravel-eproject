@extends('patient')

@section('patient')

<style>
.page-wrapper{
    padding:80px 20px 30px 20px; /* Top padding ko 80px kar diya, thoda niche */
    background:#f4f6fb;
    min-height:100vh;
}

/* PAGE TITLE */
.page-title{
    font-size:28px;
    font-weight:700;
    margin-bottom:25px;
    color:#111827;
    text-align:center;
}

/* CARD */
.appointment-card{
    background:#fff;
    border-radius:16px;
    padding:20px;
    margin-bottom:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    transition:0.3s ease;
    border-left:6px solid #6366f1;
}

.appointment-card:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 35px rgba(0,0,0,0.12);
}

/* DOCTOR NAME */
.appointment-card h4{
    margin:0;
    font-size:18px;
    color:#111827;
}

/* TEXT */
.appointment-card p{
    margin:5px 0;
    color:#4b5563;
    font-size:14px;
}

/* STATUS */
.status{
    display:inline-block;
    margin-top:8px;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

.status.pending{
    background:#fef3c7;
    color:#92400e;
}

.status.accepted{
    background:#d1fae5;
    color:#065f46;
}

.status.rejected{
    background:#fee2e2;
    color:#991b1b;
}

/* RESPONSIVE */
@media (max-width: 1024px){
    .page-wrapper {
        padding:70px 15px 25px 15px;
    }
    .page-title{
        font-size:26px;
    }
    .appointment-card h4{
        font-size:17px;
    }
}

@media (max-width: 768px){
    .page-wrapper {
        padding:60px 15px 20px 15px;
    }
    .page-title{
        font-size:24px;
    }
    .appointment-card h4{
        font-size:16px;
    }
    .appointment-card p{
        font-size:13px;
    }
    .status{
        font-size:12px;
        padding:5px 10px;
    }
}

@media (max-width: 480px){
    .page-wrapper {
        padding:50px 10px 15px 10px;
    }
    .page-title{
        font-size:22px;
    }
    .appointment-card h4{
        font-size:15px;
    }
    .appointment-card p{
        font-size:12px;
    }
    .status{
        font-size:11px;
        padding:4px 8px;
    }
}
</style>

<div class="page-wrapper">

    <div class="page-title">📅 My Appointments</div>

    @foreach($appointments as $appointment)

        <div class="appointment-card">

            <h4>
                👨‍⚕️ Doctor: {{ $appointment->doctor->doctor_name ?? 'Doctor Not Found' }}
            </h4>

            <p>📆 Date: {{ $appointment->appointment_date }}</p>
            <p>⏰ Time: {{ $appointment->appointment_time }}</p>
            <p>📝 Notes: {{ $appointment->notes }}</p>

            {{-- STATUS --}}
            @if($appointment->status == 'accepted')
                <span class="status accepted">
                    ✅ Accepted by Dr. {{ $appointment->doctor->doctor_name }}
                </span>

            @elseif($appointment->status == 'rejected')
                <span class="status rejected">
                    ❌ Rejected by Dr. {{ $appointment->doctor->doctor_name }}
                </span>

            @else
                <span class="status pending">
                    ⏳ Pending
                </span>
            @endif

        </div>

    @endforeach

</div>

@endsection
