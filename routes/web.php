<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Main page Login route
Route::get('/', function () {
    return redirect('/admin/dashboard');
})->middleware('auth');

Auth::routes();

//students dashboard
Route::get('/student/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('student.index')->middleware('student');

//tutor dashboard
Route::get('/tutor/dashboard', [App\Http\Controllers\HomeController::class, 'tutor'])->name('tutor.index')->middleware('tutor');

//profile
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::post('profile/update', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('user.update');



//admin area only for admin
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.index')->middleware('admin');
Route::get('/admin/users', [App\Http\Controllers\HomeController::class, 'users'])->name('admin.users')->middleware('admin');
Route::get('/admin/users/{slug}', [App\Http\Controllers\HomeController::class, 'edit'])->name('users.edit')->middleware('admin');
Route::post('/admin/users/store', [App\Http\Controllers\HomeController::class, 'store'])->name('users.store')->middleware('admin');
Route::delete('/admin/users/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('users.delete')->middleware('admin');
Route::put('/admin/users/{slug}', [App\Http\Controllers\HomeController::class, 'update'])->name('users.update')->middleware('admin');

//courses CRUD
Route::get('/courses/create', [App\Http\Controllers\CoursesController::class, 'create'])->name('courses.create')->middleware('auth');
Route::get('/courses', [App\Http\Controllers\CoursesController::class, 'index'])->name('courses.index')->middleware(['auth']);
Route::post('/courses/store', [App\Http\Controllers\CoursesController::class, 'store'])->name('courses.store')->middleware('auth');
Route::get('/courses/{course}', [App\Http\Controllers\CoursesController::class, 'edit'])->name('courses.edit')->middleware('auth');
Route::put('/courses/{course}', [App\Http\Controllers\CoursesController::class, 'update'])->name('courses.update')->middleware('auth');
Route::get('/courses/show/{slug} ', [App\Http\Controllers\CoursesController::class, 'show'])->name('courses.show');
Route::delete('/courses/delete/{id}', [App\Http\Controllers\CoursesController::class, 'delete'])->name('courses.delete')->middleware('auth');





//modules CRUD
Route::post('/courses/module/store', [App\Http\Controllers\ModuleController::class, 'store'])->name('modules.store');
Route::delete('/courses/modules/delete/{slug}', [App\Http\Controllers\ModuleController::class, 'delete'])->name('modules.delete');
Route::get('/courses/module/{slug}', [App\Http\Controllers\ModuleController::class, 'edit'])->name('modules.edit');
Route::put('/courses/module/{slug}', [App\Http\Controllers\ModuleController::class, 'update'])->name('modules.update');

//announcement CRUD
Route::get('/announcements/create', [App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create')->middleware('auth');
Route::get('/announcements', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements.index')->middleware(['auth']);
Route::post('/announcements/store', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcements.store')->middleware('auth');
Route::get('/announcements/{announcement}', [App\Http\Controllers\AnnouncementController::class, 'edit'])->name('announcements.edit')->middleware('auth');
Route::put('/announcements/{slug}', [App\Http\Controllers\AnnouncementController::class, 'update'])->name('announcements.update')->middleware('auth');
Route::get('/announcements/show/{slug} ', [App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');
Route::delete('/announcements/delete/{slug}', [App\Http\Controllers\AnnouncementController::class, 'delete'])->name('announcements.delete')->middleware('auth');


//assignment CRUD
Route::get('/assignments/create', [App\Http\Controllers\AssignmentController::class, 'create'])->name('assignments.create')->middleware('auth');
Route::get('/assignments', [App\Http\Controllers\AssignmentController::class, 'index'])->name('assignments.index')->middleware(['auth']);
Route::post('/assignments/store', [App\Http\Controllers\AssignmentController::class, 'store'])->name('assignments.store')->middleware('auth');
Route::get('/assignments/{id}', [App\Http\Controllers\AssignmentController::class, 'edit'])->name('assignments.edit')->middleware('auth');
Route::put('/assignments/{slug}', [App\Http\Controllers\AssignmentController::class, 'update'])->name('assignments.update')->middleware('auth');
Route::get('/assignments/show/{slug} ', [App\Http\Controllers\AssignmentController::class, 'show'])->name('assignments.show');
Route::delete('/assignments/delete/{slug}', [App\Http\Controllers\AssignmentController::class, 'delete'])->name('assignments.delete')->middleware('auth');


//assignment submit for students
Route::get('/assignments/student', [App\Http\Controllers\AssignemtSubmit::class, 'index'])->name('assignmentsstudent.index')->middleware('student');
Route::post('/assignments/student/store', [App\Http\Controllers\AssignemtSubmit::class, 'store'])->name('assignmentsstudent.store')->middleware('student');


//grading system for tutor and admin
Route::get('/grades/create', [App\Http\Controllers\GradeController::class, 'create'])->name('grades.create')->middleware('auth');
Route::get('/grades', [App\Http\Controllers\GradeController::class, 'index'])->name('grades.index')->middleware(['auth']);
Route::post('/grades/store', [App\Http\Controllers\GradeController::class, 'store'])->name('grades.store')->middleware('auth');
Route::get('/grades/{id}', [App\Http\Controllers\GradeController::class, 'edit'])->name('grades.edit')->middleware('auth');
Route::put('/grades/{slug}', [App\Http\Controllers\GradeController::class, 'update'])->name('grades.update')->middleware('auth');
Route::get('/grades/show/{slug} ', [App\Http\Controllers\GradeController::class, 'show'])->name('grades.show');
Route::delete('/grades/delete/{slug}', [App\Http\Controllers\GradeController::class, 'delete'])->name('grades.delete')->middleware('auth');


//student grade report for student
Route::get('/students/grades', [App\Http\Controllers\HomeController::class, 'studentGrade'])->name('students.grade')->middleware(['student']);

//enroll for student
Route::post('/enroll', [App\Http\Controllers\CourseEnrollController::class, 'store'])->name('courses.enroll')->middleware(['student']);

//attendance
Route::get('/attendances/create', [App\Http\Controllers\AttendanceController::class, 'create'])->name('attendances.create')->middleware('auth');
Route::get('/attendances', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendances.index')->middleware(['auth']);
Route::post('/attendances/store', [App\Http\Controllers\AttendanceController::class, 'store'])->name('attendances.store')->middleware('auth');
Route::get('/attendances/{id}', [App\Http\Controllers\AttendanceController::class, 'edit'])->name('attendances.edit')->middleware('auth');
Route::put('/attendances/{slug}', [App\Http\Controllers\AttendanceController::class, 'update'])->name('attendances.update')->middleware('auth');
Route::get('/attendances/show/{slug} ', [App\Http\Controllers\AttendanceController::class, 'show'])->name('attendances.show');
Route::delete('/attendances/delete/{slug}', [App\Http\Controllers\AttendanceController::class, 'delete'])->name('attendances.delete')->middleware('auth');

 