@extends('dashboard')
@section('open')

{{--
<x-guest-layout >
    <x-authentication-card class="">
        <x-slot name="logo">



        </x-slot>

        <x-validation-errors class="mb-4" />





    </x-authentication-card>
</x-guest-layout> --}}

<div class=" p-5 col-10 offset-1  card ">

    <div class=" mt-5" style=" display:flex; justify-content: center; margin-bottom: 20px">
        <img src={{asset('logo/logo.jpg')}}  width="50px" height=" 50px" alt="">
       </div>

<div class=" d-flex justify-content-center">
    <img src="{{asset('logo/chat.webp')}}" style=" width: 250px; height:250px" alt="">
</div>

       <h3 class=" mt-4 text-center">OTP Verification</h3>


       <div class=" text-center">
        <h4 class=" mt-4 mb-2 text-danger">
            We have sent Our Confirmation Code to {{$request->email}}
        </h4>
       @if (session('error'))
       <div class=" my-4">
        <small class=" text-danger">{{session('error')}}</small>
    </div>
       @endif
@isset($falseError)
<small class=" text-danger">{{$falseError}}</small>
@endisset

<div>

    <form action="{{route('otpVerify')}}" method="POST">
        @csrf
   <div>
       <input type="" class="  border-1  text-center  " maxLength="1" name="first" style=" width: 30px ; outlin:none; height: 30px">
   <input type="" class=" border-1  text-center  " maxLength="1" name="second" style=" width: 30px ; height: 30px">
   <input type="" class=" border-1  " maxLength="1" name="third" style=" width: 30px ; height: 30px">
   <input type="" class=" border-1  " maxLength="1" name="fourth"  style=" width: 30px ; height: 30px">
   <input type="hidden" name="email" value="{{$request->email}}">
   <input type="hidden" name="password" value="{{$request->password}}">
   <input type="hidden" name="passwordConfirmation" value="{{$request->password}}" />
   <input type="hidden" name="user_id" value="{{$user->id}}" />
   </div>
   {{-- <input type="hidden" value="{{$request->otp}}"> --}}
<input type="submit" class=" my-4 btn btn-dark" value="Continue" />
   </form>


</div>


       </div>

</div>


@endsection
