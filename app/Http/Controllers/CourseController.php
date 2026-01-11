<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::all()
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:courses,name',
    ]);

    Course::create($validated);

    return redirect('/courses')->with('success', 'Course added successfully');
}

}
