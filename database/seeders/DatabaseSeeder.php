<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;
use App\Models\ExamMark;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create students
        $students = [
            ['name' => 'Alice', 'email' => 'alice@test.com'],
            ['name' => 'Bob', 'email' => 'bob@test.com'],
            ['name' => 'Charlie', 'email' => 'charlie@test.com'],
        ];

        foreach ($students as $s) {
            Student::create($s);
        }

        // Create courses
        $courses = [
            ['name' => 'Mathematics'],
            ['name' => 'Science'],
            ['name' => 'History'],
        ];

        foreach ($courses as $c) {
            Course::create($c);
        }

        // Create exam marks
        foreach (Student::all() as $student) {
            foreach (Course::all() as $course) {
                ExamMark::create([
                    'student_id' => $student->id,
                    'course_id'  => $course->id,
                    'marks'      => rand(60, 95),
                ]);
            }
        }
    }
}
