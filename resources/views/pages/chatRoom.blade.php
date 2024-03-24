@extends('layouts.app')
@section('body')

<div class=" bg-white " style=" width: 100%;  " >
    <div class="   pb-5  col-12  d-flex flex-column justify-content-end" style="   ">


        {{-- <div class=" col-12 mt-4 message">
            <div class=" col-md-5 col-10 d-flex  ">
<div class=" mr-2  d-flex justify-content-center">
    <img src="{{asset('logo/arthur.jpg')}}" class=" messageProfile rounded-circle" style=" " alt="">
</div>
<div class="  ml-1  col-11 row " style=" border-radius: 5px;">

   <div class=" col-11 messageText p-md-3 p-1  bg-black text-black " >
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem,
    vero maiores. Laboriosam at dolor dolorem doloribus excepturi eligendi nemo,
     nostrum optio. Eveniet, odio perferendis qui harum unde deserunt quod officia!
</div>
<h4 class=" col-1">...</h4>
</div>
            </div>
        </div> --}}





        @foreach ($messages as $m)

@if ($m->sender_id === Auth::user()->id)

<div id="scrolling_div" class="  col-12 mt-4 message d-flex justify-content-end  " >
    <div class=" col-md-5 col-10 d-flex  ">
<div class=" mr-2 ml-2  d-flex justify-content-center">
{{-- <img src="{{asset('logo/defaultProfile.jpg')}}"  style=" width: 50px;height: 50px;"alt=""> --}}
@if ($m->profile === null)
<img src="{{asset('logo/defaultProfile.jpg')}}" class=" messageProfile rounded-circle" style=" " alt="">
@else
<img src="{{asset('profileImg/'.$m->profile)}}" class=" messageProfile rounded-circle" style=" " alt="">
@endif


</div>
<div class="  ml-1 order-first  col-11 row  " style=" border-radius: 10px;">




<div class=" col-11 messageText p-md-3 p-1  bg-black text-black " >
{{$m->text}}
</div>

<h4 class=" col-1 order-first messageText " style=" height: 10px; ">

    <a class=" text-decoration-none" href="{{route('admin#deleteMessage', $m->id)}}">
<small><i class=" fas fa-trash"></i></small> </a>
</h4>


<small class=" mt-3 text-danger pl-5">
@if ( floor(( now()->timestamp - $m->created_at->timestamp ) / 60 ) < 60)
before  {{floor(( now()->timestamp - $m->created_at->timestamp ) / 60 )}} minutes
@elseif(floor(( now()->timestamp - $m->created_at->timestamp ) / 60 ) > 60 && floor(( now()->timestamp - $m->created_at->timestamp ) / 60 ) < 1440  )
before  {{floor(( now()->timestamp - $m->created_at->timestamp ) / 3600 )}} hr
@elseif(floor(( now()->timestamp - $m->created_at->timestamp ) / 60 ) > 1440 )
{{$m->created_at->format('d-m-Y')}}
@endif
</small>
</div>

    </div>

</div>
@else


<div class=" col-12 mt-4 message">
    <div class=" col-md-5 col-10 d-flex  ">
<div class=" mr-2  d-flex justify-content-center">
    @if ($m->profile === null)
    <img src="{{asset('logo/defaultProfile.jpg')}}" class=" messageProfile rounded-circle" style=" " alt="">
    @else
    <img src="{{asset('profileImg/'.$m->profile)}}" class=" messageProfile rounded-circle" style=" " alt="">
    @endif
</div>
<div class="  ml-1  col-11 row " style=" border-radius: 5px;">

<div class=" col-11 messageText p-md-3 bg-black p-1  text-black " >
{{$m->text}}
</div>
@if ($m->sender_id === Auth::user()->id)
<h4 class=" bg-danger pl-2 ">
  <small class=" messageText">  <a class=" text-decoration-none" href="{{route('admin#deleteMessage', $m->id)}}"> <button class=" btn btn-sm">
    <i class=" fas fa-trash"></i>
</button> <a class=" text-decoration-none" href="{{route('admin#deleteMessage', $m->id)}}"></small>

    </h4>
@endif
<small class=" my-3 text-danger">
    @if ( floor(( now()->timestamp - $m->created_at->timestamp ) / 60 ) < 60)
    before  {{floor(( now()->timestamp - $m->created_at->timestamp ) / 60 )}} minutes
    @elseif(floor(( now()->timestamp - $m->created_at->timestamp ) / 60 ) >= 60 && floor(( now()->timestamp - $m->created_at->timestamp ) / 60 ) <= 1440  )
    before  {{floor(( now()->timestamp - $m->created_at->timestamp ) / 3600 )}} hr
    @elseif(floor(( now()->timestamp - $m->created_at->timestamp ) / 60 ) >= 1440 )
    {{$m->created_at->format('d-m-Y')}}
    @endif
    </small>
</div>
    </div>
</div>

@endif


        @endforeach



























    </div>
    <div class=" bg-pale   col-12 d-flex justify-content-center align-items-center " style="  position: fixed; bottom: 0px; height: 10vh">

        <form action="{{route('admin#postMessage')}}" method="POST" class=" col-8 py-3 row">
@csrf
          <div class=" col-8 ">
            <input type="text" name="message" class=" form-control" placeholder="Enter Your Message">
          </div>
          <div class=" col-2">
            <button type="menu" class=" btn btn-sm btn-dark">
                <i class=" text-white fas fa-plane"></i>
              </button>
          </div>

        </form>

    </div>
</div>








@endsection

