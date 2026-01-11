<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::latest()->paginate(10)
        ]);
    }

    public function trash()
    {
        return view('courses.trash', [
            'courses' => Course::onlyTrashed()->latest()->paginate(10),
        ]);
    }

    public function restore(string $id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();

        return redirect()->route('courses.trash')->with('success', 'Course restored successfully');
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('courses', 'name')->whereNull('deleted_at'),
        ],
    ]);

    Course::create($validated);

    return redirect('/courses')->with('success', 'Course added successfully');
}

    public function edit(Course $course)
    {
        return view('courses.edit', [
            'course' => $course,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses', 'name')->whereNull('deleted_at')->ignore($course->id),
            ],
        ]);

        $course->update($validated);

        return redirect('/courses')->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        if ($course->examMarks()->exists()) {
            return redirect()
                ->route('courses.index')
                ->with('error', 'Cannot delete course because exam marks exist.');
        }

        $course->delete();

        return redirect('/courses')->with('success', 'Course deleted successfully');
    }

}
