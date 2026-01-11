@extends('layouts.app')

@section('content')
<h2>Edit Student</h2>

<form method="POST" action="{{ route('students.update', $student) }}">
@csrf
@method('PUT')
<input class="form-control mb-2" name="name" value="{{ old('name', $student->name) }}" placeholder="Name">
<input class="form-control mb-2" name="email" value="{{ old('email', $student->email) }}" placeholder="Email">
<button class="btn btn-success">Update</button>
<a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

