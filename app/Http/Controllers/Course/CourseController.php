<?php

namespace App\Http\Controllers\Course;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\StoreCourseRequest;
use http\Env\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with('teacher')->paginate(10);
        return response()->json($courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
//        $course=Course::create([
//            'name' => request()->name,
//            'created_at' => request()->created_at,
//            'image' => request()->file('course_image')->store('course_images'),
//            'price' => request()->price * 100,
//            'start_date' => request()->start_date,
//            'end_date' => request()->end_date,
//            'user_id' => $request->user()->id
//        ]);
//        return response()->json($course);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Course $course)
    {

        return response()->json([
           /// 'course'=>$course,
            'data'=> $course->with(['supporters' => function($query) {
                return $query->where('available','=',0);
            }])->get()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
//        $course = Course::find($course);
//        return view('courses.edit',['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCourseRequest $request, Course $course)
    {
            $course->update(array(
                'name' => $request->name,
                'created_at' => $request->created_at,
                'price' => $request->price * 100,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ));
            if (request()->hasFile('image')) {
                Storage::delete($request->image);
                $course->image = $request->image->store('images');
            }
            return response()->json($course);

        //return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if(count($course->students()->get())>0){
            return response()->json('you cant delete this course');
        }
        else{
            $course->delete();
            return response()->json($course);

        }
    }
}
