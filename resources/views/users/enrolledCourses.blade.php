@extends('layouts.parent')

@section('content')

<div class="p-4 text-center">
    <h2 class="text-primary">Enrolled Courses</h2>
</div>

<div class="p-3">
    <div class="container">
        <div class="row">
            @foreach ($enrolledCourses as $course)
                <div class="col-xl-4 text-center">
                    <div class="p-2" style="border-radius: 7px; border: 2px solid #007bff;">
                        <h2>Name: {{ $course->name }}</h2>
                        <a class="btn btn-primary text-white my-2" href="{{ route('user.courseDetails' , $course->id) }}">View Lessons</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
