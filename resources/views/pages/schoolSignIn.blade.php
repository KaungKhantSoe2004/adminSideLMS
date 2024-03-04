@extends('layouts.app')
@section('body')
<div class=" col-7 offset-2 my-5 bg-white card">
    <div class=" card-header">
        <h2 class=" text-center">Sign In to the school</h2>
    </div>
    <form action="{{route('admin#schoolSignIn')}}" method="POST"  class=" card-body">




@csrf

        <div class="form-group ">
            <label class=" col-form-label">School Email</label>
            <div class="">
                <input type="email" class=" form-control" placeholder="Enter School Email" name="schoolEmail">
          @error('schoolEmail')
          <small class=" text-danger ">{{$message}}</small>
          @enderror
          @if (session('noData'))
          <small class=" text-danger ">{{session('noData')}}</small>
          @endif

            </div>
          </div>


          <div class="form-group ">
            <label class=" col-form-label">School Sign In Password</label>
            <div class="">
                <input type="password" class=" form-control" placeholder="Enter School Password" name="schoolPassword">
          @error('schoolPassword')
          <small class=" text-danger ">{{$message}}</small>
          @enderror
          @if (session('falsePassword'))
<small class=" text-danger ">{{session('falsePassword')}}</small>
@endif
            </div>
          </div>




<div class=" card-footer float-end">
    <button class=" float-right  btn btn-dark " type="submit">Submit</button>
</div>

    </form>
@endsection
