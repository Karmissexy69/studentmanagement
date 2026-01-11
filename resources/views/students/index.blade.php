@extends('layouts.app')

@section('content')
<h2>Students</h2>
<a href="/students/create" class="btn btn-primary mb-2">Add Student</a>
<a href="{{ route('students.trash') }}" class="btn btn-secondary mb-2">Trash</a>

@if($students->count() === 0)
    <div class="alert alert-info">No students found. Add your first student.</div>
@else
    <table class="table table-bordered">
    <tr><th>Name</th><th>Email</th><th>Actions</th></tr>
    @foreach($students as $student)
    <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td class="d-flex gap-2">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
            <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Delete this student?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </table>

    {{ $students->links() }}
@endif
@endsection
