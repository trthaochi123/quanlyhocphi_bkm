<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Http\Requests\StorePaymentTypeRequest;
use App\Http\Requests\UpdatePaymentTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new PaymentType();
        $payment_types = $obj->index();
        return view('payment_types.index', [
            'payment_types' => $payment_types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentTypeRequest $request)
    {
        $validatedData = $request->validated();

        // Kiểm tra trùng lặp class_name
        $existsValidator = Validator::make($validatedData, [
            'payment_type_name' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (PaymentType::where('payment_type_name', $value)->exists()) {
                        $fail('Kiểu đóng đã tồn tại.');
                    }
                },
            ],
        ]);

        if ($existsValidator->fails()) {
            // Nếu validation thất bại, trả về với thông báo lỗi
            return redirect()->back()->withErrors($existsValidator)->withInput();
        }

        if ($request->validated()) {
            $obj = new PaymentType();
            $obj->payment_type_name = $request->payment_type_name;
            $obj->discount = $request->discount;
            $obj->payment_times = $request->payment_times;
            $obj->store();
            session()->flash('success', 'Đã tạo thành công!');
            return Redirect::route('payment_types.index');
        } else {
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentType $paymentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentType $paymentType, Request $request)
    {
        $obj = new PaymentType();
        $obj->id = $request->id;
        $payment_type = $obj->edit();
        return view('payment_types.edit', [
            'id' => $obj->id,
            'payments' => $payment_type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentTypeRequest  $request
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentTypeRequest $request, PaymentType $paymentType)
    {
        if ($request->validated()){
            $obj = new PaymentType();
            $obj->id = $request->id;
            $obj->payment_type_name = $request->payment_type_name;
            $obj->discount = $request->discount;
            $obj->payment_times = $request->payment_times;
            $obj->updatePaymentType();
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('payment_types.index');
        } else {
            return Redirect::back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    // public function destroy(PaymentType $paymentType, Request $request)
    // {
    //     $obj = new PaymentType();
    //     $obj->id = $request->id;
    //     $obj->destroyPaymentType();
    //     session()->flash('success', 'Đã xoá thành công!');
    //     return Redirect::route('payment_types.index');
    // }

    public function destroy($id){
         // Trước khi xóa, kiểm tra xem có bản ghi nào trong students không
         $studentsCount = \DB::table('students')->where('payment_type_id', $id)->count();

         if ($studentsCount > 0) {
             return redirect()->back()->with('error', 'Không thể xóa kiểu thanh toán này vì vẫn còn bản ghi sinh viên tham chiếu đến nó');
         }

         // Nếu không có bản ghi liên quan, tiến hành xóa
         PaymentType::destroy($id);
         return redirect()->route('payment_types.index')->with('success', 'Kiểu đóng đã được xóa thành công!');
    }
}
