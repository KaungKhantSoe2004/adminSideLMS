@extends('layouts.app')
@section('body')
 <div class=" col-9 offset-1 my-5 bg-white card">
    <div class=" card-header">
        <h2 class=" text-center">Add Notices</h2>
    </div>
    <form action="{{route('admin#addNotice')}}" method="POST"  class=" card-body">

@csrf

        <div class="form-group ">
            <label class=" col-form-label">Name</label>
            <div class="">
                <input type="text" class=" form-control" placeholder="Enter Notice Title" name="name">
          @error('name')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>




          <div class="form-group ">
            <label class=" col-form-label">Type</label>
            <div class="">
                <select name="type" placeholder="Enter notice type" class=" form-control" id="">
                    <option value="both" >Both Teachers and Students</option>
                    <option value="teacher" >Teachers Only</option>
                    <option value="student">Students</option>
                </select>
          @error('type')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>




          <div class="form-group ">
            <label class=" col-form-label">Description</label>
            <div class="">
                <textarea name="description" class=" form-control" placeholder="Enter Your Notice Description" id="" cols="30" rows="10"></textarea>
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
