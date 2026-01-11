@extends('layouts.app')

@section('content')
<h2>Add Student</h2>

<form method="POST" action="/students">
@csrf
<input class="form-control mb-2" name="name" placeholder="Name">
<input class="form-control mb-2" name="email" placeholder="Email">
<button class="btn btn-success">Save</button>
</form>
@endsection
