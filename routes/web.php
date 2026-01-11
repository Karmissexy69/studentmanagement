
<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamMarkController;
use App\Http\Controllers\ReportController;

Route::get('/', fn()=>redirect('/students'));

Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
Route::resource('exam-marks', ExamMarkController::class);

Route::get('/reports/students',[ReportController::class,'studentAverage']);
Route::get('/reports/courses',[ReportController::class,'courseAverage']);
Route::get('/reports/students/export',[ReportController::class,'exportStudentAverage']);
Route::get('/reports/courses/export',[ReportController::class,'exportCourseAverage']);

