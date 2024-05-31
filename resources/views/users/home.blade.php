@extends('layouts.parent')

@section('content')

<div class="p-4 text-center">
    <h2 class="text-primary">Welcome {{ Auth::user()->name }}</h2>
</div>

@endsection
