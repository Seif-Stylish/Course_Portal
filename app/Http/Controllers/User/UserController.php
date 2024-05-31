<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view("users.home");
    }

    public function viewCourses()
    {
        $courses = DB::select("select * from courses order by id");
        return view("users.courses" , compact("courses"));
    }

    public function achievements()
    {
        $achievements = DB::select("select u.id as user_id , u.name as user_name , c.id as course_id , c.name as course_name , count(*) as no_of_lessons_viewed
        from users u , courses c , lessons l , user_lessons ul
        where u.id = ul.user_id and ul.lesson_id = l.id and l.course_id = c.id and u.id = ".Auth::user()->id ." group by u.id , u.name , c.id , c.name");

        $courses = DB::select("select uc.user_id , c.id as course_id , c.name as course_name from courses c , user_courses uc
        where c.id = uc.course_id and uc.user_id = ".Auth::user()->id);

        //dd($achievements);

        $lessons = [];

        for($i = 0; $i < count($courses); $i++)
        {
            $lessons = DB::select("select l.name from lessons l , courses c , user_lessons ul
            where ul.lesson_id = l.id and c.id = l.course_id and ul.user_id = ".Auth::user()->id. " and c.id = ".$courses[$i]->course_id);

            $courses[$i]->lessons = $lessons;
            //$courses[$i]->lessons_viewed = DB::select("select * from ")
        }

        return view("users.achievements" , compact("achievements" , "courses"));
    }

    public function courseDetails($id/* , AdminController $admin*/)
    {
        //$admin->courseDetails($id);

        $course = DB::select("select * from courses where id = $id");
        if(empty($course))
        {
            return redirect()->route("admin.courses");
        }
        $course = $course[0];
        $lessons = DB::select("select * from lessons where course_id = $id");

        return view("users.courseDetails" , compact("course" , "lessons"));
    }

    public function enrolledCourses()
    {
        $enrolledCourses = DB::select("select c.* from courses c , users u , user_courses uc
            where u.id = uc.user_id and c.id = uc.course_id and u.id = ".Auth::user()->id);

        return view("users.enrolledCourses" , compact("enrolledCourses"));
    }

    public function enrollPost($course_id)
    {
        $course_id = (int)$course_id;
        if($course_id <= 0)
        {
            return redirect()->route("user.courses")->with("error" , "something Went Wrong");
        }

        $course = DB::select("select * from courses where id = $course_id");

        if(empty($course))
        {
            return redirect()->route("user.courses")->with("error" , "something Went Wrong");
        }

        $course = $course[0];

        $user_id = Auth::user()->id;

        $isEnrolledPreviously = DB::select("select * from user_courses where user_id = ".Auth::user()->id . " and course_id = ".$course_id);

        if(!empty($isEnrolledPreviously))
        {
            return redirect()->route("user.courses")->with("error" , "something Went Wrong");
        }

        $isCreated = DB::insert("
            insert into user_courses(user_id , course_id)
            value($user_id , $course_id)
        ");

        if($isCreated)
        {
            return redirect()->route("user.courses")->with("success" , "Course Enrolled Successfully");
        }
        else
        {
            return redirect()->route("user.courses")->with("error" , "something Went Wrong");
        }
    }

    public function viewLessonPost($id)
    {
        $user_id = Auth::user()->id;
        $isCreated = DB::insert("insert into user_lessons(user_id , lesson_id)
            values($user_id , $id)");

        if($isCreated)
        {
            return redirect()->route("user.courses")->with("success" , "Lesson Viewd");
        }
        else
        {
            return redirect()->route("user.courses")->with("error" , "something Went Wrong");
        }
    }
}
