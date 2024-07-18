<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Http\Requests\StoreScholarshipRequest;
use App\Http\Requests\UpdateScholarshipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


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
        $validatedData = $request->validated();

        // Kiểm tra trùng lặp class_name
        $existsValidator = Validator::make($validatedData, [
            'scholarship_amount' => [
                'required',
                'numeric',
                'gt:0', // Kiểm tra nếu giá trị lớn hơn 0
                function ($attribute, $value, $fail) {
                    if (Scholarship::where('scholarship_amount', $value)->exists()) {
                        $fail('Mức học bổng đã tồn tại.');
                    }
                },
            ],
        ]);

        if ($existsValidator->fails()) {
            // Nếu validation thất bại, trả về với thông báo lỗi
            return redirect()->back()->withErrors($existsValidator)->withInput();
        }

        if ($request->validated()){
            $obj = new Scholarship();
            $obj->scholarship_amount = $request->scholarship_amount;
            $obj->store();
            session()->flash('success', 'Đã tạo thành công!');
            return Redirect::route('scholarships.index');
        } else {
            return Redirect::back();
        }
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
        if ($request->validated()) {
            $obj = new  Scholarship();
            $obj->id = $request->id;
            $obj->scholarship_amount = $request->scholarship_amount;
            $obj->updateScholarship();
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('scholarships.index');
        } else {
            return Redirect::back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Scholarship $scholarship, Request $request)
    // {
    //     $obj = new Scholarship();
    //     $obj->id = $request->id;
    //     $obj->destroyScholarship();
    //     session()->flash('success', 'Đã xoá thành công!');
    //     return Redirect::route('scholarships.index');
    // }

    public function destroy($id)
    {
        $studentsCount = \DB::table('students')->where('scholarship_id', $id)->count();

        // kiem tra xem co ban ghi tham chieu ko
        if ($studentsCount > 0) {
            return redirect()->back()->with('error', 'Không thể xóa Mức học bổng này vì vẫn còn Sinh viên tham chiếu đến nó.');
        }

        // Nếu không có bản ghi liên quan, tiến hành xóa
        Scholarship::destroy($id);
        return redirect()->route('scholarships.index')->with('success', 'Đã xóa thành công!');
    }
}
