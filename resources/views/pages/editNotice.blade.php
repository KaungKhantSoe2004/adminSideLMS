@extends('layouts.app')
@section('body')
 <div class=" col-9 offset-1 my-5 bg-white card">
    <div class=" card-header">
        <h2 class=" text-center">Edit Notices</h2>
    </div>
    <form action="{{route('admin#updateNotice')}}" method="POST"  class=" card-body">

@csrf

        <div class="form-group ">
            <label class=" col-form-label">Name</label>
            <div class="">
                <input type="text" value="{{old('name',$data->name)}}" class=" form-control" placeholder="Enter Notice Title" name="name">
          @error('name')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>




          <div class="form-group ">
            <label class=" col-form-label">Type</label>
            <div class="">
                <select name="type" placeholder="Enter notice type" class=" form-control" id="">
                    <option
                    @if ($data->type === 'both')
                        selected
                    @endif
                    value="both" >Both Teachers and Students</option>
                    <option  @if ($data->type === 'teacher')
                        selected
                    @endif value="teacher" >Teachers Only</option>
                    <option
                    @if ($data->type === 'student')
                    selected
                @endif
                    value="student">Students</option>
                </select>
          @error('type')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>



<input type="hidden" value="{{$data->id}}" name="id">
          <div class="form-group ">
            <label class=" col-form-label">Description</label>
            <div class="">
                <textarea  name="description" class=" form-control" placeholder="Enter Your Notice Description" id="" cols="30" rows="10">

                   {{old('description',$data->description)}}
                </textarea>
          @error('description')
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
