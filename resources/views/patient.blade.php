<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Care Admin Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      font-family: Inter, system-ui, sans-serif;
      background: #f4f6fb;
      color: #111827;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    .page {
      display: flex;
      flex-direction: row;
      min-height: 100vh;
      transition: all 0.3s ease;
    }

    #admin {
      min-width: 250px;
      width: 250px;
      background: linear-gradient(180deg, #0A1F44, #07142e);
      color: white;
      min-height: 100vh;
      border-radius: 0 20px 20px 0;
      padding: 30px 20px 20px 20px;
      box-shadow: 5px 0 20px rgba(0,0,0,0.2);
      position: fixed;
      left: 0;
      top: 0;
      z-index: 1000;
      transform: translateX(0);
      transition: transform 0.3s ease;
    }

    #admin.hidden {
      transform: translateX(-250px);
    }

    .sidebar-header {
      margin-bottom: 35px;
      padding-top: 15px;
    }

    .sidebar-header h2 {
      margin: 0 0 5px 0;
      font-size: 24px;
      font-weight: 700;
    }

    .sidebar-header h6 {
      margin: 0;
      font-size: 13px;
      opacity: 0.8;
      font-weight: 400;
    }

    .menu-btn {
      height: 45px;
      background: #0A1F44;
      margin: 8px 0;
      padding: 10px 12px;
      cursor: pointer;
      border-radius: 10px;
      display: flex !important;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: white !important;
      transition: all 0.3s ease;
      font-weight: 500;
      min-width: 0;
    }

    .menu-btn span {
      display: inline-block !important;
      opacity: 1 !important;
      visibility: visible !important;
      font-size: 14px !important;
      white-space: nowrap !important;
      flex-shrink: 0 !important;
    }

    .menu-btn:hover, .menu-btn.clicked {
      background: linear-gradient(135deg, #40E0D0, #20B8A8);
      transform: translateX(5px);
    }

    .toggle-btn {
      position: fixed;
      top: 12px;
      left: 20px;
      z-index: 1001;
      background: none;
      border: none;
      color: #0A1F44;
      width: 50px;
      height: 50px;
      cursor: pointer;
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease;
    }

    .toggle-btn:hover {
      transform: scale(1.1);
      color: #40E0D0;
    }

    .toggle-btn.closed i {
      transform: rotate(90deg);
    }

    .main-content {
      margin-left: 270px;
      width: calc(100% - 270px);
      transition: all 0.3s ease;
      min-height: 100vh;
    }

    .main-content.expanded {
      margin-left: 80px;
      width: calc(100% - 80px);
    }

    .card-modern {
      position: relative;
      border-radius: 20px;
      padding: 20px 15px;
      height: 180px;
      color: white;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      transition: margin-left 0.3s ease;
      overflow: hidden;
      margin-left: 20px;
    }

    .chart-container {
      background: white;
      padding: 60px;
      margin-left: 20px;
      border-radius: 12px;
      margin-bottom: 20px;
      transition: margin-left 0.3s ease;
    }

    .welcome {
      margin: 20px 0 30px 20px;
      font-size: 50px;
      transition: margin-left 0.3s ease;
    }

    .btn-group {
      display: flex;
      flex-direction: row;
      gap: 30px;
      align-items: center;
      justify-content: center;
      margin-top: 60px;
    }

    .btn-group button {
      width: 140px;
      height: 50px;
      border-radius: 10px;
      font-size: 15px;
      background: linear-gradient(135deg, #315a7c, #8cdbfa);
      border: none;
      color: white;
      transition: 0.3s ease;
    }

    .btn-group button:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: rgba(0,0,0,0.5);
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    .overlay.active {
      opacity: 1;
      visibility: visible;
    }

    /* Responsive */
    @media (max-width: 992px) {
      #admin {
        transform: translateX(-250px);
      }

      #admin.open {
        transform: translateX(0);
      }

      .main-content {
        margin-left: 80px !important;
        width: calc(100% - 80px) !important;
      }

      .main-content.expanded {
        margin-left: 80px !important;
        width: calc(100% - 80px) !important;
      }

      .welcome, .card-modern, .chart-container {
        margin-left: 0 !important;
      }

      .toggle-btn {
        top: 12px;
        left: 15px;
      }
    }

    @media (max-width: 768px) {
      .welcome { font-size: 32px; }
      .btn-group {
        flex-direction: column;
        gap: 15px;
      }
      .btn-group button { width: 200px; }
    }

    @media (max-width: 480px) {
      .main-content, .main-content.expanded {
        margin-left: 0 !important;
        width: 100% !important;
      }
    }
  </style>
