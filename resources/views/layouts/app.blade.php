<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SaSaKi Learning Management System</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <img src={{asset('logo/logo.png')}} style=" width: 30px; height:30px" alt="">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">

      <span class="brand-text  font-weight-light">
        <div class=" text-center">
        KAMUI LMS</div>
    </span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">




          <li class="nav-item">
            <a href='{{route('teacher#home')}}' class="nav-link">
              <i class="fas fa-user-circle"></i>
              <p>
                My Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href='{{route('admin#directSchoolPage')}}' class="nav-link">
              <i class="fas fa-school"></i>
              <p>
                My School
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{route('admin#classesDirectPage')}}" class="nav-link">
              <i class="fas fa-robot"></i>
              <p>
             My Classes
              </p>
            </a>
          </li>


          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-users"></i>
              <p>
              Teacher List
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-child"></i>
              <p>
              Student List
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="{{route('admin#directSubject')}}" class="nav-link">
              <i class="fas fa-school"></i>
              <p>
            Subjects
              </p>
            </a>
          </li>


          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-clipboard"></i>
              <p>
   All Classes
              </p>
            </a>
          </li> --}}


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-users"></i>
              <p>
         Users List
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
             My Lessons
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-table ms-5"></i>
              <p>
             Meeting Room
              </p>
            </a>
          </li>

         <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-newspaper"></i>
              <p>
            Assignments
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-book"></i>
              <p>
                Answers
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href={{{route('teacher#directDocumentaion')}}} class="nav-link">
              <i class="fas fa-info-circle"></i>
              <p>
        Documentation
              </p>
            </a>
          </li>


          <li class="nav-item mt-3">
           <form action="{{route('logout')}}" method="POST">
        @csrf
        <button type="submit" href="" class=" btn btn-danger col-12">
            <i class="fas fa-sign-out-alt"></i>
            <span>
              Logout
            </span>
          </button>
        </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
  @yield('body')
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
</body>
</html>
