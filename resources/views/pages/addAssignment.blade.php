@extends('layouts.app')
@section('body')
 <div class=" col-9 offset-1 my-5 bg-white card">
    <div class=" card-header">
        <h2 class=" text-center">Add Assignment</h2>
    </div>
    <form action="{{route('admin#addAssignment')}}" method="POST"  class=" card-body">

@csrf

{{-- @if (session('classDifferent'))
<div class="alert alert-danger offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
    <div class="">
      {{session('classDifferent')}}
    </div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
@endif --}}


        <div class="form-group ">
            <label class=" col-form-label">Name</label>
            <div class="">
                <input type="text" class=" form-control" placeholder="Enter Assignment Name" name="name">
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
                   <option value="{{$item->id}}">{{$item->name}}({{$item->className}})</option>
                 @endforeach
                </select>
          @error('gender')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div>


          {{-- <div class="form-group ">
            <label class=" col-form-label">Subject</label>
            <div class="">
                <select name="subject" placeholder="Choose Teacher Class" class=" form-control" id="">
                 @foreach ($subject as $item)
                   <option value="{{$item->id}}">{{$item->name}}({{$item->className}})</option>
                 @endforeach
                </select>
          @error('gender')
          <small class=" text-danger ">{{$message}}</small>
          @enderror

            </div>
          </div> --}}



          {{-- @if (Auth::user()->role === 'schoolAdmin')
          <div class="form-group  ">
            <label class=" col-form-label">Choose Subject Teacher</label>
            <div class="">
                <select name="teacher" class=" form-control" id="">
                   @foreach ($teachers as $c)
                       <option value="{{$c->id}}">{{$c->name}} ({{$c->className}})</option>
                   @endforeach
                </select>
          @error('class')
          <small class=" text-danger ">{{$message}}</small>
          @enderror
            </div>
          </div>
          @endif --}}




        <div class=" card">
            <div class="  card-header">Questions for Assignments</div>

           <div id="questionContainer">



            <div id="eachQuestion1" class="  question my-3">

                <h5 class=" text-center bold">
                 Number 1 Question
                </h5>
                <div class=" col-12  row">
                 <div class=" col-10 offset-1">


<div class=" my-3" id="1wrapper"></div>

                     <div class="form-group ">
                         <label class=" col-form-label">Question Description</label>
                         <div class="">
                             <input type="text" id="1name" class=" form-control" placeholder="Enter Question Description" >
                             <input type="hidden" name="questionname[]" id="1nameh">
                       @error('question1name')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>

                 </div>
                 <div class="  col-md-3 offset-md-1 col-12 offset-0">


                     <div class="form-group ">
                         <label class=" col-form-label">First Choice</label>
                         <div class="">
                             <input id="1choice1" type="text" class=" form-control" placeholder="Enter First Choice" >
                             <input type="hidden" name="questionchoice1[]" id="1choice1h">
                       @error('question1choice1')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>


                 </div>
                 <div class=" col-md-3 offset-md-1 col-12 offset-0">


                     <div class="form-group ">
                         <label class=" col-form-label">Second Choice</label>
                         <div class="">
                             <input id="1choice2" type="text" class=" form-control" placeholder="Enter Second Choice" >
                             <input type="hidden" name="questionchoice2[]" id="1choice2h">
                             @error('question1choice2')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>

                 </div>
                 <div class=" col-md-3 offset-md-1 col-12 offset-0">


                     <div class="form-group ">
                         <label class=" col-form-label">Third Choice</label>
                         <div class="">
                             <input id="1choice3" type="text" class=" form-control" placeholder="Enter Third Choice" >
                             <input type="hidden" name="questionchoice3[]" id="1choice3h">
                       @error('question1choice3')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>

                 </div>
                 <div class=" border-bottom border-solid   col-12 ">

                  <div class=" col-10 offset-1">
                     <div class="form-group ">
                         <label class=" col-form-label">Answer</label>
                         <div class="">
                             <input id="1answer" type="text" class=" form-control" placeholder="Enter Question Answer" >
                             <input type="hidden" name="questionanswer[]" id="1answerh">
                       @error('question1answer')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>

                       <div class=" my-4">
                        <button id="1save" type="button" class=" btn btn-primary">Save</button>
                        </div>
                  </div>


                 </div>
                 <u></u>

                </div>





             </div>

           </div>


           <div class=" col-10 offset-1 ">

            {{-- <button id="delete" type="button" class=" my-4 btn btn-danger ">Remove Question Number 2</button> --}}
            <button id="next" type="button" class=" my-4 btn btn-success"> Add Next Question</button>
            <div class=" d-inline" id="remove">
              <button id='removeBtn' type="button" class="btn btn-danger">Remove</button>
            </div>
        </div>
        </div>




<div class=" card-footer float-end">
    <button class=" float-right  btn btn-dark " type="submit">Submit</button>
</div>

    </form>
 </div>


 <script>
    // const body = document.getElementsByTagName("body")[0];

   const qContainer = document.getElementById('questionContainer');
let questionArray = [
    1,2,3,4,5,6,7,8,9,
];

const nextBtn = document.getElementById('next');
const remove = document.getElementById('remove');

const eachQuestion = document.getElementsByClassName('question');
let num = 1;
let nextDiv;


let validation = ()=> {

     for(let i = 1; i< num +1; i++){
// alert(i);
        let saveFunction = ()=> {
            // alert(i);
    if(document.getElementById(`${i}name`).value === '' ||
     document.getElementById(`${i}answer`).value === '' ||
      document.getElementById(`${i}choice1`).value === '' ||
     document.getElementById(`${i}choice2`).value === '' ||  document.getElementById(`${i}choice3`).value === ''){
    document.getElementById(`${i}wrapper`).innerHTML = `

    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
        <div class="">
      You have to fill All The forms.
        </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

    `
     }else{
        let name = document.getElementById(`${i}name`).value ;
        let answer = document.getElementById(`${i}answer`).value;
        let choiceOne = document.getElementById(`${i}choice1`).value;
        let choiceTwo = document.getElementById(`${i}choice2`).value;
        let choiceThree = document.getElementById(`${i}choice3`).value;

        document.getElementById(`${i}wrapper`).remove();
        // document.getElementById(`${i}eachQuestion`).classList.add("bg-success")
        document.getElementById(`${i}name`).disabled = true;
        document.getElementById(`${i}answer`).disabled = true;
        document.getElementById(`${i}choice1`).disabled = true;
        document.getElementById(`${i}choice2`).disabled = true;
        document.getElementById(`${i}choice3`).disabled = true;
        document.getElementById(`${i}nameh`).value = name;
        document.getElementById(`${i}answerh`).value = answer;
        document.getElementById(`${i}choice1h`).value = choiceOne;
        document.getElementById(`${i}choice2h`).value = choiceTwo;
        document.getElementById(`${i}choice3h`).value = choiceThree;

    }
      }

      document.getElementById(`${i}save`).onclick = ()=> {
       saveFunction();
      };
// alert(i);
     }

}



