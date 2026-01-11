<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;

class ReportController extends Controller
{
    public function studentAverage()
    {
        $data = Student::with('examMarks')->get();

        return view('reports.students', compact('data'));
    }

    public function courseAverage()
    {
        $data = Course::with('examMarks')->get();

        return view('reports.courses', compact('data'));
    }

    public function exportStudentAverage()
    {
        $filename = 'student_avg.csv';
        $handle = fopen($filename, 'w');

        fputcsv($handle, ['Student', 'Average']);

        foreach (Student::with('examMarks')->get() as $student) {
            fputcsv($handle, [
                $student->name,
                round($student->examMarks->avg('marks'), 2)
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend();
    }

    public function exportCourseAverage()
    {
        $filename = 'course_avg.csv';
        $handle = fopen($filename, 'w');

        fputcsv($handle, ['Course', 'Average']);

        foreach (Course::with('examMarks')->get() as $course) {
            fputcsv($handle, [
                $course->name,
                round($course->examMarks->avg('marks'), 2)
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend();
    }
}
