@extends('layouts.app')
@section('body')
<section class="content bg-white">
    <div class="container-fluid">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card col-10 offset-1">

<div class=" card-header">
    <div class=" text-center profileImgContainer">

        @if (Auth::user()->img === null)
        <img src="{{asset('logo/defaultProfile.jpg')}}" class=" w-25 h-25" style="  border-radius:50%" alt="">
        @else
        <img src="{{asset('profileImg/'.Auth::user()->img)}}" class="  rounded-circle" style=" width: 250px; height: 250px" alt="">
        @endif
<h3 class=" my-2 text-center text-primary">
{{strtoupper(Auth::user()->name)}}
</h3>
    </div>

{{-- <div class=" col-12 row card-body">

   <div class=" col-md-6 com-12 border-right border-right-1">
   <div class=" text-center">
    <h5 class=" text-center">
        Teacher Id -&nbsp; {{Auth::user()->id}}
    </h5>
    <h5 class=" text-center">
 @if (Auth::user()->class_id === null)
 Class -  &nbsp;&nbsp;  No Classes
 @else

 @endif
    </h5>
   </div>
   </div>


 <div class=" col-md-6 com-12">
    <h5 class=" d-flex">
        Teacher Id -&nbsp;&nbsp; {{Auth::user()->id}}
    </h5>
    <h5>
 @if (Auth::user()->class_id === null)
 Class &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  -  &nbsp;&nbsp;  No Classes
 @else

 @endif
    </h5>
 </div>

</div> --}}


</div>



@if (session('passwordUpdated'))
<div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
    <div class="">
      {{session('passwordUpdated')}}
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

<div class=" card-body">


    <div class="form-group ">
        <label class=" col-form-label">Teacher ID</label>
        <div class="">
            <input disabled value="{{Auth::user()->id}}" class=" form-control" name="image" type="text">
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">Email</label>
        <div class="">
            <input disabled value="{{Auth::user()->email}}" class=" form-control" name="image" type="text">
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">Role</label>
        <div class="">
            <input disabled value="{{Auth::user()->role}}" class=" form-control" name="image" type="text">
        </div>
      </div>


      <div class="form-group ">
        <label class=" col-form-label">Class ID</label>
        <div class="">
            <input disabled value="{{Auth::user()->class_id}}" class=" form-control" name="image" type="text">
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">Phone</label>
        <div class="">
            <input disabled value="{{Auth::user()->phone}}" class=" form-control" name="image" type="text">
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">Address</label>
        <div class="">
            <input disabled value="{{Auth::user()->address}}" class=" form-control" name="image" type="text">
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">Gender</label>
        <div class="">
            <input disabled value="{{Auth::user()->gender}}" class=" form-control" name="image" type="text">
        </div>
      </div>


</div>


<div class=" card-footer float-end ">

<a href="{{route('teacher#changePasswordPage')}}">    <button class=" btn btn-danger float-right p-2 ms-3 ">Change Password</button></a>

    <a href="{{route('teacher#directEditProfile')}}"><button class=" btn btn-success float-right p-2 mx-3">Edit Your Profile</button></a>
</div>

          </div>
          <!-- /.card -->
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection
