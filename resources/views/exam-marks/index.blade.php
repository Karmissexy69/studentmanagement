@extends('layouts.app')

@section('content')
<h2>Exam Marks</h2>
<a href="/exam-marks/create" class="btn btn-primary mb-2">Add Marks</a>

<table class="table table-bordered">
<tr>
<th>Student</th><th>Course</th><th>Marks</th>
</tr>
@foreach($marks as $m)
<tr>
<td>{{ $m->student->name }}</td>
<td>{{ $m->course->name }}</td>
<td>{{ $m->marks }}</td>
</tr>
@endforeach
</table>
@endsection
