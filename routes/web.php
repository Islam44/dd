<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
})->name('home');

Auth::routes();

Route::get('/chart/index', 'Chart\ChartsController@index');
Route::get('/chart/index1', 'Chart\ChartsController@index1');
Route::get('/chart/index3', 'Chart\ChartsController@index3');

Route::get('courses', 'Course\CourseController@index');
Route::get('course/{course}', 'Course\CourseController@show');
Route::put('course/update/{course}', 'Course\CourseController@update');
Route::delete('course/delete/{course}', 'Course\CourseController@destroy');


Route::put('course/support/{course}', 'Course\CourseSupporterController@update');

Route::get('students', 'Student\StudentsController@index');
Route::get('students/create', 'Student\StudentsController@create');
Route::get('students/edit', 'Student\StudentsController@edit');
Route::post('students', 'Student\StudentsController@store');
Route::get('students/{student}', 'Student\StudentsController@show');
Route::put('student/update/{studentobj}', 'Student\StudentsController@update');
Route::delete('student/delete/{student}', 'Student\StudentsController@destroy');

Route::get('supporters', 'Supporter\SupportersController@index');
Route::get('supporters/create', 'Supporter\SupportersController@create');
Route::get('supporters/edit', 'Supporter\SupportersController@edit');
Route::post('supporters', 'Supporter\SupportersController@store');
Route::get('supporters/{supporter}', 'Supporter\SupportersController@show');
Route::put('supporter/update/{supporter}', 'Supporter\SupportersController@update');
Route::delete('supporter/delete/{supporter}', 'Supporter\SupportersController@destroy');
Route::post('supporter/addtosupporter/{supporter}', 'Supporter\SupportersController@assignCoursersToSupporter');

Route::get('teacher/mycourses', 'Teacher\TeacherCourseController@index');
Route::get('teacher/mycourses/{course}', 'Teacher\TeacherCourseController@show');
Route::post('teacher/addcourse', 'Teacher\TeacherCourseController@store');
Route::delete('teacher/deletecourse/{course}', 'Teacher\TeacherCourseController@destroy');
Route::put('teacher/updatecourse/{course}', 'Teacher\TeacherCourseController@update');

Route::get('teacher/mysupporter', 'Teacher\TeacherSupporterController@index');
Route::post('teacher/addsupporter', 'Teacher\TeacherSupporterController@store');
Route::delete('teacher/deletesupporter/{supporter}', 'Teacher\TeacherSupporterController@destroy');
Route::get('teacher/bansupporter/{supporter}', 'Teacher\TeacherSupporterController@ban');
Route::get('teacher/unbansupporter/{supporter}', 'Teacher\TeacherSupporterController@unban');


Route::get('teachers', 'Teacher\TeachersController@index');
Route::get('teachers/create', 'Teacher\TeachersController@create');
Route::get('teachers/edit', 'Teacher\TeachersController@edit');
Route::post('teachers', 'Teacher\TeachersController@store');
Route::get('teachers/{teacher}', 'Teacher\TeachersController@show');
Route::put('teacher/update/{teacherobj}', 'Teacher\TeachersController@update');
Route::delete('teacher/delete/{teacher}', 'Teacher\TeachersController@destroy');
