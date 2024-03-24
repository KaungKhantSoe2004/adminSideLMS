@extends('layouts.app')
@section('body')


@if (isset($data))
<div class=" d-flex justify-content-center">
    @if (session('signedIn'))
    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
<div class="">
{{session('signedIn')}}
</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif


    @if (session('updated'))
    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
<div class="">
{{session('updated')}}
</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if (session('passwordChanged'))
    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
<div class="">
{{session('passwordChanged')}}
</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

</div>
<h2 class=" text-center py-4">School Home page</h2>
<div class=" col-10 offset-1 card">
    <div class=" card-header ">
        <div class=" col-10 offset-1 row ">
            <div class=" col-md-6 col-12  p-2   d-flex justify-content-center">
                @if ($data->img === null)

                <img src="{{asset('logo/defaultSchool.png')}}" class=" w-100 h-100" style="  border-radius:50%" alt="">
                @else
                <img src="{{asset('schoolLogo/'.$data->img)}}" class=" w-50 h-50  "  alt="">
                @endif
            </div>
<div class=" col-md-6 col-12 d-flex flex-column justify-content-center ">
<div class=" d-flex flex-column gap-2">
   <button class=" btn bg-dark my-2 text-start"> School Name &nbsp; &nbsp; - &nbsp; &nbsp; {{strtoupper($data->schoolName)}}</button>
   <button class=" btn bg-dark my-2"> School Email &nbsp; &nbsp;- &nbsp; &nbsp; {{$data->schoolEmail}}</button>
   <button class=" btn bg-dark my-2"> School Address &nbsp; &nbsp; - &nbsp; &nbsp; {{$data->schoolAddress}}</button>
   <button class=" btn bg-dark my-2"> School  &nbsp; &nbsp; -  &nbsp; &nbsp;{{$data->schoolType}}</button>
   <div class=" d-flex justify-content-end">
 @if (Auth::user()->role === 'owner' || Auth::user()->role === 'schoolAdmin')

 <div class=" d-flex justify-content-around">


    <form action="{{route('admin#directSchoolEditPage')}}" class=" ps-2  d-flex justify-content-end" method="POST">
     @csrf
     <input type="hidden" value="{{$data->schoolName}}" name="schoolName">
     <input type="hidden" value="{{$data->schoolEmail}}" name="schoolEmail">
     <input type="hidden" value="{{$data->schoolAddress}}" name="schoolAddress">
     <input type="hidden" value="{{$data->schoolType}}" name="schoolType">
     <input type="hidden" value="{{{$data->img}}}" name="img">
     <button type="sbumit" class=" btn bg-warning my-2 pe-3"><i class=" fas fa-edit "></i></button> &nbsp;
    </form>

 <a href="{{route('admin#changePasswordPage')}}">
   &nbsp;  <button type="sbumit" class=" btn bg-primary my-2">Change School Password</button>
 </a>
 &nbsp;
     <form action="{{route('admin#schoolSignOut')}}" class=" ps-2  d-flex justify-content-end" method="POST">
         @csrf
         <button type="sbumit" class=" btn bg-danger my-2">Sign Out</button>
        </form>

    </div>


 @endif
   </div>
