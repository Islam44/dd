<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use app\http\Requests\StudentRequest;
use App\Student;
use App\Teacher;
use http\Env\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::paginate(5);
        return response()->json($teachers);
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
    public function store(Request $request)
    {
        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'national_id' => $request->national_id,
            'image' => $request->image->store('image')
        ]);
        $teacher->assignRole([(Role::where('name','=','Teacher')->first())->id]);
        return response()->json($teacher);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacherobj)
    {
        $teacherobj->name = $request->name;
        $teacherobj->email = $request->email;
        $teacherobj->password = bcrypt($request->password);
        if ($request->hasFile('image')) {
            Storage::delete($teacherobj->image);
            $teacherobj->image = $request->image->store('image');
        }
        if ($teacherobj->isClean()) {
            return response()->json('You need to specify a different value to update', 422);
        }
        $teacherobj->save();
        return response()->json($teacherobj);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json($teacher);
    }
}
