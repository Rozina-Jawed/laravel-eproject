<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>
    .card{
        
    height: 500px;
    width: 100%;
    max-width: 500px;

    background: rgba(255, 255, 255, 0.8); /* bg-white/80 */
    backdrop-filter: blur(16px); /* backdrop-blur-lg */

    padding: 32px;
    border-radius: 16px;
    border: 1px solid #e5e7eb;

    box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    transition: all 0.5s ease;

    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-top: 100px;
}

.btn:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 20px 30px rgba(0,0,0,0.2);
}

    
    .top-form{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height:90px;
        background: linear-gradient(to right, #c084fc, #6366f1);
        color: white;
        

    }
    .top-form h2{
     position: absolute;
     top:20px;
     left:6px;
     font-size:40px;
    }
    .main{
        display: flex;
        align-items:center;
        justify-content: center;
        
    }
    .btn{
        background: linear-gradient(to right, #c084fc, #6366f1);
        color:white;
    }
    .card .loginform{
        display: flex;
        margin-top: 100px;
        flex-direction:column;
        gap:10px;
        align-items:flex-start;
    }
    .loginform input{
        width: 250px;
        height: 30px;
        border:1px solid #c084fc;
        transition: all 0.5s ease;

    }
    .loginform label{
    font-size:20px;
    color: #8815fa;

    }
    .btn{
        margin-top: 10px;
    }
  </style>
</head>
  <body>
    <div class="main">
    <div class="card">
        <div class="top-form">
            <H2>Login Form</H2>
        </div>

      <form class="loginform"  action="/doctorlogin" method="POST" >
        @csrf
        @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
      <label for="email">Email:</label>
        <input type="email" placeholder="Enter your Email" name="doctor_email">

        <label for="password">Password:</label>
        <input type="password" placeholder="Enter your Password" name="doctor_password">
<button type="submit" class="btn">Login</button>
<p>Don't have account? <a href="/doctorregister">Register</a></p>
    </form>
</div>
</div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
