@extends('layouts.app')
@section('body')

@if (Auth::user()->school_id === null)
<div class=" w-100 h-100 pt-3">
    <h2 class=" text-danger text-center">You can't create classes without having a school.
     <a href="{{route('admin#directSchoolPage')}}">
    <button class=" btn btn-danger">
        Buy One!</button></a>
    </h2>
</div>
@else
   <div class=" pt-3">



    @if (session('classCreated'))
    <div class="alert alert-danger offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
        <div class="">
          {{session('classCreated')}}
        </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
    @endif


    @if (session('updated'))
    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
        <div class="">
          {{session('updated')}}
        </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
    @endif

@if (isset($classData))
<div class=" card p-4 col-9 d-flex justify-content-center offset-1">
    <h3 class=" text-center card-header">Editing Class ID ({{$classData->id}})</h3>
    <div class=" card-body col-10 offset-1 ">
        <form action="{{route('admin#updateClass')}}" class=" col-12 gap-2  " method="POST">
            @csrf
            <div class="form-group  ">
                <label class=" col-form-label">Class Name</label>
                <div class="">
                    <input type="hidden" value="{{$classData->id}}" name="id">
                    <input type="text" class=" form-control" value="{{$classData->name}}" placeholder="Enter Class Name " name="name">
              @error('className')
              <small class=" text-danger ">{{$message}}</small>
              @enderror
                </div>
              </div>
    <div class=" ">
        <input type="submit" class=" btn   btn-sm bg-secondary" style=" margin-start: 10px" value="Update">
    </div>
        </form>
    </div>
</div>
@else
<div class=" card p-4 col-9 d-flex justify-content-center offset-1">
    <h3 class=" text-center card-header">Create Class</h3>
    <div class=" card-body col-10 offset-1 ">
        <form action="{{route('admin#createClass')}}" class=" col-12 gap-2  " method="POST">
            @csrf
            <div class="form-group  ">
                <label class=" col-form-label">Class Name</label>
                <div class="">
                    <input type="text" class=" form-control" placeholder="Enter Class Name " name="className">
              @error('className')
              <small class=" text-danger ">{{$message}}</small>
              @enderror
                </div>
              </div>
    <div class=" ">
        <input type="submit" class=" btn   btn-sm bg-secondary" style=" margin-start: 10px" value="Create">
    </div>
        </form>
    </div>
</div>
@endif


    <section class="content">
        <div class="container-fluid">
          <div class="row mt-4">
            <div class="col-12">

           <div class=" row">
              <h5 class="col-3 p-2 my-2 ms-2 ">
                  <i class="fas fa-list"></i> Total - {{$data->count()}}
              </h5>

             @if (request('key'))
             <h5 class="col-3 p-2 my-2 offset-5">
              <i class="fas fa-key"></i> Search Key - {{request('key')}}
          </h5>
             @endif
           </div>

              <div class="card ">
                <div class="card-header">


  {{-- <h5 class=" offset-1">
     Total <i class="fas fa-list"></i>
  </h5> --}}


                  <div class="card-tools">
                  <form action="#" method="GET">
                      @csrf
                      <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="key" class="form-control float-right" placeholder="Search">

                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                  </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                  @if (session('accDel'))
                      <div class="alert alert-danger offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
        <div class="">
          {{session('accDel')}}
        </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      @endif

                      @if (session('deleted'))
                      <div class="alert alert-danger offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
        <div class="">
          {{session('deleted')}}
        </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      @endif

               <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                        <th>ID</th>

                      <th>Class Name</th>
                      <th>Class Created By</th>
                      <th>Class Created At</th>
                      <th></th>
                      {{-- <th>School Type</th> --}}

                      {{-- <th></th> --}}
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($data as $a)
                      <tr>
                        <td>{{$a->id}}</td>

                          <td>{{$a->name}}</td>

                          <td>{{$a->userName}}({{$a->userRole}})</td>
                          <td>{{$a->created_at}}</td>

                          <td>

                          </td>
                         @if (Auth::user()->role ==='schoolAdmin' || $a->created_by === Auth::user()->id)
                         <td>
                            <a href="{{route('admin#classesDirectPage',$a->id)}}">
                               <button class="btn btn-sm bg-warning text-white">
                            <i class=" fas fa-edit "></i>
                            </button>

                           </a>
                           <a href="{{route('classDelete',$a->id)}}">
                            <button class="btn btn-sm bg-danger text-white">
                         <i class=" fas fa-trash "></i>
                         </button>

                        </a>
                             </td>
                         @endif
                        </tr>
                    @endforeach


                  </tbody>

                </table>

                </div>

                <!-- /.card-body -->
              </div>
              {{-- {{
                  $data->appends(request()->query())->links()
              }} --}}
              <!-- /.card -->
            </div>
          </div>

        </div><!-- /.container-fluid -->
      </section>



   </div>
@endif

@endsection
