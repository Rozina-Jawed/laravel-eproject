
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>
    .card{

    height: 700px;
    width: 100%;
    max-width: 700px;

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
        gap:5px;
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
    .form-grid{
        display: grid;
        grid-template-columns:1fr 1fr;
        gap:20px 20px;
    }
    .form-grid div{
        display:flex;
        flex-direction:column;
        align-items:flex-start;
        gap:8px;
    }
    .btn-div{
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .error-box {
    max-height: 120px;   /* box bada nahi hoga */
    overflow-y: auto;    /* scroll aa jayega */
}

  </style>
</head>
  <body>
    <div class="main">
    <div class="card">
        <div class="top-form">

            <H2>Registration Form</H2>
        </div>

      <form class="loginform"  action="/doctorregister" method="POST" enctype="multipart/form-data">

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
          <input type="text" placeholder="Enter your Name" name="doctor_name" value = "{{old('doctor_name')}}">
        </div>

        <div>
         <label for="Age">Age</label>
         <input type="number" placeholder="Enter your Age" name="doctor_age" value = "{{old('doctor_age')}}">
       </div>

      <div>
       <label for="email">Email:</label>
       <input type="email" placeholder="Enter your Email" name="doctor_email" value = "{{old('doctor_email')}}">
      </div>

       <div>
        <label for="specialization">specialization</label>
        <input type="text" placeholder="field you are specialized in" name="doctor_specialization" value = "{{old('doctor_specialization')}}">
       </div>

        <div>
         <label for="cv">CV</label>
         <input type="file" placeholder="Enter your CV" name="doctor_cv" value = "{{old('doctor_cv')}}">
        </div>

        <div>
         <label for="password">Password:</label>
         <input type="password" placeholder="Enter your Password" name="doctor_password" value = "{{old('doctor_password')}}">
        </div>
        <select name="city_id">
    @foreach($cities as $city)
        <option value="{{ $city->id }}">{{ $city->city_name }}</option>
    @endforeach
</select>

        </div>
        <div class="btn-div">
        <button type="submit" class="btn">Register</button>
         </div>
        <p>Already have account? <a href="/doctorlogin">Login</a></p>

    </form>
       </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
