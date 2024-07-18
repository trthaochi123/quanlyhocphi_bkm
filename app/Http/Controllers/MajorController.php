<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        return view('majors.index', [
            'majors' => $majors
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
        $validatedData = $request->validated();

        // Kiểm tra trùng lặp class_name
        $existsValidator = Validator::make($validatedData, [
            'name' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Major::where('name', $value)->exists()) {
                        $fail('Ngành học với tên này đã tồn tại.');
                    }
                },
            ],
        ]);

        if ($existsValidator->fails()) {
            // Nếu validation thất bại, trả về với thông báo lỗi
            return redirect()->back()->withErrors($existsValidator)->withInput();
        }

        if ($request->validated()) {
            $obj = new Major();
            $obj->name = $request->name;
            $obj->store();
            session()->flash('success', 'Đã tạo thành công!');
            return Redirect::route('majors.index');
        } else {
            return Redirect::back();
        }
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
        return view('majors.edit', [
            'majors' => $major,
            'id' => $obj->id
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
        if ($request->validated()){
            $obj = new Major();
            $obj->id = $request->id;
            $obj->name = $request->name;
            $obj->updateMajor();
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('majors.index');
        } else {
            return Redirect::back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Major $major, Request $request)
    // {
    //     $obj = new Major();
    //     $obj->id = $request->id;
    //     $obj->destroyMajor();
    //     session()->flash('success', 'Đã xoá thành công!');
    //     return Redirect::route('majors.index');
    // }

    public function destroy($id)
    {
        // xoa ban ghi trong bang basic_fees ma co major_id do
        $basic_feesCount = \DB::table('basic_fees')->where('major_id', $id)->count();

        // kiem tra xem co ban ghi tham chieu ko
        if ($basic_feesCount > 0) {
            return redirect()->back()->with('error', 'Không thể xóa Chuyên ngành này vì vẫn còn Mức học phí tham chiếu đến nó.');
        }

        // Nếu không có bản ghi liên quan, tiến hành xóa
        Major::destroy($id);
        return redirect()->route('majors.index')->with('success', 'Đã xóa thành công!');
    }
}
