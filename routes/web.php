<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\LmsClassController;
use App\Http\Controllers\AssignmentController;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Controllers\DocumentationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// [
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ]



Route::get('emailTesting', function(){
    return view('emails.welcome');
});
// Email Post to owner
Route::post('mailPost', [MailController::class, 'mailPost'])->name('mailPost');

Route::middleware('urlMiddleware')->group(function(){
    Route::post('mailSent', [UserController::class, 'mailSent'])->name('mailSent');
    Route::post('otpVerify', [UserController::class, 'otpVerify'])->name('otpVerify');
    Route::get('otpPage', [UserController::class, 'otpDirectPage'])->name('otpDirectPage');
    Route::get('/', [UserController::class, 'directDashboard'])->name('dashboard');

    Route::get('registerPage', [UserController::class, 'registerPage'])->name('registerPage');
});



// payment routes
Route::get('payment',[UserController::class, 'paymentDirectPage'])->name('paymentDirectPage');
Route::post('buySchool', [UserController::class, 'buySchool'])->name('buySchool');
Route::post('checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::get('success/{schoolName?}/{schoolEmail?}/{schoolAddress?}/{schoolType?}/{password?}', [StripeController::class, 'success'])->name('success');

Route::middleware('auth')->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');


    // *USER RELATED ROUTES

    // home
    Route::get('/dashboard', function(){
       return redirect()->route('teacher#home');
    });
Route::get('/home', function () {
    return view('pages.home');
})->name('teacher#home');
// edit profile page
Route::get("/directEditProfilePage", [UserController::class, 'directEditUserPage'])->name("teacher#directEditProfile");
// update profile
Route::post('updateProfile', [UserController::class, 'updateProfile'])->name('teacher#updateProfile');
// change Password page
Route::get('changePasswordPage', [UserController::class, 'directChangePasswordPage'])->name("teacher#changePasswordPage");
// udpate Password
Route::post('changePassword', [UserController::class, 'changePassword'])->name("teacher#changePassword");




// logout
Route::post('directLogOut', [UserController::class, 'logout'])->name('admin#logout');

// SCHOOL RELATED ROUTES
Route::get('/school', [SchoolController::class, 'directSchoolPage'])->name('admin#directSchoolPage');
Route::get('/schoolBuy', [SchoolController::class, 'directSchoolBuyPage'])->name('admin#directSchoolBuyPage');
Route::post('/schoolSignOut', [SchoolController::class, 'schoolSignOut'])->name('admin#schoolSignOut');
Route::get('/schoolSignInPage', [SchoolController::class, 'schoolSignInPage'])->name('admin#schoolSignInPage');
Route::post('schoolSignIn', [SchoolController::class, 'schoolSignIn'])->name('admin#schoolSignIn');
Route::post('/schoolEditPage', [SchoolController::class, 'directSchoolEditPage'])->name('admin#directSchoolEditPage');
Route::post('schoolupdate', [SchoolController::class, 'schoolUpdate'])->name('admin#updateSchool');
Route::get('schoolChangePassword',[SchoolController::class, 'schoolChangePasswordPage'])->name('admin#changePasswordPage');
Route::post('schoolUpdatePassword', [SchoolController::class, 'schoolUpdatePassword'])->name('admin#changeSchoolPassword');
Route::get('addStudentPage', [SchoolController::class, 'addStudentPage'])->name('admin#addStudentPage');
Route::get('addTeacherPage', [SchoolController::class, 'addTeacherPage'])->name('admin#addTeacherPage');
Route::post('addTeacher', [SchoolController::class, 'addTeacher'])->name("admin#addTeacher");
Route::post('addStudent', [SchoolController::class, 'addStudent'])->name("admin#addStudent");
Route::get('editTeacherPage/{id}', [SchoolController::class, 'editTeacherPage'])->name('admin#editTeacherPage');
Route::post('editTeacher', [SchoolController::class, 'editTeacher'])->name('admin#editTeacher');
Route::get('deleteUser/{id}', [SchoolController::class, 'deleteUser'])->name('admin#deleteUser');
Route::get('editStudentPage/{id},', [SchoolController::class, 'editStudentPage'])->name('admin#editStudentPage');
Route::post('editStudent', [SchoolController::class, 'editStudent'])->name('admin#editStudent');
// CLASSES RELATED ROUTES
Route::get('/classes/{id?}/{key?}', [LmsClassController::class, 'classesDirectPage'])->name('admin#classesDirectPage');
Route::post('createClass', [LmsClassController::class, 'createClass'])->name('admin#createClass');
Route::post('updateClass', [LmsClassController::class, 'updateClass'])->name('admin#updateClass');
Route::get('classDelete/{id}', [LmsClassController::class, 'deleteClass'])->name('classDelete');


// SUBJECTS RELATED ROUTES
Route::get('/subjects/{id?}/{key?}', [SubjectController::class, 'directSubject'])->name('admin#directSubject');
Route::post('/createSubject', [SubjectController::class, 'createSubject'])->name('admin#createSubject');
Route::get('/deleteSubject/{id?}', [SubjectController::class, 'deleteSubject'])->name("admin#deleteSubject");
Route::post('updateSubject', [SubjectController::class, 'updateSubject'])->name('admin#updateSubject');


// LESSONS RELATED ROTES
Route::get('/lessons/{id?}/{key?}', [LessonController::class, 'directLesson'])->name("admin#lessonDirect");
Route::post('lessonCreate', [LessonController::class, 'lessonCreate'])->name("admin#lessonCreate");
Route::get('deleteLesson/{id}', [LessonController::class, 'deleteLesson'])->name("admin#deleteLesson");
Route::post('updateLesson', [LessonController::class, 'updateLesson'])->name("admin#updateLesson");
Route::get('lessonInfoDirect/{id}', [LessonController::class, 'lessonInfoDirect'])->name('admin#lessonInfoDirect');

// Assignments RELATED ROUTES
Route::get('assignments/{key?}', [AssignmentController::class, 'directAssignment'])->name('admin#directAssignment');
Route::get('addAssignmentPage', [AssignmentController::class, 'addAssignmentPage'])->name('admin#addAssignmentPage');
Route::post('addAssignment', [AssignmentController::class, 'addAssignment'])->name('admin#addAssignment');
Route::get('assignmentDelete/{id}', [AssignmentController::class, 'deleteAssignment'])->name('admin#deleteAssignment');
Route::get('assignmentInfo/{id}', [AssignmentController::class,'assignmentInfo'])->name('admin#assignmentInfo');
Route::get('editAssignment/{id}', [AssignmentController::class, 'editAssignment'])->name('admin#editAssignment');
Route::post('updateAssignment', [AssignmentController::class, 'updateAssignment'])->name('admin#updateAssignment');
Route::post('updateQuestion', [AssignmentController::class, 'updateQuestion'])->name('admin#updateQuestion');
Route::get('assignmentAnswerInfo/{id}', [AssignmentController::class, 'assignmentAnswerInfo'])->name('admin#assignmentAnswerInfo');



// DOCUMENTATION ROUTE
Route::get('/documentation',[DocumentationController::class, 'directDocumentation'])->name('teacher#directDocumentaion');


// Chat Related Routes
Route::get('chatRoom', [ChatRoomController::class, 'directChatRoom'])->name('admin#directChatRoom');
Route::post('postMessage', [ChatRoomController::class, 'postMessage'])->name('admin#postMessage');
Route::get('deleteMessage/{id}', [ChatRoomController::class , 'deleteMessage'])->name('admin#deleteMessage');

// Notices Related Routes
Route::get('/addNoticePage', [NoticeController::class, 'addNoticePage'])->name('admin#addNoticePage');
Route::post('addNotice', [NoticeController::class,'addNotice'])->name('admin#addNotice');
Route::get('editNotice/{id}', [NoticeController::class, 'editNotice'])->name("admin#editNotice");
Route::post('updateNotice', [NoticeController::class, 'updateNotice'])->name('admin#updateNotice');
Route::get('deleteNotice/{id}', [NoticeController::class , 'deleteNotice'])->name('admin#deleteNotice');





});

