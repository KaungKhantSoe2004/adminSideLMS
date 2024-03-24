@extends('layouts.app')
@section('body')
 <div class=" col-9 offset-1 my-5 bg-white card">
    <div class=" card-header">
        <h2 class=" text-center">Add Student</h2>
    </div>
    <form action="{{route('admin#addStudent')}}" method="POST"  class=" card-body">
@csrf

        <div class="form-group ">
            <label class=" col-form-label">Name</label>
            <div class="">
                <input type="text"  class=" form-control" placeholder="Enter Student Name" name="name">
          @error('name')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>


          <div class="form-group ">
            <label class=" col-form-label">Email</label>
            <div class="">
                <input type="email" class=" form-control" placeholder="Enter Student Email" name="email">
          @error('email')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>


          <div class="form-group ">
            <label class=" col-form-label">Phone</label>
            <div class="">
                <input type="number" class=" form-control" placeholder="Enter Student Ph Number" name="phone">
          @error('phone')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>

          <div class="form-group ">
            <label class=" col-form-label">Address</label>
            <div class="">
                <input type="address" class=" form-control" placeholder="Enter Student Address" name="address">
          @error('address')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>

          <div class="form-group ">
            <label class=" col-form-label">Gender</label>
            <div class="">
                <select name="gender" placeholder="Enter Student Gende" class=" form-control" id="">
                    <option value="male" >Male</option>
                    <option value="female" >Female</option>
                </select>
          @error('gender')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>



          <div class="form-group ">
            <label class=" col-form-label">Class</label>
            <div class="">
                <select name="class" placeholder="Choose Teacher Class" class=" form-control" id="">
                 @foreach ($class as $item)
                   <option value="{{$item->id}}">{{$item->name}}</option>
                 @endforeach
                </select>
          @error('gender')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>



          <div class="form-group ">
            <label class=" col-form-label"> Password</label>
            <small class=" text-primary">You have to give this password and email to the student. and so he/she can log in. </small>
            <div class="">
                <input type="password" class=" form-control" placeholder="Enter Student Password" name="password">
          @error('password')
          <small class=" text-danger ">{{$message}}</small>
          @enderror
            </div>
          </div>




<div class=" card-footer float-end">
    <button class=" float-right  btn btn-dark " type="submit">Submit</button>
</div>

    </form>
 </div>
@endsection
