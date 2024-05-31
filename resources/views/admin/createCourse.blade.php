@extends('layouts.parent')

@section('content')

<div class="p-4 text-center">
    <h2 class="text-primary">Create Course</h2>
</div>

<div class="container create_course_div p-4">
    <form method="POST" action="{{ route('admin.createCoursePost') }}">
        @csrf

        <input type="text" class="form-control my-4" name="name" placeholder="name" value="{{ old('name') }}">

        @error("name")

            <div class="alert alert-danger">{{ $message }}</div>

        @enderror

        <button class="btn btn-primary my-4">Create Course</button>

    </form>
</div>

@endsection
