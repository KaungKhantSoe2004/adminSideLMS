
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class=" pb-5 bigContainer">
        <div class="  py-3  d-flex position-fixed top-0     headerPost">
            <div class=" col-1 offset-1 logoContainer">
                <img src="{{asset('logo/logo.jpg')}}" style=" width: 40px; height:40px" alt="">

            </div>
            <div class=" d-md-flex d-none   justify-content-around col-6  offset-3 mt-md-1 mt-4  btnContainer">
              <a  href="{{route('dashboard')}}" class=" text-decoration-none colored" id="home"  >
              Home
              </a>
              {{-- <a id='admin' class=" text-decoration-none" href="{{route('login')}}" >School Admin</a>
              <a class=" text-decoration-none" id="teacher" href="{{route('login')}}" >Teacher</a>
              <a href="#" class=" text-decoration-none" id="student" >Student</a> --}}
              <a href="{{route('paymentDirectPage')}}" class=" text-decoration-none" id="payment">Pricing</a>
            </div>
            <div class="navIcon d-md-none d-inline offset-7 mt-3 " id="navIcon"
            >
            <div id="rotateDown"></div>
            <div id="dNone"></div>
            <div id='rotateUp'></div>
          </div>
        </div>

        <div id="smallNav" class=" d-md-none d-block dFone position-fixed  text-center smallNav w-100 h-100">


            <div id="home"  class=" colored">Home</div>
        <a class=" text-decoration-none" href="{{route('login')}}" id="admin" >Admin</a>
        <a class=" text-decoration-none" href="{{route('login')}}" id="teacher" >Teacher</a>
        <a href="#" class=" text-decoration-none" id="student" >Student</a>
        <a href="{{route('paymentDirectPage')}}" class=" text-decoration-none" id="payment">Payment</a>
        </div>



@yield('open')





</div>






</body>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    let firstBar = document.getElementById('rotateDown');
    let secondBar = document.getElementById('dNone');
    let thirdBar = document.getElementById('rotateUp');
    const navIcon = document.getElementById('navIcon');

let home = document.getElementById('home');
let admin = document.getElementById('admin');
let teacher = document.getElementById('teacher');
let student = document.getElementById('student');

const smallNav = document.getElementById('smallNav');

    let clicked = false;
    const navClicked = ()=> {
        if(!clicked){
            firstBar.classList.add('rotateDown');
        secondBar.classList.add('dNone');
        thirdBar.classList.add('rotateUp');
        clicked = true;
        smallNav.classList.remove('dFone')
        }
        else{
            firstBar.classList.remove('rotateDown');
        secondBar.classList.remove('dNone');
        thirdBar.classList.remove('rotateUp');
        smallNav.classList.add('dFone');
        clicked = false;
        }
    }
    const eachNavClick = (pp)=> {

        home.classList.remove('colored');
        admin.classList.remove('colored');
        teacher.classList.remove('colored');
        student.classList.remove('colored');
        document.getElementById(pp).classList.add('colored')
    }
    home.onclick = ()=> {
        eachNavClick('home')
    };
    admin.onclick = ()=> {
        eachNavClick('admin')
    };
    teacher.onclick = ()=> {
        eachNavClick('teacher')
    };
    student.onclick = ()=> {
        eachNavClick('student')
    };
    navIcon.onclick = navClicked;
</script>
</html>
