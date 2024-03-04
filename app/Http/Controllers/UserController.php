<?php

namespace App\Http\Controllers;

use App\Models\otp;
use App\Models\User;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
public function registerPage(){
    return view('auth.register');
}

// public function paymentRegister(Request $request){
//     // dd($request->all());
//  return route('register')->withInput($request->all());
// dd('ok');
// }


public function paymentDirectPage(){
    return view('payment');
}

// direct Dashboard
public function directDashboard(){
    return view('openpage');
}



// otpDirectPage
public function otpDirectPage(){
    return view('otp');
}

// mailSent
public function mailSent(Request $request){


$user = User::where('email',$request->email)->first();

if($user){
    $allOtp = otp::where('user_id',$user->id)->get();
    foreach( $allOtp as $eachOtp){
        otp::where('id',$eachOtp->id)->delete();
    }
    $otp = rand(1000,10000);
    Mail::to('kaungkhants892@gmail.com')->send(new TestEmail($user->name,$otp));
    otp::create([
        'otp' => $otp,
        'user_id'=> $user->id
    ]);
    return view('otp',compact('user','request'));
}else{
    return redirect()->back()->with(['round'=>"Sorry Wrong Email"]);
}




}

public function otpVerify(Request $request){
    $user = User::where('email',$request->email)->first();
    // dd($request->all());
    if($request->first === null || $request->second === null || $request->third === null || $request->fourth === null){
        return view('otp',compact('request','user'))->with(["error"=> "Fill The OTP Codes"]);
    }
    $otp = otp::where('user_id',$request->user_id)->first()->otp;
    // dd($request->all(),$otp);
$filledOtp = $request->first.$request->second.$request->third.$request->fourth;
if($otp === $filledOtp){


  Auth::login($user);
  return redirect()->route('teacher#home');
}else{
    $falseError = "False OTP code";
    return view('otp',compact('request','user','falseError'));
}

}


// buySchool
public function buySchool(Request $request){
    // dd($request->all());
  $data =  $this->getCreatableSchool($request);
  dd($data);
}

// private function of rbuySchool
private function getCreatableSchool($request){
  $validatingRules = [
    'schoolName' => ['required'],
    'schoolEmail'=> ['required'],
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
    'password' => Hash::make($request->password)
];
}












    //direct Edit User Page
    public function directEditUserPage(){
        return view('pages.editProfile');
    }
    // updateProfile
    public function updateProfile(Request $request){
 $data = $this->getUpdatableData($request);
 if($request->file('img')){
    if(Auth::user()->img !== null){
if(File::exists(public_path()."/profileImg/".Auth::user()->img)){
File::delete(public_path()."/profileImg./".Auth::user()->img);
}
}
$path = uniqid().'profile'.$request->file('img')->getCLientOriginalName();
$request->file('img')->move(public_path()."/profileImg",$path);
$data['img']= $path;
  }
User::where('id',Auth::user()->id)->update($data);
return redirect()->route('teacher#home')->with(['updated'=>"Account Successfully Updated"]);
    }
    // updateProfile Private function
    private function getUpdatableData($request){
    $validatingRules = [
'name' => ['required'],
'email'=> ['required', Rule::unique("users","email")->ignore(Auth::user()->id,'id')]
    ];
    Validator::make($request->all(),$validatingRules)->validate();
    return [
        'name'=> $request->name,
        'email'=> $request->email,
        'phone'=> $request->phone,
        'address'=> $request->address,
        'gender'=> $request->gender
    ];
    }


    // directChangePasswordPage
    public function directChangePasswordPage(){
        return view('pages.changePassword');
    }

    // changePassword
    public function changePassword(Request $request){
        if(Hash::check($request->oldPassword, Auth::user()->password)){
$data = $this->getChangablePassword($request);
User::where('id',Auth::user()->id)->update($data);
return redirect()->route('teacher#home')->with(['passwordUpdated'=>"Account Password Successfully Updated"]);
        }else{
            return back()->with(['oldPasswordIncorrect'=> "The Old Password You entered is Incorrect!"]);
        }
    }
    // private function for change password
    private function getChangablePassword($request){
        $validatingRules = [
            'oldPassword'=> ['required'],
            'newPassword'=> ['required', 'min:8', 'max:20', 'same:confirmPassword'],
            'confirmPassword'=> ['required', 'min:8', 'max:20', 'same:newPassword']
        ];
        Validator::make($request->all(), $validatingRules)->validate();
        return [
            'password' => Hash::make($request->newPassword)
        ];
    }
}
