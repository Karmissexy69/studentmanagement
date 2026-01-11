@extends('layouts.app')

@section('content')
<h2>Courses</h2>
<a href="/courses/create" class="btn btn-primary mb-2">Add Course</a>
<a href="{{ route('courses.trash') }}" class="btn btn-secondary mb-2">Trash</a>

@if($courses->count() === 0)
    <div class="alert alert-info">No courses found. Add your first course.</div>
@else
    <table class="table table-bordered">
    <tr><th>Course Name</th><th>Actions</th></tr>
    @foreach($courses as $course)
    <tr>
        <td>{{ $course->name }}</td>
        <td class="d-flex gap-2">
            <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">Edit</a>
            <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </table>

    {{ $courses->links() }}
@endif
@endsection
