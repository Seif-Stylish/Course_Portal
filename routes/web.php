<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(["prefix" => "user" , "as" => "user." , "middleware" => ["auth" , "isUser"]] , function()
{
    Route::get("/index" , [UserController::class , "index"])->name("index");
    Route::get("/courses" , [UserController::class , "viewCourses"])->name("courses");
    Route::get("/enrolledCourses" , [UserController::class , "enrolledCourses"])->name("enrolledCourses");
    Route::get("/achievements" , [UserController::class , "achievements"])->name("achievements");
    Route::get("/courseDetails/{id}" , [UserController::class , "courseDetails"])->name("courseDetails");
    Route::post("/enrollPost/{course_id}" , [UserController::class , "enrollPost"])->name("enrollPost");
    Route::post("/viewLessonPost/{id}" , [UserController::class , "viewLessonPost"])->name("viewLessonPost");
});

Route::group(["prefix" => "admin" , "as" => "admin." , "middleware" => ["auth" , "isAdmin"]] , function()
{
    Route::get("/index" , [AdminController::class , "index"])->name("index");
    Route::get("/createCourse" , [AdminController::class , "createCourse"])->name("createCourse");
    Route::get("/courses" , [AdminController::class , "courses"])->name("courses");
    Route::get("/courseDetails/{id}" , [AdminController::class , "courseDetails"])->name("courseDetails");
    Route::get("/createLesson/{id}" , [AdminController::class , "createLesson"])->name("createLesson");
    Route::post("/createCoursePost" , [AdminController::class , "createCoursePost"])->name("createCoursePost");
    Route::post("/createLessonPost/{course_id}" , [AdminController::class , "createLessonPost"])->name("createLessonPost");
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
