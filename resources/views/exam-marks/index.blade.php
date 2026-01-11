@extends('layouts.app')

@section('content')
<h2>Exam Marks</h2>
<a href="/exam-marks/create" class="btn btn-primary mb-2">Add Marks</a>

@if($marks->count() === 0)
    <div class="alert alert-info">No exam marks found. Add marks for a student and course.</div>
@else
    <table class="table table-bordered">
    <tr>
    <th>Student</th><th>Course</th><th>Marks</th><th>Actions</th>
    </tr>
    @foreach($marks as $m)
    <tr>
    <td>{{ $m->student->name }}</td>
    <td>{{ $m->course->name }}</td>
    <td>{{ $m->marks }}</td>
    <td class="d-flex gap-2">
        <a href="{{ route('exam-marks.edit', $m) }}" class="btn btn-sm btn-warning">Edit</a>
        <form method="POST" action="{{ route('exam-marks.destroy', $m) }}" onsubmit="return confirm('Delete these marks?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
    </tr>
    @endforeach
    </table>

    {{ $marks->links() }}
@endif
@endsection
