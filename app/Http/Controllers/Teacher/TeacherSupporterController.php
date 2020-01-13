<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Supporter;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TeacherSupporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supporters = auth()->user()->supporters();
        return response()->json($supporters);
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
        $user = new User;
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $user->image = $request->image->store('images');
        $user->teacher_id = auth()->user()->id;
        $user->assignRole((Role::where('name', '=', 'Supporter')->first())->id);
        $user->save();
        return response()->json($user);
        // return redirect(route('users.index'));
    }

    public function ban(Supporter $supporter)
    {
        if ($supporter->isNotBanned())
            $supporter->ban();
        return response()->json('ban');

    }

    public function unban(Supporter $supporter)
    {
        if ($supporter->isBanned())
            $supporter->unban();
        return response()->json('unban');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supporter $supporter)
    {
        $supporter->delete();
    }
}
