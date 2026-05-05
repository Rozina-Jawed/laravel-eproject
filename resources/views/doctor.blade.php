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
}

    .page {
      display:flex;
    }

#admin {
  min-width: 250px;
  background: #0A1F44;
  color: white;
  min-height: 100vh;
  border-top-right-radius: 30px;     /* top-right corner */
  border-bottom-right-radius: 30px;  /* bottom-right corner */
  padding: 20px;
}
    #admin{
  background: linear-gradient(180deg, #0A1F44, #07142e);
  box-shadow: 5px 0 20px rgba(0,0,0,0.2);
}

    .menu-btn{
      height:40px;
      background:#0A1F44;
      margin:10px 0;
      padding:8px;
      cursor:pointer;
      border-radius:8px;
      display:flex;
      align-items:center;
      gap:10px;
    }

    .menu-btn:hover{
      background:#40E0D0;
    }

    .menu-btn.clicked{
      background:#40E0D0;
      color:#fff;
    }

   .card-modern {
    position: relative;
    border-radius: 20px;
    padding: 20px 15px;
    height: 180px;
    color: white;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    overflow: hidden;
    margin-left:20px;

}


.card-modern .icon {
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 40px;
    opacity: 0.8;
}

/* Gradient backgrounds for each card */
.card-1 {
    background: linear-gradient(135deg, #6CC1FF, #3A8DFF);
}

.card-2 {
    background: linear-gradient(135deg, #6BE0B3, #2AB673);
}

.card-3 {
    background: linear-gradient(135deg, #FF9999, #FF4D4D);
}

.card-4 {
    background: linear-gradient(135deg, #a78bfa, #8b5cf6);
}

/* Optional: Text shadow for better readability */
.card-modern .text-center {
    text-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

    .chart-container {
      background:white;
      padding:60px;
      margin-left: 20px;
      border-radius:12px;
      margin-bottom:20px;
    }
    #admin a {
  text-decoration: none;
  color: white;
}

#admin a:hover {
  color: white;
}
.card{
  margin:15px;
}
.welcome{
  margin:20px 0px 30px 20px;
  font-size:50px;
}
.btn-group{
  display: flex;
  flex-direction:row;
  gap:30px;
  align-items:center;
  justify-content:center;
  margin-top: 60px;
}
.btn-group button{
  width: 140px;
  height: 50px;
border-radius:10px;
font-size:15px;
background: linear-gradient(135deg, #315a7c, #8cdbfa);
}
.card-modern{
  transition: all 0.3s ease;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  border-radius: 18px;
}

.card-modern:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 35px rgba(0,0,0,0.12);
}
.btn-group button{
  transition: 0.3s ease;
  border: none;
  color: white;
}

.btn-group button:hover{
  transform: scale(1.05);
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.footer{
  background:#1f2937;   /* bg-gray-800 */
  color:white;
  padding:16px;
  font-size:17px;
}

.footer-content{
  display:flex;
  justify-content:space-between;
  align-items:center;
}

/* Responsive */
@media (max-width: 768px){
  .footer-content{
    flex-direction:column;
    text-align:center;
  }

  .footer-content p{
    margin-bottom:10px;
  }
}

/* Link styling */
.footer a{
  color:white;
  font-size:18px;
  text-decoration:none;
  transition:0.3s ease;
}

.footer a:hover{
  text-decoration:underline;
}


  </style>
</head>

<body>


  <div class="page">


    <div id="admin">
      <h2>Care</h2>
      <h6>Doctor Panel</h6>

      <a href="/docdashboard" class="menu-btn {{ request()->is('docdashboard') ? 'clicked' : '' }}">
    <i class="fa-solid fa-address-card"></i> Dashboard
</a>

<a href="/doctorprofile" class="menu-btn {{ request()->is('doctorprofile') ? 'clicked' : '' }}">
    <i class="fa-solid fa-user-injured"></i> Your Profile
</a>

<a href="/doctor/appointments" class="menu-btn {{ request()->is('doctor/appointments') ? 'clicked' : '' }}">
    <i class="fa-solid fa-calendar-check"></i> Appointments
</a>

<a href="/doctorsetting" class="menu-btn {{ request()->is('doctorsetting') ? 'clicked' : '' }}">
    <i class="fa-solid fa-cogs"></i> Setting
</a>
      <hr>

         <div class="bg-success text-center p-2 mb-2 rounded"><i class="fa-solid fa-stethoscope" style="color: white;"></i> Doctor Dashboard</div>
       </div>
        <section>
          @yield('doctor')
        </section>

  </div>

  <footer class="footer">
  <div class="footer-content">

    <!-- Left Text -->
    <p>
      &copy; 2026 Healthcare System. All rights reserved.
    </p>

    <!-- Right Link -->
    <a href="/learnmore">
      Learn More
    </a>

  </div>
</footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <script>
       // Sidebar button click effect
       let buttons = document.querySelectorAll(".menu-btn");
       buttons.forEach(btn => {
         btn.addEventListener("click", function(){
           buttons.forEach(b => b.classList.remove("clicked"));
           this.classList.add("clicked");
         });
          });


  </script>

</body>
</html>
