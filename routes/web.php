<?php

use App\Http\Controllers\ClassNameController;
use App\Http\Controllers\ClassTopicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;

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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ======================= Back Route =================
Route::middleware('auth')->group(function() {
    Route::prefix('admin')->group(function() {
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
    });
});