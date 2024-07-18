<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Accountant;
use App\Models\PaymentMethod;
use App\Models\Receipt;
use App\Http\Requests\StoreReceiptRequest;
use App\Http\Requests\UpdateReceiptRequest;
use App\Models\Blog;
use App\Models\PaymentType;
use App\Models\Student;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

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
        $obj2 = new StudyClass();
        $classes = $obj2->index();
        return view('receipts.index',[
            'receipts'=>$receipts,
            'classes'=>$classes
        ]);
    }
    public function classesList()
    {
        $obj = new StudyClass();
        $classes = $obj->index();
        return view('receipts.academics', [
            'classes' => $classes,
        ]);
    }

    public function classFilter(Request $request)
    {
        $obj = new StudyClass();
        $obj->academic_id = $request->id;
        $classes = $obj->classFilter();
        $obj2 = new AcademicYear();
        $obj2->id = $request->id;
        $academics = $obj2->edit();
        return view('receipts.classes', [
            'classes' => $classes,
            'academics' => $academics
        ]);
    }

    public function export(Request $request)
    {
        $obj = new Receipt();
        $obj->id = $request->id;
        $receipts = $obj->export();
        // hien thi view va truyen du lieu sang
        return view('receipts.export', [
            'receipts' => $receipts,
            'id' => $obj->id
        ]);
    }

    public function debt()
    {
        $obj = new Receipt();
        $receipts = $obj->debt();
        return view('receipts.debt', [
            'receipts' => $receipts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    // {
    //     $obj = new Receipt();
    //     $obj->id = $request->id;
    //     $student = $obj->create();
    //     $obj2 = new PaymentMethod();
    //     $paymentMethods = $obj2->index();
    //     $obj3 = new Accountant();
    //     $accountants = $obj3->index();
    //     $obj4 = new PaymentType();
    //     $paymentTypes = $obj4->index();
    //     return view('receipts.create', [
    //         'students' => $student,
    //         'paymentMethods' => $paymentMethods,
    //         'accountants' => $accountants,
    //         'paymentTypes'=>$paymentTypes
    //     ]);
    // }

    public function create(Request $request)
    {
        $obj = new Receipt();
        $obj->id = $request->id;
        $student = $obj->create();
        $obj2 = new PaymentMethod();
        $paymentMethods = $obj2->index();
        $obj3 = new Accountant();
        $accountants = $obj3->index();
        $obj4 = new PaymentType();
        $paymentTypes = $obj4->index();
        return view('receipts.create', [
            'students' => $student,
            'paymentMethods' => $paymentMethods,
            'accountants' => $accountants,
            'paymentTypes'=>$paymentTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreReceiptRequest $request)
    // {
    //     if ($request->validated()){
    //         $obj = new Receipt();
    //         $obj->student_id = $request->student_id;
    //         $obj->payment_method_id = $request->payment_method_id;
    //         $obj->accountant_id = $request->accountant_id;
    //         $obj->submitter_name = $request->submitter_name;
    //         $obj->submitter_phone = $request->submitter_phone;
    //         $obj->payment_date_time = $request->payment_date_time;
    //         $obj->amount_of_money = $request->amount_of_money;
    //         $obj->amount_owed = $request->amount_owed;
    //         $obj->note = $request->note;
    //         $obj->store();
    //         session()->flash('success', 'Đã tạo thành công!');
    //         $obj2 = Student::findOrFail($request->student_id);
    //         $obj2->debt = $request->debt;
    //         $obj2->tuition_status = $request->debt > 0 ? 0 : 1;
    //         $obj2->updateDebt();
    //         return Redirect::route('receipts.index');
    //     } else {
    //         return Redirect::back();
    //     }

    // }

    public function store(StoreReceiptRequest $request)
    {
        if ($request->validated()){
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

            $obj2 = Student::findOrFail($request->student_id);
            $obj2->debt = $request->debt;
            $obj2->times_paid = $request->times_paid;
            $obj2->updateDebt();
            return Redirect::route('receipts.index');
        } else {
            return Redirect::back();
        }

    }

    public function studentFilter(Request $request)
    {
        $obj = new Student();
        $obj->class_id = $request->id;
        $students = $obj->studentFilter();
        $obj2 = new StudyClass();
        $obj2->id = $request->id;
        $classes = $obj2->edit();
        $obj3 = new AcademicYear();
        $obj3->id = $request->id;
        $academics = $obj3->index();
        return view('receipts.students', [
            'students' => $students,
            'classes' => $classes,
            'academics' => $academics
        ]);
    }

    public function dashboard()
    {
        $blogs = DB::table('blogs')->paginate(1);
        $student = DB::table('students')->count();
        $admin = DB::table('admins')->count();
        $accountant = DB::table('accountants')->count();
        $total_revenue = DB::table('receipts')->sum('amount_of_money');
        $total_debt = DB::table('students')->sum('debt');
        $total_debt_quarter = DB::table('students')
            ->where('payment_type_id', '=', '13')
            ->sum('debt');
        $total_debt_semester = DB::table('students')
            ->where('payment_type_id', '=', '14')
            ->sum('debt');
        $total_debt_year = DB::table('students')
            ->where('payment_type_id', '=', '15')
            ->sum('debt');
        return view('receipts.dashboard', compact(
            'student',
            'admin',
            'accountant',
            'total_revenue',
            'total_debt',
            'total_debt_quarter',
            'total_debt_semester',
            'total_debt_year',
            'blogs'
        ));
    }

    public function showBlog($id)
    {
        $blog = Blog::find($id); // Lấy blog dựa trên ID
        return view('receipts.showblog', [
            'blog' => $blog,
            'id' => $id
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
