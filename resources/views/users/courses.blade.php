@extends('layouts.parent')

@section('content')

@include("includes.message")

<div class="p-4 text-center">
    <h2 class="text-primary">All Courses</h2>
</div>

<div class="p-3">
    <div class="container">
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-xl-4 text-center">
                    <div class="p-2" style="border-radius: 7px; border: 2px solid #007bff;">
                        <h2>Name: {{ $course->name }}</h2>
                        <h2>Lessons:
                            {{ DB::select("select l.course_id , count(l.course_id) as no_of_lessons from lessons l group by l.course_id")[0]->no_of_lessons }}
                        </h2>

                        @if (empty(DB::select("select * from user_courses where user_id = ".Auth::user()->id . " and course_id = ".$course->id)))
                            <form method="POST" action="{{ route('user.enrollPost' , $course->id) }}">
                                @csrf
                                <button class="btn btn-primary mt-3">Enroll</button>
                            </form>
                        @else
                        <h2 class="text-danger mt-3">Enrolled</h2>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
