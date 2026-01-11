@extends('layouts.app')

@section('content')
<h2>Average Marks Per Student</h2>
<a href="/reports/students/export" class="btn btn-secondary mb-2">Export CSV</a>

<table class="table table-bordered">
<tr><th>Student</th><th>Average</th></tr>
@foreach($data as $s)
<tr>
<td>{{ $s->name }}</td>
<td>{{ round($s->examMarks->avg('marks'),2) }}</td>
</tr>
@endforeach
</table>
@endsection