</div>
</div>

        </div>

    </div>
    </div>



    <div class=" col-12 cards  row">
        <div class="   col-md-3 col-10 row  offset-1 my-3">
            <div class=" text-black-50 d-flex py-3  justify-content-center col-4">
               <h1>
                <i class=" fas fa-graduation-cap"></i>
               </h1>
            </div>
            <div class=" col-6  d-flex align-items-center offset-1">
                <div class=" d-flex">
                    <h2 class="  text-black-50 bold" >
                        23  <h6 class=" d-inline mt-3 text-black-50  bold">STUDENTS</h6>
                    </h2>
                </div>
            </div>
        </div>
        <div class="   col-md-3 col-10 row  offset-1 my-3">
            <div class=" text-black-50 d-flex py-3  justify-content-center col-4">
               <h1>
                <i class=" fas fa-graduation-cap"></i>
               </h1>
            </div>
            <div class=" col-6  d-flex align-items-center offset-1">
                <div class=" d-flex">
                    <h2 class="  text-black-50 bold" >
                        9  <h6 class=" d-inline mt-3 text-black-50  bold">CLASSES</h6>
                    </h2>
                </div>
            </div>
        </div>
        <div class="   col-md-3 col-10 row  offset-1 my-3">
            <div class=" text-black-50 d-flex py-3  justify-content-center col-4">
               <h1>
                <i class=" fas fa-user"></i>
               </h1>
            </div>
            <div class=" col-6  d-flex align-items-center offset-1">
                <div class=" d-flex">
                    <h2 class="  text-black-50 bold" >
                        05  <h6 class=" d-inline mt-3 text-black-50  bold">TEACHERS</h6>
                    </h2>
                </div>
            </div>
        </div>
        <div class="   col-md-4 col-10 row  offset-1 my-3">
            <div class=" text-black-50 d-flex py-3  justify-content-center col-4">
               <h1>
                <i class=" fas fa-user"></i>
               </h1>
            </div>
            <div class=" col-6  d-flex align-items-center offset-1">
                <div class=" d-flex">
                    <h2 class="  text-black-50 bold" >
                        05  <h6 class=" d-inline mt-3 text-black-50  bold">TEACHERS</h6>
                    </h2>
                </div>
            </div>
        </div>
        <div class="   col-md-4 col-10 row  offset-1 my-3">
            <div class=" text-black-50 d-flex py-3  justify-content-center col-4">
               <h1>
                <i class=" fas fa-user"></i>
               </h1>
            </div>
            <div class=" col-6  d-flex align-items-center offset-1">
                <div class=" d-flex">
                    <h2 class="  text-black-50 bold" >
                        05  <h6 class=" d-inline mt-3 text-black-50  bold">TEACHERS</h6>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    @if (session('userDeleted'))
    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
    <div class="">
    {{session('userDeleted')}}
    </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
<div class=" col-10 offset-1 mt-4">

<h3 class=" my-3 text-center">Teacher List</h3>

@if (session('teacherCreated'))
<div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
<div class="">
{{session('teacherCreated')}}
</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif


@if (session('teacherUpdated'))
<div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
<div class="">
{{session('teacherUpdated')}}
</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif



<div class=" my-2">
    <div class=" d-flex justify-end col-12 my-3">
       @if (Auth::user()->role === 'schoolAdmin')
       <a href="{{route('admin#addTeacherPage')}}">
        <button type="button" class="btn btn-dark">+ Add New Teacher</button>
    </a>
       @endif
    </div>
    <table class="table bg-white table-hover text-nowrap text-center">
        <thead>
          <tr>
              <th>Profile</th>

            <th> Name</th>
            <th> Email</th>
            <th>Phone</th>
            <th> Address</th>
            <th> Gender</th>
<th>Class</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $a)
            <tr >

                <td class=" ">
                  @if ($a->img === null)
    <img src="{{asset('logo/defaultProfile.jpg')}}"  style=" width: 50px;height: 50px;"alt="">
    @else
    <img src="{{asset('profileImg/'.$a->img)}}" class="  rounded-circle" style=" width: 50px;height: 50px;" alt="">
    @endif
                </td>
                <td>{{$a->name}}</td>
                <td>{{$a->email}}</td>
                <td>{{$a->phone}}</td>
                <td>{{$a->address}}</td>
<td>{{$a->gender}}</td>
<td>{{$a->className}}</td>
              @if (Auth::user()->role ==='schoolAdmin' || Auth::user()->role === 'owner')
              <td>
                <a href="{{route('admin#deleteUser', $a->id)}}">
                    <button class="btn btn-sm bg-danger text-white">
                        <i class=" fas fa-trash"></i>
                      </button>
                </a>

                <a href="{{route('admin#editTeacherPage',$a->id)}}">
                    <button class="btn btn-sm bg-warning text-white">
                        <i class=" fas fa-edit"></i>
                      </button>
                </a>


            </td>
              @endif
              </tr>
          @endforeach


        </tbody>

      </table>
      <div>
        {{
            $teachers->links()
        }}
     </div>
</div>
</div>






<div class=" col-10 offset-1 mt-4">

    <h3 class=" my-3 text-center">Student List</h3>


    @if (session('studentCreated'))
<div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
<div class="">
{{session('studentCreated')}}
</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif


@if (session('studentUpdated'))
<div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
<div class="">
{{session('studentUpdated')}}
</div>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
    <div class=" my-5">
        <div class=" d-flex justify-end col-12 my-3">
            <a href="{{route('admin#addStudentPage')}}">
                <button type="button" class="btn btn-dark">+ Add New Student</button>
            </a>
        </div>
        <table class="table bg-white table-hover text-nowrap text-center">
            <thead>
              <tr>
                  <th>Profile</th>

                <th> Name</th>
                <th> Email</th>
                <th>Phone</th>
                <th> Address</th>
                <th> Gender</th>
