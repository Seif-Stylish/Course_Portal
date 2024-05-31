@extends('layouts.parent')

@section('content')

<div class="p-4 text-center">
    <h2 class="text-primary">Achievements</h2>
</div>

<div class="container">
    <div class="row">
        <div class="col-xl-6">
            <div class="p-3 text-center" style="border-radius: 7px; border: 2px solid #007bff">
                <h2 class="text-center text-primary my-3" style="text-decoration: underline">Complete Courses</h2>
                @foreach ($achievements as $achievement)
                    @if(DB::select("select l.course_id , count(*) as no_of_lessons from lessons l where l.course_id = ".$achievement->course_id . " group by l.course_id")[0]->no_of_lessons == $achievement->no_of_lessons_viewed)
                    <h2 class="text-success mb-4">{{ $achievement->course_name }}</h2>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-xl-6">
            <div class="p-3 text-center" style="border-radius: 7px; border: 2px solid #007bff">
                <h2 class="text-center text-primary my-3" style="text-decoration: underline">Complete Lessons</h2>
                @foreach ($courses as $course)
                    <h2>{{ $course->course_name }}{{ count($course->lessons) > 0 ? ": ". count($course->lessons) : "" }}</h2>
                    @if (count($course->lessons) > 0)
                        @foreach ($course->lessons as $lessons)
                        <h5>{{ $lessons->name }}</h5>
                        @endforeach
                    @else
                        <h5>No Lessons Viewed Yet</h5>
                    @endif

                @endforeach
            </div>
        </div>
    </div>
</div>



@endsection
