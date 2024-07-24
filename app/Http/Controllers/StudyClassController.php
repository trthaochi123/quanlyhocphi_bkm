<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Major;
use App\Models\StudyClass;
use App\Http\Requests\StoreStudyClassRequest;
use App\Http\Requests\UpdateStudyClassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        $validatedData = $request->validated();

        // Kiểm tra trùng lặp class_name
        $existsValidator = Validator::make($validatedData, [
            'class_name' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (StudyClass::where('class_name', $value)->exists()) {
                        $fail('Lớp học với tên này đã tồn tại.');
                    }
                },
            ],
        ]);

        if ($existsValidator->fails()) {
            // Nếu validation thất bại, trả về với thông báo lỗi
            return redirect()->back()->withErrors($existsValidator)->withInput();
        }


        if ($request->validated()){
            $obj = new StudyClass();
            $obj->class_name = $request->class_name;
            $obj->major_id = $request->major_id;
            $obj->academic_id = $request->academic_id;
            $obj->store();
            session()->flash('success', 'Đã tạo thành công!');
            return Redirect::route('study_classes.index');
        } else {
            return Redirect::back();
        }

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
        $validatedData = $request->validated();

        // Kiểm tra trùng lặp class_name
        $existsValidator = Validator::make($validatedData, [
            'class_name' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (StudyClass::where('class_name', $value)->exists()) {
                        $fail('Lớp học với tên này đã tồn tại.');
                    }
                },
            ],
        ]);

        if ($existsValidator->fails()) {
            // Nếu validation thất bại, trả về với thông báo lỗi
            return redirect()->back()->withErrors($existsValidator)->withInput();
        }
        
        if ($request->validated()){
            $obj = new StudyClass();
            $obj->id = $request->id;
            $obj->class_name = $request->class_name;
            $obj->major_id = $request->major_id;
            $obj->academic_id = $request->academic_id;
            $obj->updateClass();
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('study_classes.index');
        } else {
            return Redirect::back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudyClass  $studyClass
     * @return \Illuminate\Http\Response
     */
    // public function destroy(StudyClass $studyClass, Request $request)
    // {
    //     $obj = new StudyClass();
    //     $obj->id = $request->id;
    //     $obj->destroyClass();
    //     session()->flash('success', 'Đã xoá thành công!');
    //     return Redirect::route('study_classes.index');
    // }

    public function destroy($id)
    {
        $studentsCount = \DB::table('students')->where('class_id', $id)->count();

        // kiem tra xem co ban ghi tham chieu ko trong bảng students ko
        if ($studentsCount > 0) {
            return redirect()->back()->with('error', 'Không thể xóa Lớp học này vì vẫn còn Sinh viên tham chiếu đến nó.');
        }

        // Nếu không có bản ghi liên quan, tiến hành xóa
        StudyClass::destroy($id);
        return redirect()->route('study_classes.index')->with('success', 'Đã xóa thành công!');
    }

}