<th>Class</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($students as $a)
                <tr >

                    <td class=" ">
                        @if ($a->img === null)
          <img src="{{asset('logo/defaultProfile.jpg')}}"  style=" width: 50px;height: 50px;"alt="">
          @else
          <img src="{{asset('profileImg/'.$a->img)}}" class="  rounded-circle" style=" width: 50px;height: 50px;" alt="">
          @endif
                      </td>

                    <td>{{$a->name}}</td>
                    <td>{{$a->email}}</td>
                    <td>{{$a->phone}}</td>
                    <td>{{$a->address}}</td>
<td>{{$a->gender}}</td>
<td>{{$a->className}}</td>
@if (Auth::user()->role === 'owner' || Auth::user()->role === 'schoolAdmin' || Auth::user()->role === 'teacher')
<td>
    <a href="{{route('admin#deleteUser', $a->id)}}">
        <button class="btn btn-sm bg-danger text-white">
            <i class=" fas fa-trash"></i>
          </button>
    </a>
  <a href="{{route('admin#editStudentPage', $a->id)}}">
    <button class="btn btn-sm bg-warning text-white">
        <i class=" fas fa-edit"></i>
      </button></a>
  </td>
@endif
                  </tr>
              @endforeach


            </tbody>

          </table>

          <div>
            {{
                $students->links()
            }}
         </div>

    </div>
    </div>

<br>
<hr>

<div class=" mt-4">


    {{-- @if (session('noticeAdded'))
    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
    <div class="">
    {{session('noticeAdded')}}
    </div> --}}



    @if (session('noticeAdded'))
    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
    <div class="">
    {{session('noticeAdded')}}
    </div>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif


    @if (session('noticeUpdated'))
    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
    <div class="">
    {{session('noticeUpdated')}}
    </div>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif


    @if (session('noticeDeleted'))
    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
    <div class="">
    {{session('noticeDeleted')}}
    </div>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif



    <h2 class=" text-center bold">
        Notices
    </h2>
    <div class=" d-flex justify-end col-10 offset-1 my-3">
        <a href="{{route('admin#addNoticePage')}}">
            <button type="button" class="btn btn-dark">+ Add New Notices</button>
        </a>
    </div>

<div class=" col-10 offset-1 ">


   @foreach ($notices as $n)
   <div class=" bg-primary p-3" style=" border-radius: 6px">
    <h4 class=" bold">
    {{$n->name}}
    </h4>
{{$n->description}}  -- <h5 class=" mt-2">By {{$n->userName}}({{$n->userRole}})</h5>
@if (Auth::usr()->id ===  $n->created_by || Auth::user()->role === 'schoolAdmin')
<span >
    <a href="{{route('admin#deleteNotice', $n->id)}}">
    <button class=" btn btn-danger btn-sm">
        <i class=" fas fa-trash"></i>
    </button>
    </a>
    <a href="{{route('admin#editNotice', $n->id)}}">
        <button class=" btn btn-warning btn-sm">
            <i class=" fas fa-edit"></i>
        </button>
        </a>
</span>
@endif
</div>
   @endforeach

</div>

</div>


<div class=" col-10 offset-1 mt-4">



<div class=" my-4">
  <h3 class=" bold my-3">School List</h3>
</div>
  <table class="table bg-white table-hover text-nowrap text-center">
    <thead>
      <tr>
          <th>ID</th>
        <th>Logo</th>
        <th>School Name</th>
        <th>School Email</th>
        <th>School Address</th>
        <th>School Type</th>

        {{-- <th></th> --}}
      </tr>
    </thead>
    <tbody>
        @foreach ($schools as $a)
        <tr @if ($data->schoolEmail === $a->schoolEmail)
            class="bg-primary"
        @endif>
          <td>{{$a->id}}</td>
            <td>
              @if ($a->img === null)
                <img src="{{asset('logo/defaultSchool.png')}}" alt="" style=" width: 50px;height: 50px;">
              @else
              <img src="{{asset('schoolLogo/'.$a->img)}}" alt="" style=" width: 50px;height: 50px;">
              @endif

            <td>{{$a->schoolName}}</td>
            <td>{{$a->schoolEmail}}</td>
            <td>{{$a->schoolAddress}}</td>
            <td>{{$a->schoolType}}</td>

            {{-- <td>
              <button class="btn btn-sm bg-dark text-white">Sign In</button>

            </td> --}}
          </tr>
      @endforeach


    </tbody>

  </table>


  <div>
    {{
        $schools->links()
    }}
 </div>

