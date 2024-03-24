@extends('layouts.app')
@section('body')
<div class=" pt-3">
    &nbsp; &nbsp;
 <a href="{{route('admin#lessonDirect')}}">
    <button class=" btn btn-dark">

        <i class=" fas fa-arrow-left"></i>
        Back</button>
</a>
</div>

<h3 class=" text-center bold">Lesson Name - {{strtoupper($data->name)}}</h3>
 &nbsp;     &nbsp; &nbsp;<div class=" mt-4 bold ">
    <h5 class=" bold col-9"> &nbsp; &nbsp; Uploaded at - {{$data->created_at->format('d-m-Y')}}</h5>
    <h5 class=" col-9 bold">&nbsp; &nbsp; Lesson Type- {{$data->type}}</h5>


    <div class=" my-4">
        &nbsp; &nbsp; &nbsp; &nbsp;
    @if ($data->type === 'file')
<iframe src="{{asset('lesson/'.$data->file)}}"  width="935" height="526 frameborder="0"></iframe>
    @else
<div class=" d-flex justify-content-center">
&nbsp; &nbsp; &nbsp; {!! $data->lessonSource !!}
</div>

    @endif
    </div>
</div>
<div class=" whitespace col-12 row">
    <div class="  col-12 whitespace">
{{$data->description}}

     Lorem ipsum dolor sit amet consectetur adipisicing elit. A ex sed delectus, autem ipsam quidem officiis cumque aut obcaecati? Et, voluptatum ipsum? Ut impedit nobis quod reiciendis libero doloremque distinctio.
            </div>
</div>

<div class=" my-5">


    <h2 class="text-center">Done List</h2>
    <table class="table table-hover text-nowrap text-center">
        <thead>
          <tr>
              <th>ID</th>

            <th> Name</th>
            <th>Email</th>
<th>Phone</th>
<th>Gender</th>
<th>Address</th>

            <th> Created At</th>
            <th></th>
            {{-- <th>School Type</th> --}}

            {{-- <th></th> --}}
          </tr>
        </thead>
        <tbody>
            @foreach ($done as $a)
            <tr>
              <td>{{$a->id}}</td>

                <td>{{$a->userName}}</td>
                <td>{{$a->email}}</td>
                <td>{{$a->phone}}</td>
<td>{{$a->address}}</td>
              <td>{{$a->gender}}</td>
                <td>{{$a->created_at->format('d-m-Y')}}</td>

                <td>

                </td>
                <td>
               @if (Auth::user()->role ==='schoolAdmin' || $a->created_by === Auth::user()->id)

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

</div>

@endsection
