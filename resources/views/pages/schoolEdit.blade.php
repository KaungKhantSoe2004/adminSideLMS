@extends('layouts.app')
@section('body')
<section class="content bg-white">
    <div class=" my-4 text-center">
    <h2>Edit School Info</h2>
    </div>
    <div class="container-fluid">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card col-10 offset-1">

<div class=" card-header">
    <div class=" text-center profileImgContainer">

        @if ($request->img === null)
        <img src="{{asset('logo/defaultSchool.png')}}" class=" w-25 h-25" style="  border-radius:50%" alt="">
        @else
        <img src="{{asset('schoolLogo/'.$request->img)}}" class="  rounded-circle" style=" width: 250px; height: 250px" alt="">
        @endif
{{-- <h3 class=" my-2 text-center text-primary">
{{strtoupper(Auth::user()->name)}}
</h3> --}}
    </div>




</div>


<form method="POST" action="{{route('admin#updateSchool')}}" enctype="multipart/form-data" class=" card-body">

@csrf
    {{-- <div class="form-group ">
        <label class=" col-form-label">Teacher ID</label>
        <div class="">
            <input  value="{{Auth::user()->id}}" class=" form-control" name="id" type="integer">
        </div>
      </div> --}}

      <div class="form-group ">
        <label class=" col-form-label">Upload School Logo</label>
        <div class="">
        <input type="file" class=" form-control" name='img'  placeholder="Upload Your Profie">
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">School Name</label>
        <div class="">
            <input value="{{old('name',$request->schoolName)}}" class=" form-control" placeholder="Enter School Name" name="name" type="text">
           @error('name')
           <small class=" text-danger ">{{$message}}</small>
           @enderror
        </div>
      </div>

      <div class="form-group ">
        <label class=" col-form-label">School Email</label>
        <div class="">
            <input value="{{old('email',$request->schoolEmail)}}" class=" form-control" placeholder="Enter School Email"  name="email" type="email">
            @error('email')
            <small class=" text-danger ">{{$message}}</small>
            @enderror
        </div>
      </div>




      <div class="form-group ">
        <label class=" col-form-label">Address</label>
        <div class="">
            <input placeholder="Enter Your Address"   value="{{old('address',$request->schoolAddress)}}" class=" form-control" name="address" type="text">
      @error('address')
      <small class=" text-danger ">{{$message}}</small>
      @enderror
        </div>
      </div>







      <div class="form-group ">
        <label class=" col-form-label">School Type</label>
        <div class="">
            <select name="type" class=" form-control" id="">
                <option value="university" @if ($request->schoolType === 'university')
                   selected
                @endif >University</option>
        <option value="languageSchool"  @if ($request->schoolType === 'languageSchool')
            selected
         @endif  >Language School</option>
        <option value="elementarySchool"   @if ($request->schoolType === 'elementarySchool')
            selected
         @endif >Elementary School</option>
        <option value="highSchool"  @if ($request->schoolType === 'highSchool')
            selected
         @endif  >High School</option>
        <option value="colleage"  @if ($request->schoolType === 'colleage')
            selected
         @endif >Colleage</option>
            </select>
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
