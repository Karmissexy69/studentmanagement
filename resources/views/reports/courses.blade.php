@extends('layouts.app')

@section('content')
<h2>Average Marks Per Course</h2>
<a href="/reports/courses/export" class="btn btn-secondary mb-2">Export CSV</a>

<table class="table table-bordered">
<tr><th>Course</th><th>Average</th></tr>
@foreach($data as $c)
<tr>
<td>{{ $c->name }}</td>
<td>{{ round($c->examMarks->avg('marks'),2) }}</td>
</tr>
@endforeach
</table>
@endsection
