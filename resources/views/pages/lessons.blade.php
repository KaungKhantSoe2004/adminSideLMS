@extends('layouts.app')
@section('body')

@if (Auth::user()->school_id === null)
<div class=" w-100 h-100 pt-3">
    <h2 class=" text-danger text-center">You can't create School lessons without having a school.
     <a href="{{route('admin#directSchoolPage')}}">
    <button class=" btn btn-danger">
        Buy One!</button></a>
    </h2>
</div>
@else
   <div class=" pt-3">



    @if (session('lessonCreated'))
    <div class="alert alert-danger offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
        <div class="">
          {{session('lessonCreated')}}
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




    @if (isset($editClass))
    <div class=" card p-4 col-9 d-flex justify-content-center offset-1">




        <h3 class=" text-center card-header">Editing   Lesson  - {{$editClass->name}}</h3>
        <div class=" card-body col-10 offset-1 ">


            @if (session('bothData'))
            <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
                <div class="">
                  {{session('bothData')}}
                </div>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
            @endif
            @if (session('noData'))
            <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
                <div class="">
                  {{session('noData')}}
                </div>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
            @endif
            @if (session('alreadySource'))
            <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
                <div class="">
                  {{session('alreadySource')}}
                </div>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
            @endif   @if (session('alreadyFile'))
            <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
                <div class="">
                  {{session('alreadyFile')}}
                </div>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
            @endif
            <form action="{{route('admin#updateLesson')}}" enctype="multipart/form-data" class=" col-12 gap-2  " method="POST">
                @csrf
                <input type="hidden" value="{{$editClass->id}}" name="id">
                <div class="form-group  ">
                    <label class=" col-form-label">Lesson Name</label>
                    <div class="">
                        <input type="text" class=" form-control" value="{{old('lessonName',$editClass->name)}}" placeholder="Enter Lesson Name " name="lessonName">
                  @error('lessonName')
                  <small class=" text-danger ">{{$message}}</small>
                  @enderror
                    </div>
                  </div>

                  <div class="form-group  ">
                    <label class=" col-form-label">Choose Subject</label>
                    <div class="">
                        <select name="class" class=" form-control" id="">
                           @foreach ($classes as $c)
                               <option
                               @if ($editClass->subject_id === $c->id)
                                selected
                               @endif
                               value="{{$c->id}}">{{$c->name}}({{$c->className}})</option>
                           @endforeach
                        </select>
                  @error('class')
                  <small class=" text-danger ">{{$message}}</small>
                  @enderror
                    </div>
                  </div>

                  <div class="form-group  ">
                    <label class=" col-form-label">Lesson File Or Document</label>
                    <br>
                    <small class=" text-primary">We don't allow video files and pdf files to upload.Only Img  are allowed here input.</small>
                    <div class="">

                        <input type="file" class=" form-control" placeholder="Enter File  " name="file">
                  @error('file')
                  <small class=" text-danger ">{{$message}}</small>
                  @enderror
                    </div>
                  </div>

                  <div class="form-group  ">
                    <label class=" col-form-label">Lesson Video</label><br>
                    <small class=" text-primary">If You want to upload videos and pdf File, you can embed them.If you want to know more info about embedding.Go to Description page.</small>
                    <div class="">
                        <input type="text" value="{{old('source',$editClass->lessonSource)}}" class=" form-control" placeholder="Enter Embed Link " name="source">
                  @error('source')
                  <small class=" text-danger ">{{$message}}</small>
                  @enderror
                    </div>
                  </div>


                  <div class="form-group  ">
                    <label class=" col-form-label">Lesson Description</label><br>

                    <div class="">
                       <textarea name="description"  id="compose-textarea" cols="30" class=" form-control" rows="10">
                        {{old('description',$editClass->description)}}
                       </textarea>
                  @error('description')
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




        <h3 class=" text-center card-header">Create Lesson</h3>
        <div class=" card-body col-10 offset-1 ">


            @if (session('bothData'))
            <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
                <div class="">
                  {{session('bothData')}}
                </div>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
            @endif
            @if (session('noData'))
            <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
                <div class="">
                  {{session('noData')}}
                </div>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
            @endif

            <form action="{{route('admin#lessonCreate')}}" enctype="multipart/form-data" class=" col-12 gap-2  " method="POST">
                @csrf
                <div class="form-group  ">
                    <label class=" col-form-label">Lesson Name</label>
                    <div class="">
                        <input type="text" class=" form-control" placeholder="Enter Subject Name " name="lessonName">
                  @error('lessonName')
                  <small class=" text-danger ">{{$message}}</small>
                  @enderror
                    </div>
                  </div>

                  <div class="form-group  ">
                    <label class=" col-form-label">Choose Subject</label>
                    <div class="">
                        <select name="class" class=" form-control" id="">
                           @foreach ($classes as $c)
                               <option value="{{$c->id}}">{{$c->name}}({{$c->className}})</option>
                           @endforeach
                        </select>
                  @error('class')
                  <small class=" text-danger ">{{$message}}</small>
                  @enderror
                    </div>
                  </div>

                  <div class="form-group  ">
                    <label class=" col-form-label">Lesson File Or Document</label>
                    <br>
                    <small class=" text-primary">We don't allow video file to upload.Only Img and Pdf File are allowed</small>
                    <div class="">

                        <input type="file" class=" form-control" placeholder="Enter File  " name="file">
                  @error('file')
                  <small class=" text-danger ">{{$message}}</small>
                  @enderror
                    </div>
                  </div>

                  <div class="form-group  ">
                    <label class=" col-form-label">Lesson Video</label><br>
                    <small class=" text-primary">If You want to upload video, you can embed them.If you want to know more info about embedding.Go to Description page.</small>
                    <div class="">
                        <input type="text" class=" form-control" placeholder="Enter Embed Link " name="source">
                  @error('source')
                  <small class=" text-danger ">{{$message}}</small>
                  @enderror
                    </div>
                  </div>


                  <div class="form-group  ">
                    <label class=" col-form-label">Lesson Description</label><br>

                    <div class="">
                       <textarea name="description"  id="compose-textarea" cols="30" class=" form-control" rows="10"></textarea>
                  @error('description')
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

                      <th> Name</th>
                      <th>Type</th>
<th>Subject</th>
<th>Class</th>
                      <th> Created By</th>
                      <th> Created At</th>
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
                          <td>{{$a->type}}</td>
                          <td>{{$a->subjectName}}</td>
<td>{{$a->className}}</td>
                          <td>{{$a->userName}}({{$a->userRole}})</td>
                          <td>{{$a->created_at}}</td>

                          <td>

                          </td>
                          <td>
                         @if (Auth::user()->role ==='schoolAdmin' || $a->created_by == Auth::user()->id)

                            <a href="{{route('admin#lessonDirect',$a->id)}}">
                               <button class="btn btn-sm bg-warning text-white">
                            <i class=" fas fa-edit "></i>
                            </button>

                           </a>
                           <a href="{{route('admin#deleteLesson',$a->id)}}">
                            <button class="btn btn-sm bg-danger text-white">
                         <i class=" fas fa-trash "></i>
                         </button>

                        </a>

                         @endif
                         <a href="{{route('admin#lessonInfoDirect', $a->id)}}">
                            <button class="btn btn-sm bg-primary text-white">
                         <i class=" fas fa-info "></i>
                         </button>

                        </a>
                        </td>
                        </tr>
                    @endforeach


                  </tbody>

                </table>


                <div>
                    {{
                        $data->links()
                    }}
                 </div>

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
