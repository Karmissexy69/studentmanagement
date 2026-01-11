@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h2>Deleted Students</h2>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
</div>

@if($students->count() === 0)
    <div class="alert alert-info mt-3">No deleted students.</div>
@else
    <table class="table table-bordered mt-3">
        <tr><th>Name</th><th>Email</th><th>Deleted At</th><th>Actions</th></tr>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->deleted_at }}</td>
            <td>
                <form method="POST" action="{{ route('students.restore', $student->id) }}">
                    @csrf
                    <button class="btn btn-sm btn-success">Restore</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $students->links() }}
@endif
@endsection

