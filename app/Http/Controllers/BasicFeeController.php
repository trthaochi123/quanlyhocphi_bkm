<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\BasicFee;
use App\Http\Requests\StoreBasicFeeRequest;
use App\Http\Requests\UpdateBasicFeeRequest;
use App\Models\Major;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BasicFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new BasicFee();
        $basic_fees = $obj->index();
        return view('basic_fees.index',[
            'basic_fees'=>$basic_fees
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
        return view('basic_fees.create',[
            'majors'=>$majors,
            'academics'=>$academics
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBasicFeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBasicFeeRequest $request)
    {
        $obj = new BasicFee();
        $obj->major_id = $request->major_id;
        $obj->academic_id = $request->academic_id;
        $obj->basic_fee_amount = $request->basic_fee_amount;
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'major_id' => BasicFee::uniqueMajorAndAcademic($request->major_id),
            'academic_id ' => BasicFee::uniqueMajorAndAcademic($request->academic_id),
        ]);
        if ($validator->fails()) {
            return alert('Bản ghi đã tồn tại!');
        }else{
            $obj->store();
            return Redirect::route('basic_fees.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BasicFee  $basicFee
     * @return \Illuminate\Http\Response
     */
    public function show(BasicFee $basicFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BasicFee  $basicFee
     * @return \Illuminate\Http\Response
     */
    public function edit(BasicFee $basicFee, Request $request)
    {
        $obj1 = new Major();
        $majors = $obj1->index();
        $obj2 = new AcademicYear();
        $academics = $obj2->index();

        $obj3 = new BasicFee();
        $obj3->major_id = $request->major_id;
        $obj3->academic_id = $request->academic_id;
        $basic_fees = $obj3->edit();
        return view('basic_fees.edit',[
            'majors'=>$majors,
            'academics'=>$academics,
            'basic_fees'=>$basic_fees,
            'major_id'=>$obj3->major_id,
            'academic_id'=>$obj3->academic_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBasicFeeRequest  $request
     * @param  \App\Models\BasicFee  $basicFee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBasicFeeRequest $request, BasicFee $basicFee)
    {
        $obj = new BasicFee();
        $obj->major_id = $request->major_id;
        $obj->academic_id = $request->academic_id;
        $obj->basic_fee_amount = $request->basic_fee_amount;
        $obj->updateBasicFee();
        return Redirect::route('basic_fees.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BasicFee  $basicFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(BasicFee $basicFee, Request $request)
    {
        $obj = new BasicFee();
        $obj->major_id = $request->major_id;
        $obj->academic_id = $request->academic_id;
        $obj->destroyBasicFee();
        return Redirect::route('basic_fees.index');
    }
}
