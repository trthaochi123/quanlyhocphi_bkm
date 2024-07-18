<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new PaymentMethod();
        $payment_methods = $obj->index();
        return view('payment_methods.index', [
            'payment_methods' => $payment_methods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentMethodRequest $request)
    {
        $validatedData = $request->validated();

        // Kiểm tra trùng lặp class_name
        $existsValidator = Validator::make($validatedData, [
            'name' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (PaymentMethod::where('name', $value)->exists()) {
                        $fail('Phương thức thanh toán này đã tồn tại.');
                    }
                },
            ],
        ]);

        if ($existsValidator->fails()) {
            // Nếu validation thất bại, trả về với thông báo lỗi
            return redirect()->back()->withErrors($existsValidator)->withInput();
        }

        if ($request->validated()) {
            $obj = new PaymentMethod();
            $obj->name = $request->name;
            $obj->store();
            session()->flash('success', 'Tạo mới thành công!');
            return Redirect::route('payment_methods.index');
        } else {
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod, Request $request)
    {
        $obj = new PaymentMethod();
        $obj->id = $request->id;
        $payment = $obj->edit();
        return view('payment_methods.edit', [
            'id' => $obj->id,
            'payments' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentMethodRequest  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        if ($request->validated()){
            $obj = new PaymentMethod();
            $obj->id = $request->id;
            $obj->name = $request->name;
            $obj->updatePayMethod();
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('payment_methods.index');
        } else return Redirect::back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    // public function destroy(PaymentMethod $paymentMethod, Request $request)
    // {
    //     $obj = new PaymentMethod();
    //     $obj->id = $request->id;
    //     $obj->destroyPaymentMethod();
    //     session()->flash('success', 'Đã xoá thành công!');
    //     return Redirect::route('payment_methods.index');
    // }

    public function destroy($id)
    {
        $receiptsCount = \DB::table('receipts')->where('payment_method_id', $id)->count();

        // kiem tra xem co ban ghi tham chieu ko
        if ($receiptsCount > 0) {
            return redirect()->back()->with('error', 'Không thể xóa phương thức thanh toán này vì vẫn còn Phiếu thu tham chiếu đến nó.');
        }

        // Nếu không có bản ghi liên quan, tiến hành xóa
        PaymentMethod::destroy($id);
        return redirect()->route('payment_methods.index')->with('success', 'Đã xóa thành công!');
    }
}