</div>


@else
    {{-- <div class=" text-primary mt-3">
        <h3 class=" pl-4">There is no Schools you Signed in yet. Sign in!</h3>

        <div class="card col-10 offset-1">
            <div class="card-header">
              <h3 class="card-title">
                <a href="#"> <button class="btn btn-sm btn-outline-dark">Add Category</button></a>

              </h3>

              <div class="card-tools">
                <form action="#" method="GET">
                <div class="input-group input-group-sm" style="width: 150px;">

                        <input type="text" name="key" class="form-control float-right" placeholder="Search">

                        <span class="input-group-append">


                          <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>

                        </span>


                </div>
                </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap text-center">
                <thead>
               <tr>
                <th>Category ID</th>
                <th>Category Title</th>
                <th>Category Description</th>
                <th>Created At</th>
                <th></th>
               </tr>
                </thead>
                <tbody>
                    @foreach ($data as $c)
                    <tr>
                       <td>{{$c->category_id}}</td>
                       <td>{{$c->title}}</td>
                       <td>{{Str::of($c->description)->limit(40)}}</td>
                       <td>{{$c->created_at->format('d-M-Y')}}</td>
                       <td>
                          <a href="{{route('admin#categoryEditPage',  $c->category_id)}}">
                            <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        </a>
                 <a href="{{route('admin#categoryDelete', $c->category_id)}}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash"></i></button>
                </a>
                       </td>
                     </tr>
                    @endforeach




                </tbody>
              </table>
            </div>

          </div>


    </div> --}}






     @if (session('signedout'))
<div class="alert alert-danger offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
    <div class="">
      {{session('signedout')}}
    </div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
@endif
    <h3 class=" py-3 col-12 text-center">
        There is no School signed in.
    </h3>
    <section class="content">
        <div class="container-fluid">
          <div class="row mt-4">
            <div class="col-12">

           <div class=" row">
              <h5 class="col-3 p-2 my-2 ms-2 ">
                  <i class="fas fa-list"></i> Total - {{$schools->count()}}
              </h5>

             @if (request('key'))
             <h5 class="col-3 p-2 my-2 offset-5">
              <i class="fas fa-key"></i> Search Key - {{request('key')}}
          </h5>
             @endif
           </div>

              <div class="card ">
                <div class="card-header">
          <a href="{{route('admin#directSchoolBuyPage')}}">
            <button class=" btn btn-sm btn-dark">Buy New School</button>
        </a>

  {{-- <h5 class=" offset-1">
     Total <i class="fas fa-list"></i>
  </h5> --}}


                  <div class="card-tools">
                  <form action="#" method="GET">
                      @csrf
                      <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="key" class="form-control float-right" placeholder="Search">

                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                  </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                  @if (session('accDel'))
                      <div class="alert alert-danger offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
        <div class="">
          {{session('accDel')}}
        </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      @endif



               <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                        <th>ID</th>
                      <th>Logo</th>
                      <th>School Name</th>
                      <th>School Email</th>
                      <th>School Address</th>
                      <th>School Type</th>

                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($schools as $a)
                      <tr>
                        <td>{{$a->id}}</td>
                          <td>
                            @if ($a->img === null)
                              <img src="{{asset('logo/defaultSchool.png')}}" alt="" style=" width: 50px;height: 50px;">
                            @else
                            <img src="{{asset('schoolLogo/'.$a->img)}}" alt="" style=" width: 50px;height: 50px;">
                            @endif

                          <td>{{$a->schoolName}}</td>
                          <td>{{$a->schoolEmail}}</td>
                          <td>{{$a->schoolAddress}}</td>
                          <td>{{$a->schoolType}}</td>

                          <td>
                         <a href="{{route('admin#schoolSignInPage')}}">
                            <button class="btn btn-sm bg-dark text-white">Sign In</button>

                        </a>
                          </td>
                        </tr>
                    @endforeach


                  </tbody>

                </table>

                </div>

                <!-- /.card-body -->
              </div>
              {{-- {{
                  $data->appends(request()->query())->links()
              }} --}}
              <!-- /.card -->
            </div>
          </div>

        </div><!-- /.container-fluid -->
      </section>
@endif
@endsection
