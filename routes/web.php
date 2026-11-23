<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StudentProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Student profile
    Route::get('/student-profile', [StudentProfileController::class, 'edit'])
        ->name('student-profile.edit');

    Route::put('/student-profile', [StudentProfileController::class, 'update'])
        ->name('student-profile.update');

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])
        ->name('courses.index');

    Route::get('/my-courses', [CourseController::class, 'myCourses'])
        ->name('courses.mine');

    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])
        ->name('courses.enroll');

    Route::delete('/courses/{course}/unenroll', [CourseController::class, 'unenroll'])
        ->name('courses.unenroll');

    // Discussions
    Route::get('/discussions', [PostController::class, 'index'])
        ->name('posts.index');

    Route::post('/discussions', [PostController::class, 'store'])
        ->name('posts.store');

    Route::get('/discussions/{post}', [PostController::class, 'show'])
        ->name('posts.show');

    Route::delete('/discussions/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');

    // Comments
    Route::post('/discussions/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::delete('/discussions/{post}/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

require __DIR__.'/auth.php';