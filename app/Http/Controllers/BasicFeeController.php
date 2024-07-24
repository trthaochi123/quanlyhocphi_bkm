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
use Illuminate\Support\Facades\Validator;

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
        return view('basic_fees.index', [
            'basic_fees' => $basic_fees
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

        return view('basic_fees.create', [
            'majors' => $majors,
            'academics' => $academics
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBasicFeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreBasicFeeRequest $request)
    // {
    //     if ($request->validated()) {
    //         $obj = new BasicFee();
    //         $obj->major_id = $request->major_id;
    //         $obj->academic_id = $request->academic_id;
    //         $obj->basic_fee_amount = $request->basic_fee_amount;
    //         $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
    //             'major_id' => BasicFee::uniqueMajorAndAcademic($request->major_id),
    //             'academic_id ' => BasicFee::uniqueMajorAndAcademic($request->academic_id),
    //         ]);
    //         if ($validator->fails()) {
    //             return alert('Bản ghi đã tồn tại!');
    //         } else {
    //             $obj->store();
    //             session()->flash('success', 'Đã tạo thành công!');
    //             return Redirect::route('basic_fees.index');
    //         }
    //     } else {
    //         return Redirect::back();
    //     }
    // }

    public function store(StoreBasicFeeRequest $request)
    {

        // Xác thực dữ liệu
        $validatedData = $request->validated();

        // Kiểm tra tính duy nhất của major_id và academic_id
        $existsValidator = Validator::make($validatedData, [
            'major_id' => [
                'required',
                function ($attribute, $value, $fail) use ($validatedData) {
                    if (BasicFee::where('major_id', $value)
                        ->where('academic_id', $validatedData['academic_id'])
                        ->exists()) {
                        $fail('Bản ghi đã tồn tại!');
                    }
                },
            ],
        ]);

        if ($existsValidator->fails()) {
            return redirect()->back()->withErrors($existsValidator)->withInput();
        }

        // Nếu không có lỗi về tính duy nhất, tiến hành lưu trữ dữ liệu
        BasicFee::create($validatedData);

        return Redirect::route('basic_fees.index')->with('success', 'Thêm thành công!');
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
        return view('basic_fees.edit', [
            'majors' => $majors,
            'academics' => $academics,
            'basic_fees' => $basic_fees,
            'major_id' => $obj3->major_id,
            'academic_id' => $obj3->academic_id
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
        if ($request->validated()){
            $obj = new BasicFee();
            $obj->major_id = $request->major_id;
            $obj->academic_id = $request->academic_id;
            $obj->basic_fee_amount = $request->basic_fee_amount;
            $obj->updateBasicFee();
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('basic_fees.index');
        } else {
            return Redirect::back();
        }

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
        $studyClassesCount = \DB::table('study_classes')
            ->where('major_id', $request->major_id)
            ->where('academic_id', $request->academic_id)
            ->count();

        if ($studyClassesCount > 0) {
            return redirect()->back()->with('error', 'Không thể xóa Học phí cơ bản này vì vẫn được sử dụng.');
        } else {
            $obj->major_id = $request->major_id;
            $obj->academic_id = $request->academic_id;
            // Nếu không có bản ghi liên quan, tiến hành xóa
            $obj->destroyBasicFee();
            session()->flash('success', 'Đã xóa thành công!');
        }

        return redirect()->route('basic_fees.index');
    }
}
