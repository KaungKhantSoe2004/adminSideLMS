<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\done;
use App\Models\User;
use App\Models\view;
use App\Models\answer;
use App\Models\lesson;
use App\Models\notice;
use App\Models\school;
use App\Models\subject;
use App\Models\lmsClass;
use App\Models\question;
use App\Models\assignment;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\assignmentDone;
use App\Models\AssignmentAnswer;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    // login funciton
    public function userLogin(Request $request){
        $user = User::where('email', $request->email)->first();

        $givenPassword = $request->password;





        if (isset($user)) {
            $password = $user->password;

if(Hash::check($givenPassword, $password)){
    $user_id = $user->id;
    $school_id = $user->school_id;
    $class_id = $user->class_id;
    $school = school::where('id',$school_id)->first();
    $notice = notice::select('notices.*','users.name as userName','users.role as userRole')
    ->join('users','notices.created_by','users.id')
    ->where('notices.school_id',$school_id)->get();
    $class= lmsClass::where('id',$class_id)->first();
    $subject = subject::where('class_id',$class_id)->get();

    $schoolClasses = lmsClass::where('school_id',$school_id)->get();
    $schoolSubjects = subject::where('school_id',$school_id)->get();
    $users = User::select('users.*','lms_classes.name as className')->join('lms_classes','users.class_id','lms_classes.id')
    ->where('users.school_id',$school_id)->get();
 $assignments = assignment::select('assignments.*','assignment_dones.user_id as assignmentDoneUser')->join('assignment_dones','assignments.id','assignment_dones.assignment_id')
 ->where('assignments.class_id',$class_id)->get();
 logger($assignments);
    return response()->json([
                'status'=> true,
              'data'=> [
                'userData'=> $user,
                'schoolData'=> $school,
                'notices'=>$notice,
                'myClass'=> $class,
                'mySubjects'=> $subject,
                'allUsers'=> $users,
                'allSubjects'=>$schoolSubjects,
                'allClasses'=> $schoolClasses,
                'assignments' => $assignments
              ],
                'token'=> $user->createToken(time())->plainTextToken
            ]);

}else{
    return response()->json([
        'status' => false,
 'error'=> "Password Doesn't match"
    ]);
}


        }else{
            return response()->json([
                'status' => false,
                'error'=> "Email Doesn't exists"
              ]);
        }


    }


// profile Page reload
public function profileReload(Request $request){
 $user = User::where('email',$request->email)->first();
    if (isset($user)) {



$user_id = $user->id;
$school_id = $user->school_id;
$class_id = $user->class_id;
$school = school::where('id',$school_id)->first();
$notice = notice::select('notices.*','users.name as userName','users.role as userRole')
->join('users','notices.created_by','users.id')
->where('notices.school_id',$school_id)->get();
$class= lmsClass::where('id',$class_id)->first();
$subject = subject::where('class_id',$class_id)->get();

$schoolClasses = lmsClass::where('school_id',$school_id)->get();
$schoolSubjects = subject::where('school_id',$school_id)->get();
$users =  User::select('users.*','lms_classes.name as className')->join('lms_classes','users.class_id','lms_classes.id')
->where('users.school_id',$school_id)->get();
// $assignments = assignment::select('assignments.*','assignment_dones.user_id as assignmentDoneUser')->join('assignment_dones','assignments.id','assignment_dones.assignment_id')
$assignments = assignment::where('assignments.class_id',$class_id)->get();
return response()->json([
            'status'=> true,
          'data'=> [
            'userData'=> $user,
            'schoolData'=> $school,
            'notices'=>$notice,
            'myClass'=> $class,
            'mySubjects'=> $subject,
            'allUsers'=> $users,
            'allSubjects'=>$schoolSubjects,
            'allClasses'=> $schoolClasses,
            'assignments' => $assignments
          ]
        ]);




    }else{
        return response()->json([
            'status' => false,
            'error'=> "Email Doesn't exists"
          ]);
    }








}



// reloadEditPassword
public function reloadEditPassword(Request $request){
    $id = $request->id;
    $user = User::where('id',$id)->first();
    logger($user->password);
    return response()->json([
        'status'=>true,
        'data'=> [
            'user'=> $user
        // 'password' => $user->password
        ]
    ]);
}

// updatePassword
public function updatePassword(Request $request){
$oldPassword = $request->oldPassword;
$newPassword = $request->newPassword;
$id = $request->id;
$userInfo = User::where('id',$id)->first();
$password = $userInfo->password;
if(Hash::check($oldPassword,$password)){
$hashedValue = Hash::make($newPassword);
User::where('id',$id)->update([
    'password'=> $hashedValue
]);
return response()->json([
    'status' => true
]);
}else{
return response()->json(
    [
        'status'=>false,
        'message'=> 'oldPassword incorrect'
    ]
);
}
}

