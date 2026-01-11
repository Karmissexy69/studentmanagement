@extends('layouts.app')

@section('content')
<h2>Add Exam Marks</h2>

<form method="POST" action="/exam-marks">
@csrf

<select class="form-control mb-2" name="student_id">
@foreach($students as $s)
<option value="{{ $s->id }}">{{ $s->name }}</option>
@endforeach
</select>

<select class="form-control mb-2" name="course_id">
@foreach($courses as $c)
<option value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach
</select>

<input class="form-control mb-2" name="marks" placeholder="Marks">
<button class="btn btn-success">Save</button>
</form>
@endsection
