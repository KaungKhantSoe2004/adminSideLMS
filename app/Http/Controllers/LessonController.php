<?php

namespace App\Http\Controllers;

use App\Models\done;
use App\Models\lesson;
use App\Models\subject;
use App\Models\lmsClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    //directLesson
 public function directLesson(Request $request){
    $school_id = Auth::user()->school_id;

  if($school_id){
    $editId = $request->id;

    $data = lesson::select('lessons.*','subjects.name as subjectName','lms_classes.name as className', 'users.name as userName', 'users.role as userRole')
   ->when($request->key , function($query){
    $key = request('key');
    $query->where('lessons.name','like','%'.$key.'%');
})
    ->join('subjects','lessons.subject_id', 'subjects.id')
    ->join('lms_classes', 'lessons.class_id', 'lms_classes.id')
    ->join('users','lessons.created_by', 'users.id')
    ->where('lessons.school_id',$school_id)->paginate(10);
    $classes = subject::select('subjects.*','lms_classes.name as className')
    ->join('lms_classes','subjects.class_id','lms_classes.id')
    // ->where('created_by',Auth::user()->id)
    ->where('subjects.school_id',$school_id)->get();
    if(isset($editId)){
       $editClass = lesson::where('id',$editId)->first();
       return view('pages.lessons',compact(['data','classes','editClass']));
    }
return view('pages.lessons',compact(['data','classes']));
  }
    return view('pages.lessons');
 }


//lessonCreate
public function lessonCreate(Request $request){
    // dd($request->all());
 if($request->file('file') !== null&&$request->source !== null){

    return back()->with(['bothData'=> 'You must not fill both file and video embed link.Just One']);
 }
 if($request->file('file')=== null && $request->source === null){

    return back()->with(['noData'=> 'You have to fill one of the file or video embed link']);
 }
 $data = $this->getCreatableData($request);
 if($request->file('file')){
    $fileName = uniqid().'lesson'.$request->file('file')->getClientOriginalName();
    $request->file('file')->move(public_path()."/lesson",$fileName);
    $data['file']= $fileName;
 }
 lesson::create($data);
 return redirect()->route('admin#lessonDirect')->with(['lessonCreated'=> "One Lesson Created"]);
}
// private function for lessonCreate
private function getCreatableData($request){
$validatingRules = [
    'lessonName'=> ['required'],
    'class'=> ['required'],
    'description'=> ['required']
];
Validator::make($request->all(),$validatingRules)->validate();
if($request->file('file')){
    $type = "file";
}
if($request->source){
    $type = 'embed';
}
$classId = subject::where('id',$request->class)->first()->class_id;

return [
    'name'=> $request->lessonName,
    'type'=> $type,
    'lessonSource' => $request->source,
    'subject_id'=> $request->class,
    'description'=>$request->description,
'class_id' => $classId,
'school_id'=> Auth::user()->school_id,
'created_by'=> Auth::user()->id
];
}



// deleteLesson
public function deleteLesson(Request $request){

    $id = $request->id;
    lesson::where("id",$id)->delete();
    return redirect()->route('admin#lessonDirect')->with(['deleted'=> "One Lesson Deleted"]);
}


// updateLesson
public function updateLesson(Request $request){
    $thisData = lesson::where('id',$request->id)->first();
    if($request->file('file') !== null&&$request->source !== null){

        return back()->with(['bothData'=> 'You must not fill both file and video embed link.Just One']);
     }
     if($request->file('file')=== null && $request->source === null){

        return back()->with(['noData'=> 'You have to fill one of the file or video embed link']);
     }
     $data = $this->getCreatableData($request);
     if($request->file('file') !== null && $thisData->lessonSource !== null){
        // return back()->with(['alreadySource'=> "Lesson Source already exists.Can't fill both files"]);
$type = 'file';
$data['type'] = $type;
     }
     if($request->source !== null && $thisData->file !== null){
        // return back()->with(['alreadyFile'=> 'Lesson File Already exists.']);
        $type = 'embed';
$data['type'] = $type;
     }

     if($request->file('file')){

        if($thisData->file !== null){
            if(File::exists(public_path()."/lesson/".$thisData->file)){
            File::delete(public_path()."/lesson./".$thisData->file);
            }
            }

if($request->source !== null){
    if(File::exists(public_path()."/lesson/".$thisData->file)){
        File::delete(public_path()."/lesson./".$thisData->file);
        }
}

        $fileName = uniqid().'lesson'.$request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path()."/lesson",$fileName);
        $data['file']= $fileName;
     }
     lesson::where('id',$request->id)->update($data);
     return redirect()->route('admin#lessonDirect')->with(['updated'=> "One Lesson Updated"]);
}



// lessonDirect Page
public function lessonInfoDirect(Request $request){
    $id = $request->id;
    $done = done::select('dones.*', 'users.name as userName','users.email', 'users.gender', 'users.phone', 'users.address')
   ->join('users', 'dones.user_id', 'users.id')
    ->where('dones.lesson_id',$id)->get();

    $data = lesson::where('id',$id)->first();

return view('pages.lessonInfo',compact(['data','done']));
}

// lessonDone

}
