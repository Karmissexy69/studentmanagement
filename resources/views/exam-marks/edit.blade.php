@extends('layouts.app')

@section('content')
<h2>Edit Exam Marks</h2>

<form method="POST" action="{{ route('exam-marks.update', $mark) }}">
@csrf
@method('PUT')

<select class="form-control mb-2" name="student_id">
@foreach($students as $s)
<option value="{{ $s->id }}" @selected(old('student_id', $mark->student_id) == $s->id)>{{ $s->name }}</option>
@endforeach
</select>

<select class="form-control mb-2" name="course_id">
@foreach($courses as $c)
<option value="{{ $c->id }}" @selected(old('course_id', $mark->course_id) == $c->id)>{{ $c->name }}</option>
@endforeach
</select>

<input class="form-control mb-2" name="marks" value="{{ old('marks', $mark->marks) }}" placeholder="Marks">
<button class="btn btn-success">Update</button>
<a href="{{ route('exam-marks.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

