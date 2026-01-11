<?php

namespace App\Http\Controllers;

use App\Models\ExamMark;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class ExamMarkController extends Controller
{
    public function index()
    {
        return view('exam-marks.index', [
            'marks' => ExamMark::with('student', 'course')->get()
        ]);
    }

    public function create()
    {
        return view('exam-marks.create', [
            'students' => Student::all(),
            'courses'  => Course::all()
        ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'course_id'  => 'required|exists:courses,id',
        'marks'      => 'required|integer|min:0|max:100',
    ]);

    // Prevent duplicate student + course
    $exists = ExamMark::where('student_id', $validated['student_id'])
        ->where('course_id', $validated['course_id'])
        ->exists();

    if ($exists) {
        return back()->withErrors([
            'course_id' => 'Marks for this student and course already exist.'
        ]);
    }

    ExamMark::create($validated);

    return redirect('/exam-marks')->with('success', 'Marks added successfully');
}

}
