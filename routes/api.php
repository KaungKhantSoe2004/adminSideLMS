<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('lms/userLogin', [ApiController::class, 'userLogin'])->name('lms#userLogin');
Route::post('lms/profileReload',[ApiController::class, 'profileReload'])->name('lms#profileReload')->middleware('auth:sanctum');
Route::post('lms/classesReload',[ApiController::class, 'classesReload'])->name('lms#classesReload')->middleware('auth:sanctum');
Route::post('lms/schoolReload',[ApiController::class, 'schoolReload'])->name('lms#schoolReload')->middleware('auth:sanctum');
Route::post('lms/addDone', [ApiController::class, 'addDone'])->name('lms#addDone')->middleware('auth:sanctum');
Route::post('lms/deleteDone', [ApiController::class, 'deleteDone'])->name('lms#deleteDone')->middleware('auth:sanctum');
Route::post('lms/deleteDoneLessonId', [ApiController::class, 'deleteDoneLessonId'])->name('lms#deleteDoneLessonId')->middleware('auth:sanctum');
Route::post('lms/subjectDetails',[ApiController::class, 'subjectDetails'])->name('lms#subjectDetails')->middleware('auth:sanctum');
Route::post('lms/lessonDetails', [ApiController::class, 'lessonDetails'])->name('lms#lessonDetails')->middleware('auth:sanctum');
Route::post('lms/answerDetails',[ApiController::class, 'answerDetails'])->name('lms#answerDetails')->middleware('auth:sanctum');
Route::post('lms/assignmentDetails',[ApiController::class, 'assignmentDetails'])->name('lms#assignmentDetails')->middleware('auth:sanctum');
Route::post('lms/addAssignment',[ApiController::class, 'addAssignment'])->name('lms#addAssignment')->middleware('auth:sanctum');
Route::post('lms/chatReload',[ApiController::class, 'chatReload'])->name('lms#chatReload')->middleware('auth:sanctum');
Route::post('lms/chatting', [ApiController::class, 'chatting'])->name('lms#chatting')->middleware('auth:sanctum');
Route::post('lms/postMessage', [ApiController::class, 'postMessage'])->name('lms#postMessage')->middleware('auth:sanctum');
Route::post('lms/reloadEditProfile',[ApiController::class, 'reloadEditProfile'])->name('lms#reloadEditProfile')->middleware('auth:sanctum');
Route::post('lms/updateProfile', [ApiController::class, 'updateProfile'])->name('lms#updateProfile')->middleware('auth:sanctum');
Route::post('lms/addView',[ApiController::class, 'addView'])->name('lms#addView')->name('lms#addView')->middleware('auth:sanctum');
Route::post('lms/reloadEditPassword', [ApiController::class, 'reloadEditPassword'])->name('lms#reloadEditPassword')->middleware('auth:sanctum');
Route::post('lms/updatePassword', [ApiController::class, 'updatePassword'])->name('lms#updatePassword')->middleware('auth:sanctum');
// Route::post('lms/assignmentAnswerDetails', [ApiController::class, 'assignmentAnswerDetails'])->name('lms#assignmentAnswerDetails')->middleware('auth:sanctum');


Route::post('lms/addAnswer' , [ApiController::class, 'addAnswer'])->name('lms#addAnswer')->middleware('auth:sanctum');
Route::post('lms/addAssignment', [ApiController::class, 'addAssignment'])->name('lms#addAssignment')->middleware('auth:sanctum');
Route::post('lms/addView', [ApiController::class, 'addView'])->name('lms#addView')->middleware('auth:sanctum');
