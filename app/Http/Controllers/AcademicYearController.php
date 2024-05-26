<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Http\Requests\StoreAcademicYearRequest;
use App\Http\Requests\UpdateAcademicYearRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new AcademicYear();
        $academics = $obj->index();
        return view('academic_years.index',[
            'academics'=>$academics
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic_years.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAcademicYearRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcademicYearRequest $request)
    {
        $obj = new AcademicYear();
        $obj->academic_start_year = $request->academic_start_year;
        $obj->academic_end_year = $request->academic_end_year;
        $obj->academic_name = $request->academic_name;
        $obj->store();
        return Redirect::route('academics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicYear $academicYear, Request $request)
    {
        $obj = new AcademicYear();
        $obj->id = $request->id;
        $academic = $obj->edit();
        return view('academic_years.edit',[
            'academics' => $academic,
            'id'=>$obj->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcademicYearRequest  $request
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcademicYearRequest $request, AcademicYear $academicYear)
    {
        $obj = new AcademicYear();
        $obj->id = $request->id;
        $obj->academic_start_year = $request->academic_start_year;
        $obj->academic_end_year = $request->academic_end_year;
        $obj->academic_name = $request->academic_name;
        $obj->updateAcademic();
        return Redirect::route('academics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicYear $academicYear, Request $request)
    {
        $obj = new AcademicYear();
        $obj->id = $request->id;
        $obj->destroyAcademic();
        return Redirect::route('academics.index');
    }

    public function newFunction(){

    }
}
