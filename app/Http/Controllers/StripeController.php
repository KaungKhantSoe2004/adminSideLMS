<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\User;
use App\Models\school;
use App\Models\myStripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StripeController extends Controller
{
    //
    public function index(){
        return view('dashboard');
    }

    public function checkout(Request $request){

        $data =  $this->getCreatableSchool($request);
        // $data = json_encode($arr);

// dd($data);

Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
$session = \Stripe\Checkout\Session::create([
    'line_items'=>[
        [
            'price_data' => [
                'currency' => 'USD',
                'product_data'=> [
                    'name'=> 'Send me money!!!',
                ],
                'unit_amount' => 200,
            ],
            'quantity' => 1,
        ],
        ],
        'mode' => 'payment',
        'success_url' => route('success',[$data['schoolName'],$data['schoolEmail'],$data['schoolAddress'],$data['schoolType'],$data['password']]),
        'cancel_url' => route('dashboard'),
]);
return redirect()->away($session->url);
    }

    private function getCreatableSchool($request){
        $validatingRules = [
          'schoolName' => ['required'],
          'schoolEmail'=> ['required',"unique:schools,schoolEmail",],
          'schoolAddress'=> ['required'],
          'schoolType'=> ['required'],
          'password'=> ['required', 'min:9',"same:password_confirmation"],
          'password_confirmation'=> ['required','same:password']
        ];
      Validator::make($request->all(),$validatingRules)->validate();
      return [
          'schoolName'=> $request->schoolName,
          'schoolEmail'=> $request->schoolEmail,
          'schoolAddress'=> $request->schoolAddress,
          'schoolType'=> $request->schoolType,
          'password' =>$request->password
      ];
      }


    public function success(Request $request){
        // dd($request->schoolEmail);
$data = [
    'schoolName' => $request->schoolName,
    'schoolEmail'=> $request->schoolEmail,
    'schoolAddress'=> $request->schoolAddress,
    'schoolType'=> $request->schoolType,
    'password'=> Hash::make($request->password)
];
// dd($data);
// $myData = myStripe::create($data);
$school = school::create($data);
$stripe = [
    'payer_name'=> $request->schoolName,
    'payer_email'=> $request->schoolEmail,
    'amount'=> '20$'
];
$myData = myStripe::create($stripe);
// dd($myData,$school);
if(Auth::user() !== null){
 $id = school::where('schoolEmail',$request->schoolEmail)->first()->id;
 $userId = Auth::user()->id;

    $userData = ['school_id'=> $id ];
  User::where('id',$userId)->update($userData);
    return redirect()->route('admin#directSchoolPage');

}
// dd($myData,$school);
        return redirect()->route('registerPage')->with(['schoolCreated'=> "You have successfully bought a school.Now register school Admin Account"]);
    }
}
