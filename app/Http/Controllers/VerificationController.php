<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //
    // public function index(){
    //     return view('home');
    // }


    // public function verifyaccount(){
    //     return view('otp_verification');
    // }

//     public function useractivation(Request $request){
//         $get_token = $request->token;
//         $get_token  = Verifytoken::where('token',$get_token)->first();

//         if($get_token){
//             $get_token->is_activated = 1;
//             $get_token->save();

//             $user = User::where('email',$get_token->email)->first();
//             $user->is_activated = 1;
//             $user->save();
// $getting_token = VerifyToken::where('token',$get_token->token)->first();
// $getting_token->delete();
// return redirect()->route('/home')->with(['activated'=>"Your successfully activated Your school Account"]);
//         }
// else{
//     return redirect('/verify-account')->with(['incorrect'=>'Your OTP is incorrect']);
// }

//     }



}
