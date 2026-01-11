@extends('layouts.app')

@section('content')
<h2>Add Course</h2>

<form method="POST" action="/courses">
@csrf
<input class="form-control mb-2" name="name" placeholder="Course Name">
<button class="btn btn-success">Save</button>
</form>
@endsection
