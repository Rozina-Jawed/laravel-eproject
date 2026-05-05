<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Healthcare System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Header -->
  <header class="bg-blue-600 text-white p-4 shadow-md">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">

      <div class="flex items-center space-x-4">
        <div class="w-20 h-20 md:w-24 md:h-24 rounded-full overflow-hidden border-2 border-blue-500">
          <img src="https://thumbs.dreamstime.com/b/dreamstime-template-198954292.jpg" class="w-full h-full object-cover">
        </div>
        <h1 class="text-[30px] md:text-[50px] font-bold">HEALTHCARE SYSTEM</h1>
      </div>

    </div>
  </header>

  <!-- HERO SECTION (UPDATED + RESPONSIVE + ADDED FEATURES) -->
  <section class="bg-gradient-to-b from-blue-100 to-blue-50 py-16 md:py-24 text-center px-4">

    <h2 class="text-[32px] md:text-[60px] font-bold text-blue-800 mb-4">
      Welcome to Our Healthcare Portal
    </h2>

    <p class="text-gray-700 mb-8 text-[18px] md:text-[28px] max-w-2xl mx-auto">
      Manage patients, doctors, and administration easily with a fast and secure system.
    </p>

    <button id="getStartedBtn"
      class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-900 text-lg md:text-xl transition duration-300 animate-bounce w-full md:w-auto">
      Get Started
    </button>

    <!-- ADDED FEATURE BOXES (RESPONSIVE) -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">

      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
        <h3 class="text-xl font-bold text-blue-700">👨‍⚕️ Expert Doctors</h3>
        <p class="text-gray-600 mt-2 text-sm md:text-base">
          Highly qualified specialists available anytime.
        </p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
        <h3 class="text-xl font-bold text-blue-700">📅 Easy Appointments</h3>
        <p class="text-gray-600 mt-2 text-sm md:text-base">
          Book appointments quickly in just a few clicks.
        </p>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
        <h3 class="text-xl font-bold text-blue-700">⚡ Fast Service</h3>
        <p class="text-gray-600 mt-2 text-sm md:text-base">
          Smooth, fast and reliable healthcare system.
        </p>
      </div>

    </div>

  </section>

  <!-- Dashboard Section -->
  <section id="dashboard" class="container mx-auto py-12 px-4 min-h-screen scroll-mt-24 flex flex-col items-center justify-center">
    <h1 class="text-[40px] md:text-[70px] font-semibold text-center mb-12 md:mb-[90px] text-gray-800 animate-fade-in">
      Dashboards
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-8 justify-items-center w-full">
      <!-- Admin -->
      <div class="relative h-[500px] md:h-[560px] w-full max-w-[360px] bg-white/80 backdrop-blur-lg p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col items-center text-center border border-gray-200 hover:scale-105">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-t-2xl opacity-20"></div>
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin Icon" class="w-[160px] md:w-[200px] h-[120px] md:h-[160px] mb-4 z-10 drop-shadow-lg animate-fade-in"/>
        <h4 class="text-2xl md:text-3xl font-bold text-blue-800 mb-3 z-10">Admin Dashboard</h4>
        <p class="text-gray-700 mb-6 px-3 z-10 text-[16px] md:text-[22px]">
          Manage system settings, users, and reports with full control and analytics.
        </p>
        <a href="/admin/login">
          <button class="w-[140px] md:w-[150px] h-[50px] md:h-[60px] text-[16px] md:text-[20px] bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-3xl shadow-md hover:scale-110 hover:shadow-xl transition duration-300 z-10 mt-5">
            Open Panel
          </button>
        </a>
      </div>

      <!-- Patient -->
      <div class="relative h-[500px] md:h-[560px] w-full max-w-[360px] bg-white/80 backdrop-blur-lg p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col items-center text-center border border-gray-200 hover:scale-105">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-red-400 to-pink-500 rounded-t-2xl opacity-20"></div>
        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Patient Illustration" class="w-[160px] md:w-[200px] h-[120px] md:h-[160px] mb-4 z-10 drop-shadow-xl animate-fade-in"/>
        <h4 class="text-2xl md:text-3xl font-bold text-red-700 mb-3 z-10">Patient Dashboard</h4>
        <p class="text-gray-600 mb-6 px-3 z-10 text-[16px] md:text-[22px]">
          Book appointments, view prescriptions, and track your medical history easily.
        </p>
        <a href="/patientlogin">
          <button class="w-[140px] md:w-[150px] h-[50px] md:h-[60px] text-[16px] md:text-[20px] bg-gradient-to-r from-red-500 to-pink-600 text-white py-3 rounded-3xl shadow-md hover:scale-110 hover:shadow-xl transition duration-300 z-10 mt-5">
            Open Panel
          </button>
        </a>
      </div>

      <!-- Doctor -->
      <div class="relative h-[500px] md:h-[560px] w-full max-w-[360px] bg-white/80 backdrop-blur-lg p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col items-center text-center border border-gray-200 hover:scale-105">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-purple-400 to-indigo-500 rounded-t-2xl opacity-20"></div>
        <img src="https://png.pngtree.com/png-clipart/20250123/original/pngtree-doctor-woman-with-stethoscope-and-headset-icon-image-vector-illustration-design-png-image_19998430.png" alt="Doctor Avatar" class="w-[160px] md:w-[200px] h-[160px] md:h-[200px] mb-4 z-10 drop-shadow-xl rounded-full animate-fade-in"/>
        <h4 class="text-2xl md:text-3xl font-bold text-purple-700 mb-3 z-10">Doctor Dashboard</h4>
        <p class="text-gray-600 mb-6 px-4 z-10 text-[16px] md:text-[22px] leading-relaxed">
          Efficiently manage patients, schedule appointments.
        </p>
        <a href="/doctorlogin">
          <button class="w-[140px] md:w-[150px] h-[50px] md:h-[60px] text-[16px] md:text-[20px] bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-3xl shadow-md hover:scale-110 hover:shadow-xl transition duration-300 z-10 mt-5">
            Open Panel
          </button>
        </a>
      </div>
    </div>
  </section>

  <!-- Stats Cards -->
  <div class="flex flex-wrap justify-center gap-6 p-6 mt-12 mb-16">
    <!-- Patients Card -->
    <div class="relative w-[280px] md:w-[300px] h-[300px] bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col items-center justify-center border border-gray-200 hover:scale-105">
      <div class="absolute top-0 left-0 w-full h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-t-2xl opacity-20"></div>
      <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Patients" class="w-16 md:w-20 h-16 md:h-20 mb-4 z-10 drop-shadow-xl"/>
      <h2 id="patientCount" class="text-4xl md:text-5xl font-bold text-green-700 mb-2 z-10">0</h2>
      <p class="text-gray-600 text-[20px] md:text-[25px] z-10">Booked Appointments</p>
    </div>

    <!-- Doctors Card -->
    <div class="relative w-[280px] md:w-[300px] h-[300px] bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 flex flex-col items-center justify-center border border-gray-200 hover:scale-105">
      <div class="absolute top-0 left-0 w-full h-16 bg-gradient-to-r from-purple-400 to-indigo-500 rounded-t-2xl opacity-20"></div>
      <img src="https://png.pngtree.com/png-clipart/20250123/original/pngtree-doctor-woman-with-stethoscope-and-headset-icon-image-vector-illustration-design-png-image_19998430.png" alt="Doctors" class="w-16 md:w-20 h-16 md:h-20 mb-4 z-10 drop-shadow-xl"/>
      <h2 id="doctorCount" class="text-4xl md:text-5xl font-bold text-purple-700 mb-2 z-10">0</h2>
      <p class="text-gray-600 text-[20px] md:text-[25px] z-10">Doctors</p>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white p-4 text-[17px]">
    <div class="flex flex-col md:flex-row justify-between items-center">
      <p class="mb-2 md:mb-0">&copy; 2026 Healthcare System. All rights reserved.</p>
      <a href="/learnmore" class="hover:underline text-[18px] transition duration-300">Learn More</a>
    </div>
  </footer>

  <!-- JS: Smooth scroll + increment numbers -->
  <script>
    const btn = document.getElementById('getStartedBtn');
    const dashboard = document.getElementById('dashboard');

    btn.addEventListener('click', () => {
      const yOffset = -20;
      const y = dashboard.getBoundingClientRect().top + window.pageYOffset + yOffset;
      window.scrollTo({ top: y, behavior: 'smooth' });

      const patientTarget = 58;
      const doctorTarget = 12;
      const patientCount = document.getElementById('patientCount');
      const doctorCount = document.getElementById('doctorCount');
      let patientNum = 0;
      let doctorNum = 0;
      const speed = 20;

      const interval = setInterval(() => {
        if (patientNum < patientTarget) patientNum++;
        if (doctorNum < doctorTarget) doctorNum++;
        patientCount.textContent = patientNum;
        doctorCount.textContent = doctorNum;
        if (patientNum >= patientTarget && doctorNum >= doctorTarget) clearInterval(interval);
      }, speed);
    });
  </script>

  <style>
    .animate-fade-in { opacity: 0; animation: fadeIn 1s forwards; }
    .animate-fade-in.delay-200 { animation-delay: 0.2s; }
    @keyframes fadeIn { to { opacity: 1; } }

    .animate-bounce { animation: bounce 1s infinite alternate; }
    @keyframes bounce { 0% { transform: translateY(0); } 100% { transform: translateY(-10px); } }
  </style>

</body>
</html>