// classesReload
public function classesReload(Request $request){
    $id = $request->class_id;
    $school_id = $request->school_id;
    $subjects = subject::where('class_id',$id)->get();
    $school = school::where('id',$school_id)->first();
    // $assignments = assignment::select('assignments.*','assignment_dones.user_id as assignmentDoneUser')->join('assignment_dones','assignments.id','assignment_dones.assignment_id')
    $assignments = assignment::where('class_id',$id)->get();
    $class= lmsClass::where('id',$id)->first();
    return response()->json([
        'status'=> true,
        "data"=> [
            'schoolData'=> $school,
            'class' =>$class,
'subjects'=> $subjects,
'assignments'=> $assignments
        ]
    ]);
}

// schoolReload
public function schoolReload(Request $request){

    $school_id = $request->school_id;
    $subjects = subject::where('school_id',$school_id)->get();
    $classes = lmsClass::where('school_id',$school_id)->get();
    $admins = User::where('school_id',$school_id)->where('role','schoolAdmin')->get();
    $teachers = User::select('users.*', 'lms_classes.name as className')->join('lms_classes','users.class_id','lms_classes.id')
    ->where('users.school_id',$school_id)->where('users.role','teacher')->get();
    $students = User::select('users.*', 'lms_classes.name as className')->join('lms_classes','users.class_id','lms_classes.id')
    ->where('users.school_id',$school_id)->where('users.role','student')->get();
    $school = school::where('id',$school_id)->first();

    return response()->json([
        'status'=> true,
        "data"=> [
            'schoolData'=> $school,
            'classes' =>$classes,
'subjects'=> $subjects,
'admins'=> $admins,
'teachers'=>$teachers,
'students'=> $students
        ]
    ]);
}

// subjectDetails
 public function subjectDetails(Request $request){
    $subjectId = $request->id;
    $userId = $request->userId;
    // $dones = done::where('user_id',$userId)->get();
    $subjectInfo = subject::where('id',$subjectId)->get();
    $lessons = lesson::where('lessons.subject_id',$subjectId)->get();
   return response()->json([
    'status'=> true,
    'data'=> [
// 'dones'=> $dones,
        'subjectInfo'=> $subjectInfo,
        'lessons'=> $lessons
    ]
   ]);
 }


//  lessonDetails
 public function lessonDetails(Request $request){
    // logger($request->all());
    $lessonId = $request->id;
    $schoolId = $request->schoolId;
    $school = school::where('id',$schoolId)->first();
    $userId = $request->userId;
    $done = done::where('lesson_id',$lessonId)->where('user_id',$userId)->first();
    // $userId = done::where('lesson_id',$lessonId)->first()->user_id;

    // logger($userId);
    $views = view::where('lesson_id',$lessonId)->where('student_id',$userId)->get();
    $lessonInfo = lesson::select('lessons.*','users.name as creator', 'users.role as creatorRole')->join('users','lessons.created_by','users.id')
    ->where('lessons.id',$lessonId)->first();
return response()->json([
'status' => true,
'data'=>[
    'views'=> $views,
'lessonInfo'=> $lessonInfo,
'schoolInfo'=> $school,
'done'=> $done]
]);
 }

// answerDetails
public function answerDetails(Request $request){
    $answerId = $request->id;
    $answerInfo = answer::where('id',$answerId)->get();
    return response()->json([
    'status' => true,
    'data'=> [
    'answerDetails' =>$answerInfo
    ]
        ]);
}



// assignmentDetails
public function assignmentDetails(Request $request){
    $assignmentId = $request->id;
$schoolId = $request->schoolId;
$userId = $request->userId;
$marks = 0;
logger($userId);
$school = school::where('id',$schoolId)->first();
$done = assignmentDone::where('assignment_id',$assignmentId)->where('user_id',$userId)->first();

    $assignmentInfo = assignment::select('assignments.*','users.name as creator','users.role as creatorRole')->join('users','assignments.created_by','users.id')
    ->where('assignments.id',$assignmentId)->get();
    $questions = question::where('questions.assignment_id',$assignmentId)->get();
    $responseData = [
        'assignmentInfo'=> $assignmentInfo,
        'schoolInfo' =>$school,
        'done' =>$done,
        'questions' => $questions
    ];
        if (isset($done)) {
            $answerQuestions =    question::select('questions.*','assignment_answers.answer as userAnswer')->leftJoin('assignment_answers','questions.id','assignment_answers.question_id')
            ->where('assignment_answers.student_id',$userId)
            ->where('questions.assignment_id',$assignmentId)->get();
            $responseData['answerQuestions'] = $answerQuestions;

   foreach ($answerQuestions as $obj) {
  if ($obj->answer === $obj->userAnswer) {
$marks++;
  }
  $responseData['marks'] = $marks;
   }

            }
    return response()->json([
    'status'=> true,
    'data'=> $responseData
    ]);
}


