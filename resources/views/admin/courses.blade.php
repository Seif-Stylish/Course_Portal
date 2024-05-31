@extends('layouts.parent')

@section('content')

@include("includes.message")

<div class="p-4 text-center">
    <h2 class="text-primary">All Courses</h2>
</div>

<div class="container">
    <div class="row">
        @foreach ($courses as $course)
        <div class="col-xl-4">
            <div class="p-2 bg-warning text-center">
                <h2>
                    <a class="course_name_link" href="{{ route('admin.createLesson' , $course->id) }}">Name: {{ $course->name }}</a>
                </h2>

                <a href="{{ route('admin.courseDetails' , $course->id) }}" class="btn btn-primary text-white my-3">view lessons</a>

            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
