<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\notice;
use App\Models\school;
use App\Models\lmsClass;
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
        $schools = School::paginate(10);
if (Auth::user()->role === 'schoolAdmin') {
    $notices = notice::select('notices.*', 'users.name as userName', 'users.role as userRole')
    ->join('users', 'notices.created_by', 'users.id')
    ->where('notices.school_id',Auth::user()->school_id)->get();
} else {
    $notices = notice::select('notices.*', 'users.name as userName', 'users.role as userRole')
    ->join('users', 'notices.created_by', 'users.id')
    ->orWhere('notices.type', 'both')
    ->orWhere('notices.type', 'teacher')
    ->where('notices.school_id',Auth::user()->school_id)->get();
}

        $id = Auth::user()->school_id;
if($id !== null){
    $students = User::select('users.*','lms_classes.name as className')
    ->join('lms_classes','users.class_id','lms_classes.id')
    ->where('users.role','student')->where('users.school_id',$id)->paginate(10);
    $teachers = User::select('users.*','lms_classes.name as className')
    ->join('lms_classes','users.class_id','lms_classes.id')
    ->where('users.role','teacher')->where('users.school_id',$id)->paginate(10);

    $data = school::where('id',$id)->first();
    return view('pages.school',compact(['data','schools','students', 'teachers', 'notices']));
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

// addStudentPage
public function addStudentPage(){
$schoolId = Auth::user()->school_id;
$class = lmsClass::where('school_id',$schoolId)->get();

    return view('pages.addStudent', compact(['class']));
}



// addTeacherPage
public function addTeacherPage(){
    $schoolId = Auth::user()->school_id;
$class = lmsClass::where('school_id',$schoolId)->get();
    return view('pages.addTeacher',compact(['class']));
}


// addTeacher
 public function addTeacher(Request $request){
    $data = $this->getCreatableUser($request);
    $data['role'] = 'teacher';
 User::create($data);
 return redirect()->route('admin#directSchoolPage')->with(['teacherCreated'=> "One Teacher Created"]);

}


// addStudent
public function addStudent(Request $request){
  $data = $this->getCreatableUser($request);
  $data['role'] = 'student';
  User::create($data);
  return redirect()->route('admin#directSchoolPage')->with(['studentCreated'=> "One Student Created"]);
}



private function getCreatableUser($request){
    $validatingRules = [
        'name' => ['required'],
        'email'=> ['required',Rule::unique("users","email")],
        'phone'=> ['required'],
        'address'=> ['required'],
        'gender'=> ['required'],
        'password'=> ['required'],
        'class'=> ['required']
    ];
    Validator::make($request->all(),$validatingRules)->validate();
    return [
        'name'=> $request->name,
        'email'=> $request->email,
        'phone'=> $request->phone,
        'address'=> $request->address,
        'gender'=> $request->gender,
'school_id'=> Auth::user()->school_id,
"class_id" => $request->class,
        'password'=> Hash::make($request->password)
    ];
}


// editTeacherPage
public function editTeacherPage(Request $request){
    $id = $request->id;
    $schoolId = Auth::user()->school_id;
    $class = lmsClass::where('school_id',$schoolId)->get();
    $data= User::where('id',$id)->first();
    return view('pages.editTeacher',compact(['data','class']));
}
public function editTeacher(Request $request){
    $data = $this->getUpdatableUser($request);
    User::where('id',$request->id)->update($data);
    return redirect()->route('admin#directSchoolPage')->with(['teacherUpdated'=> "One Teacher Updated"]);
}


// editStudentPage
public function editStudentPage(Request $request){
    $id = $request->id;
    $schoolId = Auth::user()->school_id;
    $class = lmsClass::where('school_id',$schoolId)->get();
    $data= User::where('id',$id)->first();
    return view('pages.editStudent',compact(['data','class']));
}

public function editStudent(Request $request){
    $data = $this->getUpdatableUser($request);
    User::where('id',$request->id)->update($data);
    return redirect()->route('admin#directSchoolPage')->with(['studentUpdated'=> "One Student Updated"]);
}

private function getUpdatableUser($request){
    $validatingRules = [
        'name' => ['required'],
        'email'=> ['required',Rule::unique("users","email")->ignore($request->id,'id')],
        'phone'=> ['required'],
        'address'=> ['required'],
        'gender'=> ['required'],
        'password'=> ['required'],
        'class'=> ['required']
    ];
    Validator::make($request->all(),$validatingRules)->validate();
    return [
        'name'=> $request->name,
        'email'=> $request->email,
        'phone'=> $request->phone,
        'address'=> $request->address,
        'gender'=> $request->gender,
'school_id'=> Auth::user()->school_id,
"class_id" => $request->class,
        'password'=> Hash::make($request->password)
    ];
}

// deleteUser
public function deleteUser(Request $request){
$id = $request->id;
User::where('id',$id)->delete();
return redirect()->route('admin#directSchoolPage')->with(['userDeleted'=> "One User Deleted"]);
}
}
