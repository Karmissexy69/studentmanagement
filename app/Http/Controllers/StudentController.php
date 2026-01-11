<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', [
            'students' => Student::latest()->paginate(10)
        ]);
    }

    public function trash()
    {
        return view('students.trash', [
            'students' => Student::onlyTrashed()->latest()->paginate(10),
        ]);
    }

    public function restore(string $id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->restore();

        return redirect()->route('students.trash')->with('success', 'Student restored successfully');
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            Rule::unique('students', 'email')->whereNull('deleted_at'),
        ],
    ]);

    Student::create($validated);

    return redirect('/students')->with('success', 'Student added successfully');
}

    public function edit(Student $student)
    {
        return view('students.edit', [
            'student' => $student,
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('students', 'email')->whereNull('deleted_at')->ignore($student->id),
            ],
        ]);

        $student->update($validated);

        return redirect('/students')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        if ($student->examMarks()->exists()) {
            return redirect()
                ->route('students.index')
                ->with('error', 'Cannot delete student because exam marks exist.');
        }

        $student->delete();

        return redirect('/students')->with('success', 'Student deleted successfully');
    }

}
