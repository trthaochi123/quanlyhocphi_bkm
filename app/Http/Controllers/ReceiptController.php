<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Accountant;
use App\Models\PaymentMethod;
use App\Models\Receipt;
use App\Http\Requests\StoreReceiptRequest;
use App\Http\Requests\UpdateReceiptRequest;
use App\Models\Student;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new Receipt();
        $receipts = $obj->index();
        return view('receipts.index',[
            'receipts'=>$receipts
        ]);
    }
    public function classesList(){
        $obj = new StudyClass();
        $classes = $obj->index();
        return view('receipts.academics',[
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
        return view('receipts.classes',[
            'classes'=>$classes,
            'academics'=>$academics
        ]);
    }

    public function export(Request $request){
        $obj = new Receipt();
        $obj->id = $request->id;
        $receipts = $obj->export();
        // hien thi view va truyen du lieu sang
        return view('receipts.export', [
            'receipts'=>$receipts,
            'id'=>$obj->id
        ]);
    }

    public function debt(){
        $obj = new Receipt();
        $receipts = $obj->debt();
        return view('receipts.debt',[
            'receipts'=>$receipts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $obj = new Receipt();
        $obj->id = $request->id;
        $student = $obj->create();
        $obj2 = new PaymentMethod();
        $paymentMethods = $obj2->index();
        $obj3 = new Accountant();
        $accountants = $obj3->index();
        return view('receipts.create',[
            'students'=>$student,
            'paymentMethods'=>$paymentMethods,
            'accountants'=>$accountants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceiptRequest $request)
    {
        $obj = new Receipt();
        $obj->student_id = $request->student_id;
        $obj->payment_method_id = $request->payment_method_id;
        $obj->accountant_id = $request->accountant_id;
        $obj->submitter_name = $request->submitter_name;
        $obj->submitter_phone = $request->submitter_phone;
        $obj->payment_date_time = $request->payment_date_time;
        $obj->amount_of_money = $request->amount_of_money;
        $obj->amount_owed = $request->amount_owed;
        $obj->note = $request->note;
        $obj->store();
        return Redirect::route('receipts.index');

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
        return view('receipts.students',[
            'students'=>$students,
            'classes'=>$classes,
            'academics'=>$academics
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReceiptRequest  $request
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
