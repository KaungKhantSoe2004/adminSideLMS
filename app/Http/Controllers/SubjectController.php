<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\school;
use App\Models\subject;
use App\Models\lmsClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    //directSubject
    public function directSubject(Request $request){
        $schoolId = Auth::user()->school_id;


if(isset($schoolId)){

    $data = subject::select('subjects.*','users.name as userName','users.role as userRole', 'lms_classes.name as className')->join('users','subjects.created_by','users.id')->join('lms_classes','subjects.class_id','lms_classes.id')

    ->when($request->key , function($query){
    $key = request('key');
    $query->where('subjects.name','like','%'.$key.'%');
})
    ->where('subjects.school_id',$schoolId)->paginate(10);
    $classId = $request->id;

    $mySchoolId = Auth::user()->school_id;
    $teachers = User::select('users.*', 'lms_classes.name as className')->join('lms_classes','users.class_id','lms_classes.id')
   ->where('users.school_id',$mySchoolId)->where('users.role','teacher')->get();

    $classes = lmsClass::where('school_id',$mySchoolId)->where('created_by',Auth::user()->id)->get();
// dd($classes);

    if($request->id){
        $subjectData = subject::where('id',$classId)->first();

        return view('pages.subject',compact(['data','subjectData','classes','teachers']));
    }

    return view('pages.subject', compact(['data','classes','teachers']));
}
        return view('pages.subject');
    }



    // createSubject
    public function createSubject(Request $request){
        // dd($request->all());
$validatingRules = [
    'subjectName'=> ['required'],
    'class'=> ['required']
];
Validator::make($request->all(),$validatingRules)->validate();
$data = [
    'name'=> $request->subjectName,
    'class_id'=> $request->class,
    'school_id'=> Auth::user()->school_id,
    'created_by'=> Auth::user()->id
];
if(Auth::user()->role === 'schoolAdmin'){
    $class_id = User::where('id',$request->teacher)->first()->class_id;
    if($class_id != $request->class){
        return back()->with(['classDifferent'=> "The class and teacher's class must be same"]);
    }
    $data['authorizor'] = $request->teacher;
}
if(Auth::user()->role === 'teacher'){
    $data['authorizor'] = Auth::user()->id;
}
subject::create($data);
return redirect()->route('admin#directSubject')->with(['subjectCreated'=> "One Subject Created"]);
    }



    // deleteSubject
    public function deleteSubject(Request $request){
$id = $request->id;
subject::where('id',$id)->delete();
return redirect()->route('admin#directSubject')->with(['deleted'=> "One Subject Deleted"]);
    }

    // updateSubject
    public function updateSubject(Request $request){

        $validatingRules = [
            'name'=> ['required'],
            'class'=> ['required'],

        ];
        Validator::make($request->all(),$validatingRules)->validate();
$data= [
    'name' => $request->name,
    'class_id'=> $request->class
];
if(Auth::user()->role === 'schoolAdmin'){
    $class_id = User::where('id',$request->teacher)->first()->class_id;
    if($class_id != $request->class){
        return back()->with(['classDifferent'=> "The class and teacher's class must be same"]);
    }
    $data['authorizor'] = $request->teacher;
}
$id = $request->id;
subject::where('id',$id)->update($data);
return redirect()->route('admin#directSubject')->with(['updated'=> "Subject Updated"]);
    }
}
