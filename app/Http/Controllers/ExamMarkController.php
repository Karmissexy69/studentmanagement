<?php

namespace App\Http\Controllers;

use App\Models\ExamMark;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExamMarkController extends Controller
{
    public function index()
    {
        return view('exam-marks.index', [
            'marks' => ExamMark::with('student', 'course')->latest()->paginate(10)
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
        return back()
            ->withInput()
            ->withErrors([
                'course_id' => 'Marks for this student and course already exist.',
            ]);
    }

    ExamMark::create($validated);

    return redirect('/exam-marks')->with('success', 'Marks added successfully');
}

    public function edit(ExamMark $exam_mark)
    {
        return view('exam-marks.edit', [
            'mark' => $exam_mark->load('student', 'course'),
            'students' => Student::all(),
            'courses'  => Course::all(),
        ]);
    }

    public function update(Request $request, ExamMark $exam_mark)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'marks' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $duplicateRule = Rule::unique('exam_marks')->where(function ($query) use ($validated) {
            return $query
                ->where('student_id', $validated['student_id'])
                ->where('course_id', $validated['course_id']);
        });

        $request->validate([
            'course_id' => [$duplicateRule->ignore($exam_mark->id)],
        ], [
            'course_id.unique' => 'Marks for this student and course already exist.',
        ]);

        $exam_mark->update($validated);

        return redirect('/exam-marks')->with('success', 'Marks updated successfully');
    }

    public function destroy(ExamMark $exam_mark)
    {
        $exam_mark->delete();

        return redirect('/exam-marks')->with('success', 'Marks deleted successfully');
    }

}
