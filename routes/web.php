<?php

use Illuminate\Support\Facades\Route;
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





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

Route::get('/', function () {
    return view('pages.home');
})->name('teacher#home');

Route::get('/subjects'. [SubjectController::class, 'directSubject'])->name('teacher#directSubject');
Route::get('/documentation',[DocumentationController::class, 'directDocumentation'])->name('teacher#directDocumentaion');
});
