<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use app\http\Requests\StudentRequest;
use App\Student;
use http\Env\Request;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(5);
        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => $request->password,
            'dob' => $request->dob,
            'image' => $request->file('student_image')->store('student_image')
        ]);
        return response()->json($student);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $studentobj)
    {
        $studentobj->name = $request->name;
        $studentobj->gender = $request->gender;
        $studentobj->email = $request->email;
        $studentobj->password = $request->password;
        $studentobj->dob = $request->dob;
        if ($request->hasFile('student_image')) {
            Storage::delete($studentobj->image);
            $studentobj->image = $request->file('student_image')->store('student_image');
        }
        if ($studentobj->isClean()) {
            return response()->json('You need to specify a different value to update', 422);
        }
        $studentobj->save();
        return response()->json($studentobj);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json($student);
    }
}
