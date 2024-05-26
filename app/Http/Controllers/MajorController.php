<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new Major();
        $majors = $obj->index();
        return view('majors.index',[
            'majors'=>$majors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('majors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMajorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMajorRequest $request)
    {
        $obj = new Major();
        $obj->name = $request->name;
        $obj->store();
        return Redirect::route('majors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major, Request $request)
    {
        $obj = new Major();
        $obj->id = $request->id;
        $major = $obj->edit();
        return view('majors.edit',[
            'majors' => $major,
            'id'=> $obj->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMajorRequest  $request
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMajorRequest $request, Major $major)
    {
        $obj = new Major();
        $obj->id = $request->id;
        $obj->name = $request->name;
        $obj->updateMajor();
        return Redirect::route('majors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major, Request $request)
    {
        $obj = new Major();
        $obj->id = $request->id;
        $obj->destroyMajor();
        return Redirect::route('majors.index');
    }
}