// addAssignment
public function addAssignment(Request $request){
    $id = $request->userId;
    $assignmentId = $request->assignmentId;
    $data = $request->data;
    // logger($data);
    foreach ($data as $each) {
        $eachData = [
            'student_id'=> $id,
            'question_id'=> $each['name'],
            'answer'=> $each['value'],
            'status'=>true
        ];


        AssignmentAnswer::create($eachData);

    }
  assignmentDone::create([
            'user_id'=> $id,
            'assignment_id'=> $assignmentId,
        ]);
}

// assignmentAnswerDetails
public function assignmentAnswerDetails(Request $request){
$assignmentAnswerId = $request->id;
$assignmentAnswerInfo = assignmentAnswer::where('id',$assignmentAnswerId)->get();
return response()->json([
'status'=> true,
'assignmentAnswerInfo'=> $assignmentAnswerInfo
]);
}



// addDone
public function addDone(Request $request){
    $id = $request->id;
    $user_id = $request->userId;
    done::create([
        'lesson_id'=> $id,
        'user_id'=> $user_id
    ]);
}

// deleteDone
public function deleteDone(Request $request){
    $id = $request->id;
    done::where('id',$id)->delete();
}


//
// deleteDone with lesson_id
public function deleteDoneLessonId(Request $request){
    $id = $request->id;
    done::where('lesson_id',$id)->delete();
}


// chatReload
public function chatReload(Request $request){
    $schoolId = $request->schoolId;
    $userId = $request->userId;
$users = User::select('users.*','lms_classes.name as className')->join('lms_classes','users.class_id','lms_classes.id')
->where('users.school_id',$schoolId)->get();
$schoolInfo = school::where('id',$schoolId)->first();

return response()->json([
    'status'=>true,
    'data'=> [
        'users'=> $users,
        'schoolInfo'=> $schoolInfo
    ]
]);
}


// chatting
public function chatting(Request $request){
    $senderId = $request->senderId;
$receiverId = $request->receiverId;
$send= Chat::where('sender_id',$senderId)->where('receiver_id',$receiverId)->get();
$return = Chat::where('sender_id',$receiverId)->where('receiver_id',$senderId)->get();
$chats = array_merge($send->toArray(),$return->toArray());

logger($chats);
// logger($send,$chats);
$sender = User::where('id',$senderId)->first();
$receiver = User::where('id',$receiverId)->first();
return response()->json(
    [
        'status' => true,
        'data'=> [
            'chats' => $chats,
            'sender'=> $sender,
            'receiver'=> $receiver
        ]
        ]
        );

}
// reloadEditProfile
public function reloadEditProfile(Request $request){
    $id = $request->id;
    $user = User::where('id',$id)->first();
    return response()->json([
        'status' => true,
        'data'=> [
            'user' => $user
        ]
    ]);
}


// postMessage
public function postMessage(Request $request){
    $senderId = $request->senderId;
    $receiverId = $request->receiverId;
    $schoolId = $request->schoolId;
    $text = $request->text;
    $type = 'private';
    logger($request->all());
$data = [
    'sender_id'=>$senderId,
    'receiver_id'=> $receiverId,
    'school_id'=>$schoolId,
    'text'=>$text,
    'type'=>$type
];
Chat::create($data);
}

// updateProfile
public function updateProfile(Request $request){
    $name = $request->name;
    $email = $request->email;
    $phone = $request->phone;
    $address = $request->address;
    $gender = $request->gender;
    $id = $request->id;
// logger($request->all());
$userData = User::where('id',$id)->first();
$data = [
    'name'=> $name,
    'email'=> $email,
    'phone'=> $phone,
    'address'=> $address,
    'gender'=> $gender,
];
if($request->file('img')){
    if($userData->img !== null){
if(File::exists(public_path()."/profileImg/".$userData->img)){
File::delete(public_path()."/profileImg./".$userData->img);
}
}
$path = uniqid().'profile'.$request->file('img')->getCLientOriginalName();
$request->file('img')->move(public_path()."/profileImg",$path);
$data['img']= $path;
  }
    User::where('id',$id)->update($data);
    $user = User::where('id',$id)->first();
    return response()->json([
        'status' => true,
        'data'=> $user
    ]);
}


// addView
public function addView(Request $request){
    $studentId = $request->studentId;
    $lessonId = $request->lessonId;
    $data = [
        'student_id'=> $studentId,
        'lesson_id'=> $lessonId
    ];
    view::create($data);

}

}
