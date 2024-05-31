@extends('layouts.parent')

@section('content')

<div class="p-4 text-center">
    <h2 class="text-primary">Course Name: {{ $course->name }}</h2>
</div>



@if (count($lessons) == 0)
    <div class="py-3">
        <h2 class="text-center">No Lessons Yet</h2>
    </div>
@else
<div class="container py-3">
    <h2 class="text-center text-primary">Lessons</h2>
    <div class="row py-3">
        @foreach ($lessons as $lesson)
            <div class="col-xl-4 text-center">
                <div class="p-4">
                    <h2 >{{ $lesson->name }}</h2>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif



@endsection
