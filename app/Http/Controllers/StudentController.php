<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', [
            'students' => Student::all()
        ]);
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:students,email',
    ]);

    Student::create($validated);

    return redirect('/students')->with('success', 'Student added successfully');
}

}
