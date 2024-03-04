@extends('layouts.app')
@section('body')
<section class="content bg-white">
    <div class=" my-4 text-center">
    <h2>Edit Profile</h2>
    </div>
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
{{-- <h3 class=" my-2 text-center text-primary">
{{strtoupper(Auth::user()->name)}}
</h3> --}}
    </div>




</div>


<form method="POST" action="{{route('teacher#updateProfile')}}" enctype="multipart/form-data" class=" card-body">

@csrf
    {{-- <div class="form-group ">
        <label class=" col-form-label">Teacher ID</label>
        <div class="">
            <input  value="{{Auth::user()->id}}" class=" form-control" name="id" type="integer">
        </div>
      </div> --}}

      <div class="form-group ">
        <label class=" col-form-label">Upload Profile</label>
        <div class="">
        <input type="file" class=" form-control" name='img'  placeholder="Upload Your Profie">
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">Name</label>
        <div class="">
            <input value="{{old('name',Auth::user()->name)}}" class=" form-control" placeholder="Enter Your Name" name="name" type="text">
           @error('name')
           <small class=" text-danger ">{{$message}}</small>
           @enderror
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">Email</label>
        <div class="">
            <input value="{{old('email',Auth::user()->email)}}" class=" form-control" placeholder="Enter Your Email"  name="email" type="email">
            @error('email')
            <small class=" text-danger ">{{$message}}</small>
            @enderror
        </div>
      </div>



      <div class="form-group ">
        <label class=" col-form-label">Phone</label>
        <div class="">
            <input placeholder="Enter Your Phone Number"   value="{{old('phone',Auth::user()->phone)}}" class=" form-control" name="phone" type="number">
      @error('phone')
      <small class=" text-danger ">{{$message}}</small>
      @enderror
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">Address</label>
        <div class="">
            <input placeholder="Enter Your Address"   value="{{old('address',Auth::user()->address)}}" class=" form-control" name="address" type="text">
      @error('address')
      <small class=" text-danger ">{{$message}}</small>
      @enderror
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">Gender</label>
        <div class="">
        <select name="gender" class=" form-control" id="">
            <option value="">Slect Gender</option>
            <option @if (Auth::user()->gender === 'male')
           selected
            @endif value="male">Male</option>
            <option  @if (Auth::user()->gender === 'female')
                selected
                 @endif value="female">Female</option>
        </select>
        @error('gender')
        <small class=" text-danger ">{{$message}}</small>
        @enderror
        </div>
      </div>


      <div class="form-group ">
        <label class=" col-form-label">Role</label>
        <div class="">
<input type="text" value="{{Auth::user()->role}}" class=" form-control" placeholder="Enter Your Role"  disabled >
        </div>
      </div>


      <div class="form-group ">
        <label class=" col-form-label">Class ID</label>
        <div class="">
            <input disabled placeholder="Enter Your Class Id"   value="{{old('classId',Auth::user()->class_id)}}" class=" form-control" name="classId" type="integer">
        </div>
      </div>


      <div class=" bg-white card-footer float-end ">

        <button type="submit" class=" btn btn-success float-right p-2 mx-3">Update</button>

    </div>

</form>




          </div>
          <!-- /.card -->
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection
