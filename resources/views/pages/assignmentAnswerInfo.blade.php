@extends('layouts.app')
@section('body')
    <div class=" text-danger">Assignment Answer Info </div>


    <div>
        <div>


<div class=" card">
    <h5 class=" card-header">Student Name - {{$userInfo->name}}</h5>
</div>


          <h2 class=" text-start text-black mt-5">
            Student Marks - {{$marks}} out of {{$count}}
          </h2>


          @foreach ($answerQuestions as $item)
          <div class=" card col-12 my-4 ">
            <div class=" my-3 py-3 card-header">
              <h5 class=" text-center bold">Question -{{$item->name}}</h5>
            </div>
            <h5 class=" text-start questionDescription">
              {" "}
              &nbsp; &nbsp;- {{$item->description}}
            </h5>
            <div class="my-3 d-flex justify-content-around">
              <h4 class="form-check form-check-inline">
                @if ($item->answer !== $item->firstChoice && $item->firstChoice === $item->userAnswer)
                <input class=" form-check-input fs-2 border-danger  text-danger bg-danger" type="radio"       value={{$item->firstChoice}} checked />


                @endif
                @if ($item->answer === $item->userAnswer && $item->firstChoice === $item->userAnswer)
                <input class=" form-check-input fs-5 border-1 text-primary  bg-primary" type="radio"       value={{$item->firstChoice}} checked />


                @endif
                {{-- <input
                class={{
                    if ($item->answer !== $item->firstChoice && $item->firstChoice === $item->userAnswer) {
                        'form-check-input fs-5 bg-danger'
                    }

                }}
                        class={{@if ($item->answer !== $item->firstChoice && $item->firstChoice === $item->userAnswer)
                    'form-check-input fs-5 bg-danger'


                @endif}}
                  className={`form-check-input fs-5  ${
                    obj.answer !== obj.firstChoice &&
                    obj.firstChoice === obj.userAnswer &&
                    "bg-danger"
                  } `}
                  type="radio"
                  {{-- name={`${obj.id}`} --}}
                 {{-- id="inlineRadio1"
                  checked={{
                   @if ($item->firstChoice === $item->userAnswer )
                   true


                @endif

                  }}
                  checked={obj.firstChoice === obj.userAnswer && true}
                  //  {obj.firstChoice == obj.userAnswer && checked}

                  value={{$item->firstChoice}}
                  onChange={getRadioData}
                />  --}}
                <label class="form-check-label" for="inlineRadio1">
                  {{$item->firstChoice}}
                </label>
              </h4>
              <h4 class="form-check form-check-inline">
                @if ($item->answer !== $item->secondChoice && $item->secondChoice === $item->userAnswer)
                <input class=" form-check-input fs-1 border-danger  text-danger bg-danger"  type="radio"     value={{$item->firstChoice}} checked />


                @endif
                @if ($item->answer === $item->secondChoice)
                <input class=" form-check-input fs-5 bg-primary text-primary" type="radio"       value={{$item->secondChoice}} checked />


                @endif
                {{-- <input
                class={{@if ($item->answer !== $item->secondChoice && $item->secondChoice === $item->userAnswer)
                    'form-check-input fs-5 bg-danger'


                @endif}}

                  type="radio"

                  checked={{
                    @if ($item->secondChoice === $item->userAnswer )
                    true


                 @endif

                   }}
                  id="inlineRadio2"

                /> --}}
                <label class="form-check-label" for="inlineRadio2">
                  {{$item->secondChoice}}
                </label>
              </h4>
              <h4 class="form-check form-check-inline">
                @if ($item->answer !== $item->thirdChoice && $item->thirdChoice=== $item->userAnswer)
                <input class=" form-check-input fs-5 text-danger bg-danger border-danger "  type="radio"     value={{$item->firstChoice}} checked />


                @endif
                @if ($item->answer === $item->thirdChoice)
                <input class=" form-check-input fs-5 bg-primary" type="radio"       value={{$item->thirdChoice}} checked />


                @endif
                {{-- <input
                class={{@if ($item->answer !== $item->thirdChoice && $item->thirdChoice === $item->userAnswer)
                    'form-check-input fs-5 bg-danger'


                @endif}}
                  type="radio"

                  id="inlineRadio3"
                  checked={{
                    @if ($item->thirdChoice === $item->userAnswer )
                    true


                 @endif

                   }}

                /> --}}
                <label class="form-check-label " for="inlineRadio3">
                  {{$item->thirdChoice}}
                </label>
              </h4>
            </div>

            <h5 class=" card-footer">

             User   Answer - <span class=" text-primary">{{$item->userAnswer}}</span>
              </h5>
              <h5 class=" card-footer">

                Answer - <span class=" text-primary">{{$item->answer}}</span>
              </h5>

          </div>
          @endforeach



          <div class=" d-flex justify-content-start mt-4  "></div>
        </div>
      </div>


@endsection
