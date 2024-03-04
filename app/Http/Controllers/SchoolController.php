<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\school;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    //directSchoolPage
    public function directSchoolPage(){
        $schools = School::all();

        $id = Auth::user()->school_id;
if($id !== null){
    $data = school::where('id',$id)->first();
    return view('pages.school',compact(['data','schools']));
}else{
return view('pages.school',compact(['schools']));
}
    }





    // schoolBuyPage
    public function directSchoolBuyPage(){
        return view('pages.buySchoo');
    }


    // schoolSignOut
    public function schoolSignOut(){
        $data = [
            'school_id'=> null
        ];
        $id = Auth::user()->id;

        User::where('id',$id)->update($data);
        return redirect()->route('admin#directSchoolPage')->with(['signedout'=>"You have successfully signed out a school."]);
    }

    // direct schholSignIn page
    public function schoolSignInPage(){
        return view('pages.schoolSignIn');
    }
// schoolSignIn
public function schoolSignIn(Request $request){

$validatingRules = [
    'schoolEmail'=> ['required'],
    'schoolPassword'=> ['required']
];
Validator::make($request->all(),$validatingRules)->validate();
$data = school::where('schoolEmail',$request->schoolEmail)->first();
if(isset($data)){
if(Hash::check($request->schoolPassword, $data->password)){
    $userData = [
        'school_id'=> $data->id
    ];
    $userid = Auth::user()->id;

    User::where('id',$userid)->update($userData);
    return redirect()->route('admin#directSchoolPage')->with(['signedIn'=>"You have successfully signed in to school."]);
}else{
    return back()->with(['falsePassword'=>"Your Password is incorrect"]);
}
}else{
    return back()->with(['noData'=> "There is No school with the Email".$request->email]);
}
}


// directSchoolEditPage
public function directSchoolEditPage(Request $request){

    return view('pages.schoolEdit',compact(['request']));
}

// schoolUpdate
public function schoolUpdate(Request $request){
    $schoolId = Auth::user()->school_id;

$data =$this->getEditableData($request,$schoolId);

   if($request->file('img')){

    $school = school::where('id',$schoolId)->first();

if($school->img !== null){
    if(File::exists(public_path()."/schoolLogo./".$school->img)){
        File::delete(public_path()."/schoolLogo./".$school->img);
        }
}
$path = uniqid().'schoolLogo'.$request->file('img')->getCLientOriginalName();
$request->file('img')->move(public_path()."/schoolLogo",$path);
$data['img']= $path;
school::where('id',$schoolId)->update($data);
return redirect()->route('admin#directSchoolPage')->with(['updated'=> "Your School informations updated"]);
   }
}



// getEditableData
private function getEditableData($request,$schoolId){
    $validatingRules = [
        'name' => ['required'],
        'email'=> ['required',Rule::unique("schools","schoolEmail")->ignore($schoolId,'id')],
        'address'=> ['required'],
        'type'=> ['required'],

    ];
    Validator::make($request->all(),$validatingRules)->validate();
return [
    'schoolName'=> $request->name,
    'schoolEmail'=> $request->email,
'schoolAddress'=> $request->address,
'schoolType'=> $request->type
];

}



// schoolChangePasswordPage
public function schoolChangePasswordPage(){
    return view('pages.changeSchoolPassword');
}

// schoolUpdatePassword
public function schoolUpdatePassword(Request $request){
    $school_id = Auth::user()->school_id;
    $schoolData = school::where('id',$school_id)->first();

    if(Hash::check($request->oldPassword, $schoolData->password)){
        $data = $this->getChangablePassword($request);
        school::where('id',$school_id)->update($data);
        return redirect()->route('admin#directSchoolPage')->with(['passwordChanged'=> "School Password Successfully Changed"]);
                }else{
                    return back()->with(['oldPasswordIncorrect'=> "The Old Password You entered is Incorrect!"]);
                }




}

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
