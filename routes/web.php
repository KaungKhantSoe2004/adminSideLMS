<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LmsClassController;
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


// CLASSES RELATED ROUTES
Route::get('/classes/{id?}', [LmsClassController::class, 'classesDirectPage'])->name('admin#classesDirectPage');
Route::post('createClass', [LmsClassController::class, 'createClass'])->name('admin#createClass');
Route::post('updateClass', [LmsClassController::class, 'updateClass'])->name('admin#updateClass');
Route::get('classDelete/{id}', [LmsClassController::class, 'deleteClass'])->name('classDelete');


// SUBJECTS RELATED ROUTES
Route::get('/subjects/{id?}', [SubjectController::class, 'directSubject'])->name('admin#directSubject');
Route::post('/createSubject', [SubjectController::class, 'createSubject'])->name('admin#createSubject');
Route::get('/deleteSubject/{id?}', [SubjectController::class, 'deleteSubject'])->name("admin#deleteSubject");
Route::post('updateSubject', [SubjectController::class, 'updateSubject'])->name('admin#updateSubject');





// DOCUMENTATION ROUTE
Route::get('/documentation',[DocumentationController::class, 'directDocumentation'])->name('teacher#directDocumentaion');

});
