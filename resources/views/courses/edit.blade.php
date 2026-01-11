@extends('layouts.app')

@section('content')
<h2>Edit Course</h2>

<form method="POST" action="{{ route('courses.update', $course) }}">
@csrf
@method('PUT')
<input class="form-control mb-2" name="name" value="{{ old('name', $course->name) }}" placeholder="Course Name">
<button class="btn btn-success">Update</button>
<a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

