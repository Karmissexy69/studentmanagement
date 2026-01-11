@extends('layouts.app')

@section('content')
<h2>Courses</h2>
<a href="/courses/create" class="btn btn-primary mb-2">Add Course</a>

<table class="table table-bordered">
<tr><th>Course Name</th></tr>
@foreach($courses as $course)
<tr><td>{{ $course->name }}</td></tr>
@endforeach
</table>
@endsection
