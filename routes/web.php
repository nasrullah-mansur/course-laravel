<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClassNameController;
use App\Http\Controllers\ClassTopicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DClassController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\UserController;

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

Route::get('/', [FrontController::class, 'index'])->name('welcome');
Route::get('/course/{slug}', [FrontController::class, 'course'])->name('course');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin', 'active'])->name('dashboard');

Route::get('inactive/user', [UserController::class, 'inactive_user'])->name('inactive.user');

require __DIR__.'/auth.php';


// ======================= Back Route =================
Route::middleware(['auth', 'active'])->group(function() {

    // Student Profile;
    Route::get('/student/profile/edit', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
    Route::post('/student/profile/update/profile-info', [StudentProfileController::class, 'update_profile_info'])->name('student.profile_info.update');
    Route::post('/student/profile/update/password', [StudentProfileController::class, 'update_password'])->name('student.password.update');
    Route::post('/student/profile/update/image', [StudentProfileController::class, 'image_update'])->name('student.image.update');

    // Student Dashboard;
    Route::get('my-dashboard', [StudentDashboardController::class, 'dashboard'])->name('student.dashboard');

    // Student Attendance;
    Route::post('student-attendance', [AttendanceController::class, 'student_attendance'])->name('student.attendance.store');

    Route::middleware('admin')->group(function() {

        Route::prefix('admin')->group(function() {

            // Profile;
            Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
            Route::post('/profile/profile-info', [AdminProfileController::class, 'update_profile_info'])->name('admin.profile_info.update');
            Route::post('/profile/password', [AdminProfileController::class, 'update_password'])->name('profile.password.update');
            Route::post('/profile/remove', [AdminProfileController::class, 'destroy'])->name('profile.destroy');

            // Admins;
            Route::get('admin', [UserController::class, 'index'])->name('admins');
            Route::get('admin/create', [UserController::class, 'create'])->name('admins.create');
            Route::post('admin/store', [UserController::class, 'store'])->name('admins.store');
            Route::get('admin/edit/{id}', [UserController::class, 'edit'])->name('admins.edit');
            Route::post('admin/update/{id}', [UserController::class, 'update'])->name('admins.update');
            Route::post('admin/delete', [UserController::class, 'delete'])->name('admins.delete');

            // Course;
            Route::get('course', [CourseController::class, 'index'])->name('course.index');
            Route::get('course/create', [CourseController::class, 'create'])->name('course.create');
            Route::post('course/store', [CourseController::class, 'store'])->name('course.store');
            Route::get('course/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
            Route::post('course/update/{id}', [CourseController::class, 'update'])->name('course.update');
            Route::post('course/delete', [CourseController::class, 'delete'])->name('course.delete');
    
            // Class Name;
            Route::get('/class-name/{course_id}', [ClassNameController::class, 'index'])->name('admin.class.name.index');
            Route::post('/class-name/store', [ClassNameController::class, 'store'])->name('admin.class.name.store');
            Route::post('/class-name/update/all', [ClassNameController::class, 'all_update'])->name('admin.class.name.all.update');
            Route::post('/class-name/delete', [ClassNameController::class, 'delete'])->name('admin.class.name.delete');
    
            // Class Topics;
            Route::get('/class-topic/{class_id}/index', [ClassTopicController::class, 'index'])->name('admin.class.topic.index');
            Route::post('/class-topic/store', [ClassTopicController::class, 'store'])->name('admin.class.topic.store');
            Route::post('/class-topic/update/all', [ClassTopicController::class, 'all_update'])->name('admin.class.topic.update');
            Route::post('/class-topic/delete', [ClassTopicController::class, 'delete'])->name('admin.class.topic.delete');
    
            // Batch;
            Route::get('batches', [BatchController::class, 'index'])->name('batch.index');
            Route::post('batch/store', [BatchController::class, 'store'])->name('batch.store');
            Route::post('batch/update', [BatchController::class, 'update'])->name('batch.update');
            Route::post('batch/delete', [BatchController::class, 'delete'])->name('batch.delete');
    
    
            // Daily Class;
            Route::get('daily-class', [DClassController::class, 'index'])->name('d.class.index');
            Route::post('daily-class/find-classes', [DClassController::class, 'find_classes'])->name('d.class.find.classes');
            Route::get('daily-class/{slug}', [DClassController::class, 'get_classes'])->name('d.class.get.classes');
            Route::post('daily-class/store', [DClassController::class, 'store'])->name('d.class.store');
            Route::post('daily-class/update', [DClassController::class, 'update'])->name('d.class.update');

            // Daily class attendance check;
            Route::get('daily-class/attendance/{batch}/{class}/check', [DClassController::class, 'class_attendance'])->name('daily.class.attendance');
    
            // Student;
            Route::get('student/find', [StudentController::class, 'find'])->name('student.find');
            Route::post('student/find', [StudentController::class, 'find_set'])->name('student.find.set');
            Route::get('student/batch/{slug}', [StudentController::class, 'index'])->name('student.index');
            Route::post('student/store', [StudentController::class, 'store'])->name('student.store');
            Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
            Route::post('student/update/{id}', [StudentController::class, 'update'])->name('student.update');

            // Update by admin;
            Route::post('student/update/by/admin', [StudentController::class, 'update_admin'])->name('student.update.admin');
            Route::post('student/attendance/update/by/admin', [AttendanceController::class, 'student_attendance_by_admin'])->name('student.attendance.update.by.admin');
            Route::get('student/update-info/{batch_id}/{student_id}', [StudentController::class, 'show_info'])->name('student.attendance.info');


            // Total Student;
            Route::post('total-student', [DClassController::class, 'total_student'])->name('total.student');
        });
    });
  
});