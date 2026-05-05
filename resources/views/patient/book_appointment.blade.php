@extends('patient')

@section('patient')

<style>
/* Full page wrapper to center the container */
.page-center {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh; /* Full viewport height */
    background: #f8f9fb;
    padding: 20px;
}

.appointment-container {
    width: 100%;
    max-width: 600px;
    background: #ffffff;
    border-radius: 20px;
    padding: 40px 35px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    text-align: center;
}

.appointment-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.15);
}

.appointment-container h3 {
    margin-bottom: 30px;
    font-size: 2rem;
    font-weight: 700;
    color: #4f46e5;
}

.appointment-container label {
    display: block;
    font-weight: 500;
    margin-bottom: 8px;
    color: #374151;
    text-align: left;
}

.appointment-container input[type="date"],
.appointment-container input[type="time"],
.appointment-container textarea {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid #e1e5e9;
    border-radius: 14px;
    font-size: 15px;
    margin-bottom: 20px;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

.appointment-container input[type="date"]:focus,
.appointment-container input[type="time"]:focus,
.appointment-container textarea:focus {
    outline: none;
    border-color: #4f46e5;
    box-shadow: 0 0 8px rgba(79,70,229,0.25);
}

.appointment-container textarea {
    min-height: 120px;
    resize: vertical;
}

/* Button */
.doctor-book-btn {
    width: 100%;
    height: 48px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 25px;
    background: linear-gradient(to right, #f87171, #ec4899);
    color: white;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.doctor-book-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(248, 113, 113, 0.4);
}

/* Success & Error messages */
.appointment-container .alert {
    padding: 12px 18px;
    border-radius: 14px;
    margin-bottom: 18px;
    font-weight: 500;
    text-align: center;
}

.alert-success {
    background-color: #d1fae5;
    color: #065f46;
}

.alert-error {
    background-color: #fee2e2;
    color: #991b1b;
}

/* Responsive */
@media (max-width: 768px) {
    .appointment-container {
        padding: 30px 20px;
    }
    .appointment-container h3 {
        font-size: 1.6rem;
    }
    .doctor-book-btn {
        height: 44px;
        font-size: 14px;
    }
}

@media (max-width: 576px) {
    .appointment-container {
        padding: 25px 15px;
    }
    .appointment-container h3 {
        font-size: 1.4rem;
    }
    .doctor-book-btn {
        height: 42px;
        font-size: 13.5px;
    }
}
</style>

<div class="page-center">
    <div class="appointment-container">
        <h3>Book Appointment with Dr. {{ $doctor->doctor_name }}</h3>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="/book-appointment">
            @csrf
            <input type="hidden" name="doctor_id" value="{{ $doctor->doctor_id }}">

            <div>
                <label>Date:</label>
                <input type="date" name="appointment_date" required>
            </div>

            <div>
                <label>Time:</label>
                <input type="time" name="appointment_time" required>
            </div>

            <div>
                <label>Notes:</label>
                <textarea name="notes" placeholder="Any notes (optional)"></textarea>
            </div>

            <button type="submit" class="doctor-book-btn">Book Appointment</button>
        </form>
    </div>
</div>

@endsection
