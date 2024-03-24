@extends('layouts.app')
@section('body')
 <div class=" col-9 offset-1 my-5 bg-white card">
    <div class=" card-header">
        <h2 class=" text-center">Edit Assignment</h2>
    </div>
    <div   class=" card-body">


<form action="{{route('admin#updateAssignment')}}" method="POST" class=" card-body">
@csrf
    <div class="form-group ">
        <label class=" col-form-label">Name</label>
        <div class="">
            <input type="text" class=" form-control" value="{{$data->name}}" placeholder="Enter Assignment Name" name="name">
      @error('name')
      <small class=" text-danger ">{{$message}}</small>
      @enderror

        </div>
      </div>



      <div class="form-group ">
        <label class=" col-form-label">Subject</label>
        <div class="">
            <select name="subject" placeholder="Choose Teacher Class" class=" form-control" id="">
             @foreach ($subject as $item)
               <option
               @if ($item->id === $data->subject_id)
               selected
               @endif
               value="{{$item->id}}">{{$item->name}}({{$item->className}})</option>
             @endforeach
            </select>
      @error('subject')
      <small class=" text-danger ">{{$message}}</small>
      @enderror
      <input type="hidden" value="{{$data->id}}" name="assignmentId">
        </div>
      </div>
 <div class="  py-3 ">
    <button class=" btn btn-dark" type="submit">Update</button>
 </div>
</form>














        <div class=" card">
            <div class="  card-header">Questions for Assignments</div>

           <div class=" col-10 offset-1 card ">


           <div>


            @error('questionDescription')
            <small class=" my-4 text-danger ">{{$message}}</small>
            @enderror
            @error('choice1')
            <small class=" my-4 text-danger ">{{$message}}</small>
            @enderror

            @error('choice2')
            <small class=" my-4 text-danger ">{{$message}}</small>
            @enderror

            @error('choice3')
            <small class=" text-danger ">{{$message}}</small>
            @enderror

            @error('answer')
            <small class=" text-danger ">{{$message}}</small>
            @enderror


           </div>

           @foreach ($question as $e)



           @if (session('question'.$e->name.'updated'))
           <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
               <div class="">
                 {{session('question'.$e->name.'updated')}}
               </div>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                               </div>
           @endif


           <form action="{{route('admin#updateQuestion')}}" method="POST" id="eachQuestion1" class=" col-10 offset-1  question my-3">
@csrf
            <h5 class=" text-center bold">
             Number {{$e->name}} Question
            </h5>
            <div class=" col-12  row">
             <div class=" col-10 offset-1">




                 <div class="form-group ">
                     <label class=" col-form-label">Question Description</label>
                     <div class="">
                         <input type="text" name="questionDescription" value="{{old('questionDescription',$e->description)}}" class=" form-control" placeholder="Enter Question Description" >



                     </div>
                   </div>

             </div>
             <div class="  col-md-3 offset-md-1 col-12 offset-0">


                 <div class="form-group ">
                     <label class=" col-form-label">First Choice</label>
                     <div class="">
                         <input id="1choice1" name="choice1" value="{{old('choice1',$e->firstChoice)}}" type="text" class=" form-control" placeholder="Enter First Choice" >
<input type="hidden" value="{{$e->id}}" name="id">
<input type="hidden" value="{{$data->id}}" name="assignmentId">

                     </div>
                   </div>


             </div>
             <div class=" col-md-3 offset-md-1 col-12 offset-0">


                 <div class="form-group ">
                     <label class=" col-form-label">Second Choice</label>
                     <div class="">
                         <input name="choice2" value="{{old('choice2',$e->secondChoice)}}" type="text" class=" form-control" placeholder="Enter Second Choice" >



                     </div>
                   </div>

             </div>
             <div class=" col-md-3 offset-md-1 col-12 offset-0">


                 <div class="form-group ">
                     <label class=" col-form-label">Third Choice</label>
                     <div class="">
                         <input name="choice3" value="{{old('choice3',$e->thirdChoice)}}" type="text" class=" form-control" placeholder="Enter Third Choice" >


                     </div>
                   </div>

             </div>
             <div class=" border-bottom border-solid   col-12 ">

              <div class=" col-10 offset-1">
                 <div class="form-group ">
                     <label class=" col-form-label">Answer</label>
                     <div class="">
                         <input name="answer"value="{{old('answer',$e->answer)}}" type="text" class=" form-control" placeholder="Enter Question Answer" >



                     </div>
                   </div>

                   <div class=" my-4">
                    <button id="1save" type="submit" class=" btn btn-primary">Update</button>
                    </div>
              </div>


             </div>
             <u></u>

            </div>





         </form>

       </div>

           @endforeach


           {{-- <div class=" col-10 offset-1 ">

            <button id="next" type="button" class=" my-4 btn btn-success"> Add Next Question</button>
            <div class=" d-inline" id="remove">
              <button id='removeBtn' type="button" class="btn btn-danger">Remove</button>
            </div>
        </div> --}}
        </div>




<div class=" card-footer float-end">
    <button class=" float-right  btn btn-dark " type="submit">Submit</button>
</div>

    </div>
 </div>






 @endsection
