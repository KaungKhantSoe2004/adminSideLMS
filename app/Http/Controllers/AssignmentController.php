<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\subject;
use App\Models\question;
use App\Models\assignment;
use Illuminate\Http\Request;
use App\Models\assignmentDone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    //directAssignment
    public function directAssignment(Request $request){
        $id = Auth::user()->school_id;

        $data = assignment::select('assignments.*','users.name as userName','users.role as userRole', 'subjects.name as subjectName', 'lms_classes.name as className')
      ->when($request->key , function($query){
        $key = request('key');
        $query->where('assignments.name','like','%'.$key.'%');
    })
        ->join('users', 'assignments.created_by', 'users.id')
        ->join('subjects', 'assignments.subject_id', 'subjects.id')
        ->join('lms_classes', 'lms_classes.id','subjects.class_id')
        ->where('assignments.school_id',$id)->paginate(10);

        // dd($data->toArray());
        return view('pages.assignment',compact(['data']));
    }

// addAssignmentPage
public function addAssignmentPage(){
$id = Auth::user()->school_id;
$subject = subject::select('subjects.*', 'lms_classes.name as className')
->join('lms_classes', 'subjects.class_id','lms_classes.id')
->where('subjects.school_id',$id)->get();
// dd($subject->toArray());
$mySchoolId = Auth::user()->school_id;
$teachers = User::select('users.*', 'lms_classes.name as className')->join('lms_classes','users.class_id','lms_classes.id')
->where('users.school_id',$mySchoolId)->where('users.role','teacher')->get();
    return view('pages.addAssignment',compact(['subject','teachers']));
}

    // addAssignment
    public function addAssignment(Request $request){
        // dd($request->all());
        $data = $this->getCreatableArray($request);
        $class_id = subject::where('id',$request->subject)->first()->class_id;
        $data['class_id']= $class_id;
        // if(Auth::user()->role === 'schoolAdmin'){
        //     $class_id = User::where('id',$request->teacher)->first()->class_id;
        //     if($class_id != $request->class){
        //         return back()->with(['classDifferent'=> "The class and teacher's class must be same"]);
        //     }
        //     $data['authorizor'] = $request->teacher;
        // }
        // if(Auth::user()->role === 'teacher'){
        //     $data['authorizor'] = Auth::user()->id;
        // }
 $myData =  assignment::create($data);
$id = $myData->id;
// dd($request->all());
for ($i=0; $i < count($request->questionname) ; $i++) {
if ($request->questionname[$i] === null) {
 return;
}
$eachQname = $request->questionname[$i] ;

$eachQchoice1 = $request->questionchoice1[$i];
$eachQchoice2 = $request->questionchoice2[$i];
$eachQchoice3 = $request->questionchoice3[$i];
$eachAnswer = $request->questionanswer[$i];
$questionData = [
    'name' => $i+1,
    'description'=> $eachQname,
    'firstChoice'=> $eachQchoice1,
    'secondChoice'=> $eachQchoice2,
    'thirdChoice'=> $eachQchoice3,
    'answer'=> $eachAnswer,
    'assignment_id'=> $id
];
// dd($questionData);
question::create($questionData);

}
return redirect()->route('admin#directAssignment')->with(['created'=> 'One Assignment Created']);
    }

    // private function for addAssignment
    private function getCreatableArray($request){
        $validatingRules =[
            'name'=> ['required'],
            'subject'=> ['required'],
            // 'question1name'=> ['required'],
            // 'question1choice1'=> ['required'],
            // 'question1choice2'=> ['required'],
            // 'question1choice3'=> ['required'],
            // 'question1answer'=> ['required'],
            // 'question2answer'=> ['required'],
        ];
        Validator::make($request->all(),$validatingRules)->validate();
        return [
            'name'=> $request->name,
            'subject_id'=> $request->subject,
            'school_id'=> Auth::user()->school_id,
            'created_by'=> Auth::user()->id
        ];
    }


    //deleteAssignment
    public function deleteAssignment(Request $request){
        $id = $request->id;
        assignment::where('id', $id)->delete();
        question::where('assignment_id',$id)->delete();
        return redirect()->route('admin#directAssignment')->with(['deleted'=> 'One Assignment Deleted']);
    }



// assignmentInfo
public function assignmentInfo(Request $request){
    $id = $request->id;
    $questions = question::where('assignment_id',$id)->get();
    $data = assignment::where('id',$id)->first();
$dones = assignmentDone::select('assignment_dones.*', 'users.name as userName','users.email', 'users.gender', 'users.phone', 'users.address')->join('users','assignment_dones.user_id','users.id')
->where('assignment_dones.assignment_id',$id)->paginate(10);

    return view('pages.assignmentInfo', compact(['data', 'questions', 'dones']));
}


// editAssignment
public function editAssignment(Request $request){
$id = $request->id;
$school_id = Auth::user()->school_id;
$subject = subject::select('subjects.*', 'lms_classes.name as className')
->join('lms_classes', 'subjects.class_id','lms_classes.id')
->where('subjects.school_id',$school_id)->get();
$data = assignment::where('id',$id)->first();
$question = question::where('assignment_id',$id)->get();
return view('pages.editAssignment', compact(['data', 'question', 'subject']));
}



// updateAssignment
public function updateAssignment(Request $request){
$validatingRules = [
    'name'=> 'required',
    'subject'=> 'required'
];
Validator::make($request->all(),$validatingRules)->validate();
$data = [
    'name'=> $request->name,
    'subject_id'=> $request->subject
];
assignment::where('id',$request->assignmentId)->update($data);
return redirect()->route('admin#directAssignment')->with(['updated'=> "Assignment Updated"]);
}


// updateQuestion
public function updateQuestion(Request $request){
    $data = $this->getUpdatableData($request);

  question::where('id',$request->id)->update($data);
  return back()->with(['question'.$request->id.'updated' => "Question Number".$request->id.'updated' ]);
}

// private function for updateQuestion
private function getUpdatableData($request){
    $validatingRules = [
        'questionDescription'=> ['required'],
        'choice1'=> ['required'],
        'choice2'=> ['required'],
        'choice3'=> ['required'],
        'answer'=> ['required']
    ];
  $ee =  Validator::make($request->all(),$validatingRules)->validate();

    return [
        'description'=> $request->questionDescription,
        'firstChoice'=> $request->choice1,
        'secondChoice'=> $request->choice2,
        'thirdChoice'=> $request->choice3,
        'answer'=>$request->answer
    ];
}


// assignmentAnswerInfo
public function assignmentAnswerInfo(Request $request){
    $id = $request->id;
    $userId = assignmentDone::where('id',$id)->first()->user_id;
    $assignmentId =assignmentDone::where('id',$id)->first()->assignment_id;
    $userInfo = User::where('id',$userId)->first();
    $assignmentInfo = assignment::where('id',$id)->first();

    $marks = 0;

    $answerQuestions =    question::select('questions.*','assignment_answers.answer as userAnswer')->leftJoin('assignment_answers','questions.id','assignment_answers.question_id')
    ->where('assignment_answers.student_id',$userId)
    ->where('questions.assignment_id',$assignmentId)->get();
    // $responseData['answerQuestions'] = $answerQuestions;
$count = $answerQuestions->count();
foreach ($answerQuestions as $obj) {
if ($obj->answer === $obj->userAnswer) {
$marks++;
}

}


    return view('pages.assignmentAnswerInfo',compact(['userInfo','assignmentInfo','marks','answerQuestions','count']));
}

}
