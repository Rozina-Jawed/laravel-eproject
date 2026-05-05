<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Care Admin Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      background:#f5f7fb;
      font-family: 'Poppins', sans-serif;
    }

    .page {
      min-height: 100vh;
      transition: all 0.3s ease;
    }

    /* Desktop Sidebar */
    #admin-sidebar {
      min-width:250px;
      background:#0A1F44;
      color:white;
      min-height:100vh;
      
      padding:20px;
      position: fixed;
      left: 0;
      top: 0;
      border-top-right-radius:20px;
      border-bottom-right-radius:20px;
      z-index: 1000;
      width: 250px;
      transform: translateX(0);
      transition: transform 0.3s ease;
    }

    /* Mobile Sidebar */
    @media (max-width: 768px) {
      #admin-sidebar {
        transform: translateX(-100%);
      }
      
      #admin-sidebar.show {
        transform: translateX(0);
      }
      
      .main-content {
        margin-left: 0 !important;
      }
    }

    .menu-btn{
      height:45px;
      background:#0A1F44;
      margin:8px 0;
      padding:12px;
      cursor:pointer;
      border-radius:12px;
      display:flex;
      align-items:center;
      gap:12px;
      text-decoration: none;
      color: white;
      font-weight: 500;
      transition: all 0.3s ease;
      border: 2px solid transparent;
    }

    .menu-btn:hover{
      background:#40E0D0;
      color: #0A1F44 !important;
      transform: translateX(5px);
      border-color: #40E0D0;
    }

    .menu-btn.active,
    .menu-btn.clicked{
      background:#40E0D0 !important;
      color:#0A1F44 !important;
      border-color: #40E0D0;
      box-shadow: 0 5px 15px rgba(64, 224, 208, 0.4);
    }

    /* Toggle Button */
    .toggle-btn {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1001;
      background: #0A1F44;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-size: 18px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      transition: all 0.3s ease;
      display: none;
    }

    .toggle-btn:hover {
      background: #40E0D0;
      transform: scale(1.1);
    }

    @media (max-width: 768px) {
      .toggle-btn {
        display: block !important;
      }
    }

    /* Main Content */
    .main-content {
      margin-left: 270px;
      padding: 20px;
      transition: margin-left 0.3s ease;
      flex: 1;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0 !important;
        padding: 20px 15px;
      }
    }

    /* Overlay for mobile */
    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    .sidebar-overlay.show {
      opacity: 1;
      visibility: visible;
    }

    /* Cards */
    .card-modern {
      position: relative;
      border-radius: 20px;
      padding: 25px 20px;
      height: 180px;
      color: white;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      transition: all 0.3s ease;
      overflow: hidden;
      margin: 15px 0;
    }

    .card-modern:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .card-1 { background: linear-gradient(135deg, #6CC1FF, #3A8DFF); }
    .card-2 { background: linear-gradient(135deg, #6BE0B3, #2AB673); }
    .card-3 { background: linear-gradient(135deg, #FF9999, #FF4D4D); }

    .chart-container {
      background:white;
      padding:40px;
      border-radius:20px;
      margin:20px 0;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
      .menu-btn {
        height: 40px;
        padding: 10px;
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <!-- Mobile Toggle Button -->
  <button class="toggle-btn" id="toggleSidebar">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <div class="page">
    <!-- Fixed Sidebar -->
    <div id="admin-sidebar">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h2 class="mb-1">Care</h2>
          <h6 class="mb-0 opacity-75">Admin Panel</h6>
        </div>
        <button class="btn-close btn-close-white" id="closeSidebar" style="font-size: 20px;"></button>
      </div>

      <!-- Navigation Links -->
      <nav>
        <a href="/admin/dashboard" class="menu-btn {{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
          <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>

        <a href="/admin/patients" class="menu-btn {{ request()->is('admin/patients*') ? 'active' : '' }}">
          <i class="fa-solid fa-user-injured"></i> Patients
        </a>

        <a href="{{ route('admin.doctors') }}" class="menu-btn {{ request()->routeIs('admin.doctors*') ? 'active' : '' }}">
          <i class="fa-solid fa-stethoscope"></i> Doctors
        </a>

        <a href="{{ route('admin.appointments') }}" class="menu-btn {{ request()->is('admin/appointments*') ? 'active' : '' }}">
          <i class="fas fa-calendar-check"></i> Appointments
        </a>

        <a href="{{ route('admin.setting') }}" class="menu-btn {{ request()->routeIs('admin.setting*') ? 'active' : '' }}">
          <i class="fa-solid fa-gear"></i> Settings
        </a>
      </nav>

      <hr class="my-4 opacity-25">

      <!-- Dashboard Links -->
     <div class="bg-success text-center p-2 mb-2 rounded"><i class="fa-solid fa-stethoscope" style="color: white;"></i> Doctor Dashboard</div>
    <div style="background:purple;" class="text-center p-2 mb-2 rounded"><i class="fa-solid fa-file-medical" style="color: white;"></i> Patient Dashboard</div>
    <div class="bg-primary text-center p-2 rounded"><i class="fa-solid fa-clipboard-list" style="color: white;"></i> Admin Dashboard</div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      @yield('admin')
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Mobile Sidebar Toggle
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const closeBtn = document.getElementById('closeSidebar');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.add('show');
      overlay.classList.add('show');
    });

    closeBtn.addEventListener('click', () => {
      sidebar.classList.remove('show');
      overlay.classList.remove('show');
    });

    overlay.addEventListener('click', () => {
      sidebar.classList.remove('show');
      overlay.classList.remove('show');
    });

    // Auto-close sidebar on route change (mobile)
    window.addEventListener('popstate', () => {
      if (window.innerWidth <= 768) {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
      }
    });

    // Active menu highlight
    document.querySelectorAll('.menu-btn').forEach(link => {
      link.addEventListener('click', function(e) {
        // Remove active from all
        document.querySelectorAll('.menu-btn').forEach(btn => {
          btn.classList.remove('active', 'clicked');
        });
        // Add active to clicked
        this.classList.add('active');
      });
    });
  </script>
</body>
</html>