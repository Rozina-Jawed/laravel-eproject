<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }

  .card{
    width: 100%;
    max-width: 700px;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(12px);
    padding: 40px 30px;
    border-radius: 20px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    transition: all 0.3s ease;
  }

  .card:hover{
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.18);
  }

  .top-form{
    width: 100%;
    text-align: center;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
    margin-bottom: 20px;
  }

  .top-form h2{
    color: #f74d4d;
    font-weight: 600;
    font-size: 36px;
  }

  .loginform{
    display: flex;
    flex-direction: column;
    gap: 15px;
    width: 100%;
  }

  .form-grid{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    width: 100%;
  }

  .form-grid div{
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  label{
    font-weight: 500;
    color: #f74d4d;
  }

  input, select{
    width: 100%;
    height: 40px;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #f7a0a0;
    transition: all 0.3s ease;
  }

  input:focus, select:focus{
    outline: none;
    border-color: #ec4899;
    box-shadow: 0 0 5px rgba(236,72,153,0.4);
  }

  .btn{
    width: 100%;
    padding: 12px;
    background: linear-gradient(to right, #f87171, #ec4899);
    color:white;
    border:none;
    border-radius: 8px;
    font-weight: 500;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .btn:hover{
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
  }

  .btn-div{
    margin-top: 10px;
    display: flex;
    justify-content: center;
  }

  .error-box{
    max-height: 150px;
    overflow-y: auto;
    width: 100%;
  }

  p{
    text-align: center;
    margin-top: 15px;
  }

  a{
    color: #ec4899;
    font-weight: 500;
    text-decoration: none;
  }

  a:hover{
    text-decoration: underline;
  }

  /* Responsive */
  @media (max-width: 768px){
    .form-grid{
      grid-template-columns: 1fr;
    }
    .top-form h2{
      font-size: 28px;
    }
    .card{
      padding: 30px 20px;
    }
  }

  @media (max-width: 480px){
    .top-form h2{
      font-size: 24px;
    }
    .card{
      padding: 20px 15px;
    }
    input, select{
      height: 35px;
    }
  }
</style>
</head>
<body>
<div class="card">
  <div class="top-form">
    <h2>Registration Form</h2>
  </div>

  <form class="loginform" action="/patientregister" method="POST" enctype="multipart/form-data">
    @csrf

    @if(session('success'))
      <div class="alert alert-success w-100">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger w-100 error-box">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="form-grid">
      <div>
        <label for="Name">Name</label>
        <input type="text" placeholder="Enter your Name" name="patient_name" value="{{old('patient_name')}}">
      </div>

      <div>
        <label for="Age">Age</label>
        <input type="number" placeholder="Enter your Age" name="patient_age" value="{{old('patient_age')}}">
      </div>

      <div>
        <label for="email">Email:</label>
        <input type="email" placeholder="Enter your Email" name="patient_email" value="{{old('patient_email')}}">
      </div>

      <div>
        <label for="password">Password:</label>
        <input type="password" placeholder="Enter your Password" name="patient_password" value="{{old('patient_password')}}">
      </div>
    </div>

    <div class="btn-div">
      <button type="submit" class="btn">Register</button>
    </div>

    <p>Already have an account? <a href="/patientlogin">Login</a></p>
  </form>
</div>
</body>
</html>