const nextFunciton = ()=> {
  //  remove.innerHTML = ``

  if(num === 9){
nextBtn.classList.add('d-none');

  }
removeBtn.classList.remove('d-none');
  num++;
nextDiv =  `
<div id="${num}eachQuestion" class="  question my-3">

                <h5 class=" text-center bold">
                 Number ${num} Question
                </h5>
                <div class=" col-12  row">
                 <div class=" col-10 offset-1">


                    <div class=" my-3" id="${num}wrapper"></div>

                     <div class="form-group ">
                         <label class=" col-form-label">Question Description</label>
                         <div class="">
                             <input id="${num}name" type="text" class=" form-control" placeholder="Enter Question Description" >
                             <input type="hidden" name="questionname[]" id="${num}nameh">
                             @error('question${num}name')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>

                 </div>
                 <div class="  col-md-3 offset-md-1 col-12 offset-0">


                     <div class="form-group ">
                         <label class=" col-form-label">First Choice</label>
                         <div class="">
                             <input id="${num}choice1" type="text" class=" form-control" placeholder="Enter First Choice" >
                             <input type="hidden" name="questionchoice1[]" id="${num}choice1h">
                             @error('question${num}choice1')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>



                 </div>
                 <div class=" col-md-3 offset-md-1 col-12 offset-0">


                     <div class="form-group ">
                         <label class=" col-form-label">Second Choice</label>
                         <div class="">
                             <input id="${num}choice2" type="text" class=" form-control" placeholder="Enter Second Choice" >

                             <input type="hidden" name="questionchoice2[]" id="${num}choice2h">
                             @error('question${num}choice2')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>

                 </div>
                 <div class=" col-md-3 offset-md-1 col-12 offset-0">


                     <div class="form-group ">
                         <label class=" col-form-label">Third Choice</label>
                         <div class="">
                             <input id="${num}choice3" type="text" class=" form-control" placeholder="Enter Third Choice" >
                             <input type="hidden" name="questionchoice3[]" id="${num}choice3h">
                             @error('question${num}choice3')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>

                 </div>
                 <div class=" border-bottom border-solid   col-12 ">

                  <div class=" col-10 offset-1">
                     <div class="form-group ">
                         <label class=" col-form-label">Answer</label>
                         <div class="">
                             <input id="${num}answer" type="text" class=" form-control" placeholder="Enter Question Answer" >
                             <input  type="hidden" name="questionanswer[]" id="${num}answerh">
                             @error('question${num}answer')
                       <small class=" text-danger ">{{$message}}</small>
                       @enderror

                         </div>
                       </div>
                  </div>

                  <div class=" col-10 offset-1 my-4">
                        <button id="${num}save" type="button" class=" btn btn-primary">Save</button>
                        </div>


                 </div>

                 <u></u>

                </div>

             </div>

           </div>
`

qContainer.innerHTML += nextDiv;
validation();
}



const deleteFunction = ()=> {
  nextBtn.classList.remove('d-none');
  if(num === 2){
    removeBtn.classList.add('d-none');
  }
    document.getElementById(`${num}eachQuestion`).remove();
  num--;
  validation();
}
const removeBtn = document.getElementById('removeBtn');
removeBtn.classList.add('d-none');
nextBtn.onclick= nextFunciton;
removeBtn.onclick = deleteFunction;

document.getElementById('1save').onclick = ()=> {
    if(document.getElementById(`1name`).value === '' ||
     document.getElementById(`1answer`).value === '' ||
      document.getElementById(`1choice1`).value === '' ||
     document.getElementById(`1choice2`).value === '' ||
      document.getElementById(`1choice3`).value === ''){
    document.getElementById(`1wrapper`).innerHTML = `

    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
        <div class="">
      You have to fill All The forms.
        </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

    `
     }else{



        let name = document.getElementById(`1name`).value ;
        let answer = document.getElementById(`1answer`).value;
        let choiceOne = document.getElementById(`1choice1`).value;
        let choiceTwo = document.getElementById(`1choice2`).value;
        let choiceThree = document.getElementById(`1choice3`).value;

        document.getElementById(`1wrapper`).remove();
        // document.getElementById(`${i}eachQuestion`).classList.add("bg-success")
        document.getElementById(`1name`).disabled = true;
        document.getElementById(`1answer`).disabled = true;
        document.getElementById(`1choice1`).disabled = true;
        document.getElementById(`1choice2`).disabled = true;
        document.getElementById(`1choice3`).disabled = true;
        document.getElementById(`1nameh`).value = name;
        document.getElementById(`1answerh`).value = answer;
        document.getElementById(`1choice1h`).value = choiceOne;
        document.getElementById(`1choice2h`).value = choiceTwo;
        document.getElementById(`1choice3h`).value = choiceThree;



     }
    }

// each Question validation

validation();
</script>


@endsection


{{-- <div class=" my-3 " id='${num}wrapper'>
</div> --}}
{{-- let saveFunction = ()=> {
    if(document.getElementById(`${i}`name).value === '' ||
     document.getElementById(`${i}`answer).value === '' ||
      document.getElementById(`${i}choice1`).value === '' ||
     document.getElementById(`${i}choice2`).value === '' ||  document.getElementById(`${i}choice3`).value === ''){
    document.getElementById(`${i}wrapper`).innerHTML = `

    <div class="alert alert-primary offset-7 my-3 col-5 alert-dismissible fade show" role="alert">
        <div class="">
      You have to fill All The forms.
        </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

    `
     }
      } --}}
