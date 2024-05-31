<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\CreateLessonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view ("admin.admin");
    }

    public function courses()
    {
        $courses = DB::select("select * from courses order by id");

        return view("admin.courses" , compact("courses"));
    }

    public function courseDetails($id)
    {
        $course = DB::select("select * from courses where id = $id");
        if(empty($course))
        {
            return redirect()->route("admin.courses");
        }
        $course = $course[0];
        $lessons = DB::select("select * from lessons where course_id = $id");

        return view("admin.courseDetails" , compact("course" , "lessons"));
    }

    public function createCourse()
    {
        return view("admin.createCourse");
    }

    public function createCoursePost(CreateCourseRequest $request)
    {
        $data = $request->except("_token");
        $isCreated = DB::table("courses")->insert($data);

        if($isCreated)
        {
            return redirect()->route("admin.courses")->with("success" , "course created successfully");
        }
        else
        {
            return redirect()->route("admin.courses")->with("error" , "Something went wrong");
        }
    }

    public function createLesson($id)
    {
        $id = (int)$id;
        if($id <= 0)
        {
            return redirect()->route("admin.courses");
        }
        $course = DB::select("select * from courses where id = $id");
        if(empty($course))
        {
            return redirect()->route("admin.courses");
        }
        else
        {
            $course = $course[0];
        }
        return view("admin.createLesson" , compact("course"));
    }

    public function createLessonPost($course_id , CreateLessonRequest $request)
    {
        $course_id = (int)$course_id;

        if($course_id <= 0)
        {
            return redirect()->route("admin.courses")->with("error" , "Something went wrong");
        }

        $course = DB::select("select * from courses where id = $course_id");

        if(empty($course))
        {
            return redirect()->route("admin.courses")->with("error" , "Something went wrong");
        }

        $data = $request->except("_token");
        $data["course_id"] = $course_id;

        $isCreated = DB::table("lessons")->insert($data);

        if($isCreated)
        {
            return redirect()->route("admin.courses")->with("success" , "Lesson created successfully");
        }
        else
        {
            return redirect()->route("admin.courses")->with("error" , "Something went wrong");
        }
    }

}
