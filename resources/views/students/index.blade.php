@extends('layouts.app')

@section('content')
<h2>Students</h2>
<a href="/students/create" class="btn btn-primary mb-2">Add Student</a>

<table class="table table-bordered">
<tr><th>Name</th><th>Email</th></tr>
@foreach($students as $student)
<tr>
    <td>{{ $student->name }}</td>
    <td>{{ $student->email }}</td>
</tr>
@endforeach
</table>
@endsection
