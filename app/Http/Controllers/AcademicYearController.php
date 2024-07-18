<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Http\Requests\StoreAcademicYearRequest;
use App\Http\Requests\UpdateAcademicYearRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


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
        return view('academic_years.index', [
            'academics' => $academics
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
        $validated = $request->validated();
        $startYear = date('Y', strtotime($validated['academic_start_year']));
        $endYear = date('Y', strtotime($validated['academic_end_year']));

        $existsValidator = Validator::make($validated, [
            'academic_start_year' => [
                'required',
                function ($attribute, $value, $fail) use ($startYear, $endYear) {
                    if (AcademicYear::whereYear('academic_start_year', $startYear)
                        ->whereYear('academic_end_year', $endYear)
                        ->exists()) {
                        $fail('Niên khóa với năm bắt đầu và kết thúc này đã tồn tại.');
                    }
                },
            ],
        ]);
        if ($existsValidator->fails()) {
            // Nếu validation thất bại, trả về với thông báo lỗi
            return redirect()->back()->withErrors($existsValidator)->withInput();
        }

        if ($request->validated()) {
            $obj = new AcademicYear();
            $obj->academic_start_year = $request->academic_start_year;
            $obj->academic_end_year = $request->academic_end_year;
            $obj->academic_name = $request->academic_name;
            $obj->store();
            session()->flash('success', 'Đã tạo thành công!');
            return Redirect::route('academics.index');
        } else {
            return Redirect::back();
        }
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
        return view('academic_years.edit', [
            'academics' => $academic,
            'id' => $obj->id
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
        if ($request->validated()){
            $obj = new AcademicYear();
            $obj->id = $request->id;
            $obj->academic_start_year = $request->academic_start_year;
            $obj->academic_end_year = $request->academic_end_year;
            $obj->academic_name = $request->academic_name;
            $obj->updateAcademic();
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('academics.index');
        } else {
            return Redirect::back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    // public function destroy(AcademicYear $academicYear, Request $request)
    // {
    //     $obj = new AcademicYear();
    //     $obj->id = $request->id;
    //     $obj->destroyAcademic();
    //     session()->flash('success', 'Đã xoá thành công!');
    //     return Redirect::route('academics.index');
    // }

    public function destroy($id)
    {
        // Trước khi xóa, kiểm tra xem có bản ghi nào trong study_classes không
        $studyClassesCount = \DB::table('study_classes')->where('academic_id', $id)->count();

        if ($studyClassesCount > 0) {
            return redirect()->back()->with('error', 'Không thể xóa Niên khóa này vì vẫn còn Lớp học tham chiếu đến nó.');
        }

        // Nếu không có bản ghi liên quan, tiến hành xóa
        AcademicYear::destroy($id);
        return redirect()->route('academic_years.index')->with('success', 'Đã xóa thành công!');
    }

    public function newFunction()
    {
    }
}
