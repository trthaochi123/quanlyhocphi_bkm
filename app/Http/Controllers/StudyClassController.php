<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Major;
use App\Models\StudyClass;
use App\Http\Requests\StoreStudyClassRequest;
use App\Http\Requests\UpdateStudyClassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudyClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new StudyClass();
        $classes = $obj->index();
        return view('classes.index',[
            'classes'=>$classes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obj1 = new Major();
        $majors = $obj1->index();
        $obj2 = new AcademicYear();
        $academics = $obj2->index();
        return view('classes.create',[
            'majors'=>$majors,
            'academics'=>$academics
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudyClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudyClassRequest $request)
    {
        $obj = new StudyClass();
        $obj->class_name = $request->class_name;
        $obj->major_id = $request->major_id;
        $obj->academic_id = $request->academic_id;
        $obj->store();
        return Redirect::route('study_classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudyClass  $studyClass
     * @return \Illuminate\Http\Response
     */
    public function show(StudyClass $studyClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudyClass  $studyClass
     * @return \Illuminate\Http\Response
     */
    public function edit(StudyClass $studyClass, Request $request)
    {
        $obj1 = new Major();
        $majors = $obj1->index();
        $obj2 = new AcademicYear();
        $academics = $obj2->index();

        $obj3 = new StudyClass();
        $obj3->id = $request->id;
        $classes = $obj3->edit();
        return view('classes.edit',[
            'majors'=>$majors,
            'academics'=>$academics,
            'classes'=>$classes,
            'id'=>$obj3->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudyClassRequest  $request
     * @param  \App\Models\StudyClass  $studyClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudyClassRequest $request, StudyClass $studyClass)
    {
        $obj = new StudyClass();
        $obj->id = $request->id;
        $obj->class_name = $request->class_name;
        $obj->major_id = $request->major_id;
        $obj->academic_id = $request->academic_id;
        $obj->updateClass();
        return Redirect::route('study_classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudyClass  $studyClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudyClass $studyClass, Request $request)
    {
        $obj = new StudyClass();
        $obj->id = $request->id;
        $obj->destroyClass();
        return Redirect::route('study_classes.index');
    }

}
