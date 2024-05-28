<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\BasicFee;
use App\Models\PaymentType;
use App\Models\Scholarship;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new Student();
        $students = $obj->index();
        return view('students.index',[
            'students'=>$students
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request)
    {
        $obj1 = new StudyClass();
        $obj1->id = $request->class_id;
        $classes = $obj1->edit();
        $obj2 = new Scholarship();
        $scholarships = $obj2->index();
        $obj3 = new PaymentType();
        $payment_types = $obj3->index();
        $obj4 = new BasicFee();
        $basic_fees = $obj4->index();
        return view('students.create',[
            'classes'=>$classes,
            'scholarships'=>$scholarships,
            'payment_types'=>$payment_types,
            'basic_fees'=>$basic_fees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $obj = new Student();
        $obj->student_name = $request->student_name;
        $obj->student_dob = $request->student_dob;
        $obj->student_phone = $request->student_phone;
        $obj->student_parent_phone = $request->student_parent_phone;
        $obj->province = $request->province;
        $obj->district = $request->district;
        $obj->street = $request->street;
        $obj->class_id = $request->class_id;
        $obj->scholarship_id = $request->scholarship_id;
        $obj->payment_type_id = $request->payment_type_id;
        $obj->total_fee = $request->total_fee;
        $obj->amount_each_time = $request->amount_each_time;
        $obj->tuition_status = $request->tuition_status;
        $obj->debt = $request->debt;
        $obj->store();
        return Redirect::route('students.studentFilter',[
                'id'=>$obj->class_id
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, Request $request)
    {
        $obj1 = new StudyClass();
        $classes = $obj1->index();
        $obj2 = new Scholarship();
        $scholarships = $obj2->index();
        $obj3 = new PaymentType();
        $payment_types = $obj3->index();
        $obj4 = new BasicFee();
        $basic_fees = $obj4->index();

        $obj4 = new Student();
        $obj4->id = $request->id;
        $students = $obj4->edit();
        return view('students.edit',[
            'classes'=>$classes,
            'scholarships'=>$scholarships,
            'payment_types'=>$payment_types,
            'basic_fees'=>$basic_fees,
            'students'=>$students,
            'id'=>$obj4->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $obj = new Student();
        $obj->id = $request->id;
        $obj->student_name = $request->student_name;
        $obj->student_dob = $request->student_dob;
        $obj->student_phone = $request->student_phone;
        $obj->student_parent_phone = $request->student_parent_phone;
        $obj->province = $request->province;
        $obj->district = $request->district;
        $obj->street = $request->street;
        $obj->total_fee = $request->total_fee;
        $obj->amount_each_time = $request->amount_each_time;
        $obj->class_id = $request->class_id;
        $obj->scholarship_id = $request->scholarship_id;
        $obj->payment_type_id = $request->payment_type_id;
        $obj->tuition_status = $request->tuition_status;
        $obj->debt = $request->debt;
        $obj->updateStudent();
        return Redirect::route('students.studentFilter',[
            'id'=>$obj->class_id
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student, Request $request)
    {
        $obj = new Student();
        $obj->id = $request->id;
        $obj->destroyStudent();
        $class_id = $request->class_id;
        return Redirect::route('students.studentFilter',[
            'id'=>$class_id
        ]);
    }
    public function debtByQuarter(){
        $obj = new Student();
        $studentByQuarters = $obj->debtByQuarter();
        return view('debts.debtByQuarter',[
            'studentByQuarters'=>$studentByQuarters
        ]);
    }
    public function debtBySemester(){
        $obj = new Student();
        $studentBySemesters = $obj->debtBySemester();
        return view('debts.debtBySemester',[
            'studentBySemesters'=>$studentBySemesters
        ]);
    }
    public function debtByYear(){
        $obj = new Student();
        $studentByYears = $obj->debtByYear();
        return view('debts.debtByYear',[
            'studentByYears'=>$studentByYears
        ]);
    }
    public function studentFilter(Request $request){
        $obj = new Student();
        $obj->class_id = $request->id;
        $students = $obj->studentFilter();
        $obj2 = new StudyClass();
        $obj2->id = $request->id;
        $classes = $obj2->edit();
        $obj3 = new AcademicYear();
        $obj3->id = $request->id;
        $academics = $obj3->index();
        return view('students.index',[
            'students'=>$students,
            'classes'=>$classes,
            'academics'=>$academics
        ]);
    }

    public function classesList(){
        $obj = new StudyClass();
        $classes = $obj->index();
        return view('students.academics',[
            'classes'=>$classes,
        ]);
    }
    public function classFilter(Request $request){
        $obj = new StudyClass();
        $obj->academic_id = $request->id;
        $classes = $obj->classFilter();
        $obj2 = new AcademicYear();
        $obj2->id = $request->id;
        $academics = $obj2->edit();
        return view('students.classes',[
            'classes'=>$classes,
            'academics'=>$academics
        ]);
    }

}
