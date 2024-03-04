@extends('layouts.app')
@section('body')
 <div class=" col-9 offset-1 my-5 bg-white card">
    <div class=" card-header">
        <h2 class=" text-center">Change Password</h2>
    </div>
    <form action="{{route('teacher#changePassword')}}" method="POST"  class=" card-body">


        @if (session('oldPasswordIncorrect'))
        <div class="alert alert-danger offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
            <div class="">
              {{session('oldPasswordIncorrect')}}
            </div>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
        @endif

@csrf

        <div class="form-group ">
            <label class=" col-form-label">Old Password</label>
            <div class="">
                <input type="password" class=" form-control" placeholder="Enter Your old Password" name="oldPassword">
          @error('oldPassword')
          <small class=" text-danger ">{{$message}}</small>
          @enderror
          {{-- @if (session('oldPasswordIncorrect'))
          <small class=" text-danger ">{{session('oldPasswordIncorrect')}}</small>
          @endif --}}
            </div>
          </div>


          <div class="form-group ">
            <label class=" col-form-label">New Password</label>
            <div class="">
                <input type="password" class=" form-control" placeholder="Enter Your New Password" name="newPassword">
          @error('newPassword')
          <small class=" text-danger ">{{$message}}</small>
          @enderror
            </div>
          </div>

          <div class="form-group ">
            <label class=" col-form-label">New Password Confirmation</label>
            <div class="">
                <input type="password" class=" form-control" placeholder="Enter Your New Password Again" name="confirmPassword">
          @error('confirmPassword')
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