</head>

<body>
  <button class="toggle-btn" id="toggleBtn" title="Toggle Sidebar">
    <i class="fa-solid fa-bars"></i>
  </button>

  <div class="overlay" id="overlay"></div>

  <div class="page">
    <div id="admin">
      <div class="sidebar-header">
        <h2>Care</h2>
        <h6>Patient Panel</h6>
      </div>

     <!-- Dashboard -->
<a href="/patientdashboard" class="menu-btn {{ request()->is('patientdashboard') ? 'clicked' : '' }}">
    <i class="fa-solid fa-address-card"></i>
    <span>Dashboard</span>
</a>

<!-- Profile -->
<a href="/patientprofile" class="menu-btn {{ request()->is('patientprofile') ? 'clicked' : '' }}">
    <i class="fa-solid fa-user-injured"></i>
    <span>Your Profile</span>
</a>

<!-- Settings -->
<a href="/patientsettings" class="menu-btn {{ request()->is('patientsettings') ? 'clicked' : '' }}">
    <i class="fa-solid fa-cogs"></i>
    <span>Settings</span>
</a>

<!-- Appointments -->
<a href="/my-appointments" class="menu-btn {{ request()->is('my-appointments') ? 'clicked' : '' }}">
    <i class="fa-solid fa-calendar-check"></i>
    <span>Appointment</span>
</a>

      <hr style="border-color: rgba(255,255,255,0.2); margin: 25px 0;">

      <div style="background: linear-gradient(135deg, #8B5CF6, #A78BFA); text-align: center; padding: 12px; border-radius: 10px; font-weight: 500;">
        <i class="fa-solid fa-file-medical" style="color: white;"></i>
        <span style="margin-left: 8px;">Patient Dashboard</span>
      </div>
    </div>

    <div class="main-content" id="mainContent">
      <section>
        @yield('patient')
      </section>
    </div>
  </div>

  <!-- NO FOOTER -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const sidebar = document.getElementById('admin');
    const toggleBtn = document.getElementById('toggleBtn');
    const overlay = document.getElementById('overlay');
    const mainContent = document.getElementById('mainContent');
    let isSidebarOpen = false;

    function toggleSidebar() {
      isSidebarOpen = !isSidebarOpen;

      if (isSidebarOpen) {
        sidebar.classList.remove('hidden');
        sidebar.classList.add('open');
        mainContent.classList.remove('expanded');
        toggleBtn.innerHTML = '<i class="fa-solid fa-times"></i>';
        toggleBtn.classList.add('closed');
        overlay.classList.add('active');
      } else {
        sidebar.classList.add('hidden');
        sidebar.classList.remove('open');
        mainContent.classList.add('expanded');
        toggleBtn.innerHTML = '<i class="fa-solid fa-bars"></i>';
        toggleBtn.classList.remove('closed');
        overlay.classList.remove('active');
      }
    }

    toggleBtn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    document.querySelectorAll('.menu-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.menu-btn').forEach(b => b.classList.remove('clicked'));
        this.classList.add('clicked');
        toggleSidebar();
      });
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth > 992) {
        sidebar.classList.remove('hidden', 'open');
        mainContent.classList.remove('expanded');
        toggleBtn.innerHTML = '<i class="fa-solid fa-bars"></i>';
        toggleBtn.classList.remove('closed');
        overlay.classList.remove('active');
        isSidebarOpen = false;
      }
    });

    if (window.innerWidth <= 992) {
      sidebar.classList.add('hidden');
      mainContent.classList.add('expanded');
    }
  </script>
</body>
</html>
