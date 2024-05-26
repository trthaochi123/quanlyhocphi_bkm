<?php

namespace App\Http\Controllers;

use App\Models\Start;
use App\Http\Requests\StoreStartRequest;
use App\Http\Requests\UpdateStartRequest;

class StartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('start.index');
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
     * @param  \App\Http\Requests\StoreStartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
    public function show(Start $start)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
    public function edit(Start $start)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStartRequest  $request
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStartRequest $request, Start $start)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
    public function destroy(Start $start)
    {
        //
    }
}
