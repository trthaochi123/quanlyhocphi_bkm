<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Http\Requests\StoreScholarshipRequest;
use App\Http\Requests\UpdateScholarshipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new Scholarship();
        $scholarship = $obj->index();
        return view('scholarships.index',[
            'scholarships'=>$scholarship
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scholarships.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScholarshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScholarshipRequest $request)
    {
        $obj = new Scholarship();
        $obj->scholarship_amount = $request->scholarship_amount;
        $obj->store();
        return Redirect::route('scholarships.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function show(Scholarship $scholarship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function edit(Scholarship $scholarship, Request $request)
    {
        $obj = new Scholarship();
        $obj->id = $request->id;
        $scholarship = $obj->edit();
        return view('scholarships.edit',[
            'scholarships' => $scholarship,
            'id'=>$obj->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScholarshipRequest  $request
     * @param  \App\Models\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScholarshipRequest $request, Scholarship $scholarship)
    {
        $obj = new  Scholarship();
        $obj->id = $request->id;
        $obj->scholarship_amount = $request->scholarship_amount;
        $obj->updateScholarship();
        return Redirect::route('scholarships.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scholarship $scholarship, Request $request)
    {
        $obj = new Scholarship();
        $obj->id = $request->id;
        $obj->destroyScholarship();
        return Redirect::route('scholarships.index');
    }
}
