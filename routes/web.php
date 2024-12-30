<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ShowController;




Route::get('/register', [AuthController::class, 'show'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout1', [ShowController::class, 'logout'])->name('logout1');


Route::get('/student', [ShowController::class, 'create']);
Route::post('/student', [ShowController::class, 'login'])->name('show.login');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [StudentController::class, 'index'])->middleware('role:0')->name('dashboard');
    Route::get('students/{id}', [StudentController::class, 'show'])->name('students.show')->middleware('role:0');
    Route::get('send-email/{id}', [StudentController::class, 'sendEmail'])->middleware('role:0');
    Route::post('/in', [StudentController::class, 'store'])->name('insert')->middleware('role:0');
    
   
    Route::get('/viewers/{id}', [ShowController::class, 'store'])->middleware('role:1')->name('viewers');
    Route::get('/viewers', [ShowController::class, 'edit'])->middleware('role:1');
});

Route::get('/', [StudentController::class, 'home'])->middleware('guest');
Route::get('/api',[ShowController::class,'app']);

