@extends('dashboard')
@section('open')

<div class=" ">


    <div class=" w-100   paymentContainer">
        <div class=" w-100 title">
          <div class="  col-10 offset-1 card ">
            <div class=" bg-white card-header">
                <h4 class=" colored paymentHeadText text-center ">PAYMENT SYSTEM</h4>
            </div>
            <div class=" card-body">
              <div class=" col-10 offset-1">
    <div class=" card">
        <div class=" card-header">

            <div class=" fw-bold text-center">
               <h2 class=" money text-dark ">  $ 200</h2>
            </div>
            <div class="schoolSpace text-center">
                For a School Space
            </div>
        </div>
        <div class=" card-body">
            <div class=" text-center my-2 ">
                <span class=" text-danger me-2">-</span> <span class=" schoolSpace text-black-50">Manage Teacher Accounts and student accounts</span>
            </div>
            <div class="  text-center my-2 ">
                <span class=" text-danger me-2">-</span> <span class=" schoolSpace text-black-50">Manage Teacher Accounts and student accounts</span>
            </div>
            <div class="  text-center my-2 ">
                <span class=" text-danger me-2">-</span> <span class=" schoolSpace text-black-50">Manage Teacher Accounts and student accounts</span>
            </div>
        </div>
    </div>
            </div>

    <div class=" w-100  bg-white">


        <x-guest-layout class=" bg-white" >
            <x-authentication-card class=" bg-secondary col-12">
                <x-slot name="logo">
                </x-slot>


         <div style=" display:flex; justify-content: center; margin-bottom: 20px" class=" pt-4">
                <img src={{asset('logo/logo.png')}}  width="50px" height=" 50px" alt="">
               </div>



               <h1 class=" text-center">Create School</h1>
               <h4 class=" my-4 colored"> School Fees - 200$</h4>


                <form method="POST" action="{{route('checkout')}}">
                    @csrf






                    <div class="mt-4">
                        <x-label for="schoolName" value="{{ __('School Name') }}" />
                        <x-input id="schoolName" class="block mt-1 w-full" type="text" name="schoolName" :value="old('schoolName')" required autocomplete="schoolName" />
                    </div>
        @error('schoolName')
           <small class=" text-danger">{{error('schoolName')}}</small>
        @enderror



                    <div class="mt-4">
                        <x-label for="schoolEmail" value="{{ __('School Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="schoolEmail" :value="old('schoolEmail')" required autocomplete="schoolEmail" />
                    </div>

                    @error('schoolEmail')
                    <small class=" text-danger">{{error('schoolEmail')}}</small>
                 @enderror


                    <div class="mt-4">
                        <x-label for="schoolAddress" value="{{ __('School Address') }}" />
                        <x-input id="address" class="block mt-1 w-full" type="text" name="schoolAddress" :value="old('schoolAddress')" required autocomplete="schoolAddress" />
                    </div>
                    @error('schoolAddress')
                    <small class=" text-danger">{{error('schoolAddress')}}</small>
                 @enderror



                    <div class="mt-4">
                        <x-label for="schoolType" value="{{ __('School Type') }}" />
        <select class=" form-control" id="schoolType" name="schoolType" :value="old('schoolType')" required autocomplete="schoolType">

        <option value="university" >University</option>
        <option value="languageSchool" >Language School</option>
        <option value="elementarySchool" >Elementary School</option>
        <option value="highSchool" >High School</option>
        <option value="colleage">Colleage</option>
        </select>
                    </div>
                    @error('schoolType')
                    <small class=" text-danger">{{error('schoolType')}}</small>
                 @enderror



                    <div class="mt-4">
                        <x-label for="schoolPassword" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>


                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>



                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already have an account?') }}
                        </a>

                        <x-button class="ms-4">
                            {{ __('Buy') }}
                        </x-button>
                    </div>
                </form>


                <x-validation-errors class="mb-4" />


            </x-authentication-card>
        </x-guest-layout>



    </div>


            </div>
          </div>
        </div>

    </div>




</div>







@endsection



{{--
     <div style=" display:flex; justify-content: center; margin-bottom: 20px" class=" pt-4">
        <img src={{asset('logo/logo.png')}}  width="50px" height=" 50px" alt="">
       </div>



       <h1 class=" text-center">Create School</h1>
       <h4 class=" my-4 colored"> School Fees - 200$</h4>


        <form method="POST" action="{{route('checkout')}}">
            @csrf






            <div class="mt-4">
                <x-label for="schoolName" value="{{ __('School Name') }}" />
                <x-input id="schoolName" class="block mt-1 w-full" type="text" name="schoolName" :value="old('schoolName')" required autocomplete="schoolName" />
            </div>
@error('schoolName')
   <small class=" text-danger">{{error('schoolName')}}</small>
@enderror



            <div class="mt-4">
                <x-label for="schoolEmail" value="{{ __('School Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="schoolEmail" :value="old('schoolEmail')" required autocomplete="schoolEmail" />
            </div>

            @error('schoolEmail')
            <small class=" text-danger">{{error('schoolEmail')}}</small>
         @enderror


            <div class="mt-4">
                <x-label for="schoolAddress" value="{{ __('School Address') }}" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="schoolAddress" :value="old('schoolAddress')" required autocomplete="schoolAddress" />
            </div>
            @error('schoolAddress')
            <small class=" text-danger">{{error('schoolAddress')}}</small>
         @enderror



            <div class="mt-4">
                <x-label for="schoolType" value="{{ __('School Type') }}" />
<select class=" form-control" id="schoolType" name="schoolType" :value="old('schoolType')" required autocomplete="schoolType">

<option value="university" >University</option>
<option value="languageSchool" >Language School</option>
<option value="elementarySchool" >Elementary School</option>
<option value="highSchool" >High School</option>
<option value="colleage">Colleage</option>
</select>
            </div>
            @error('schoolType')
            <small class=" text-danger">{{error('schoolType')}}</small>
         @enderror



            <div class="mt-4">
                <x-label for="schoolPassword" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>


            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>



            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Buy') }}
                </x-button>
            </div>
        </form>

    --}}
