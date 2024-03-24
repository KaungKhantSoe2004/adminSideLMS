@extends('layouts.app')
@section('body')
<div class=" py-4">


<a class=" pr-4" href="{{route('admin#directAssignment')}}">
&nbsp; &nbsp;
    <button class=" mr-4 btn btn-dark">
    Back
<i class=" fas fa-arrow-left"></i>
</button></a>


    <h3 class=" text-center">Assignment Name - {{$data->name}}</h3>
<div class=" questionContainer">
    <h4 class=" bold mt-5 pl-4">Questions</h4>

<div class=" ">





@foreach ($questions as $e)
<div class=" card col-10 offset-1 my-4 ">
    <div class=" my-3 py-3 card-header">
        <h5 class=" text-center bold">Question - {{$e->name}}</h5>
    </div>
    <h5 class="">
        - {{$e->description}}
    </h5>
    <div class="my-3 d-flex justify-content-around">
        <h4 class="form-check form-check-inline">
            <input class="form-check-input fs-1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">{{$e->firstChoice}}</label>
          </h4>
          <h4 class="form-check form-check-inline">
            <input class="form-check-input fs-1" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">{{$e->secondChoice}}</label>
          </h4>
          <h4 class="form-check form-check-inline">
            <input class="form-check-input fs-1" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" >
            <label class="form-check-label" for="inlineRadio3">{{$e->thirdChoice}}</label>
          </h4>
    </div>
    <h5 class=" card-footer">
        Answer - <span class=" text-primary">{{$e->answer}}</span>
    </h5>
</div>
@endforeach


</div>

</div>




    {{-- <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
        <label class="form-check-label" for="inlineRadio1">1</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
        <label class="form-check-label" for="inlineRadio2">2</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" >
        <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
      </div> --}}


</div>

@endsection





