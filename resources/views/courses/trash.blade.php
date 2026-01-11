@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h2>Deleted Courses</h2>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
</div>

@if($courses->count() === 0)
    <div class="alert alert-info mt-3">No deleted courses.</div>
@else
    <table class="table table-bordered mt-3">
        <tr><th>Course Name</th><th>Deleted At</th><th>Actions</th></tr>
        @foreach($courses as $course)
        <tr>
            <td>{{ $course->name }}</td>
            <td>{{ $course->deleted_at }}</td>
            <td>
                <form method="POST" action="{{ route('courses.restore', $course->id) }}">
                    @csrf
                    <button class="btn btn-sm btn-success">Restore</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $courses->links() }}
@endif
@endsection

