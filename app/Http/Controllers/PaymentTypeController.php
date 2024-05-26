<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Http\Requests\StorePaymentTypeRequest;
use App\Http\Requests\UpdatePaymentTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        return view('payment_types.index',[
            'payment_types'=>$payment_types
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
        $obj = new PaymentType();
        $obj->payment_type_name = $request->payment_type_name;
        $obj->discount = $request->discount;
        $obj->payment_times = $request->payment_times;
        $obj->store();
        return Redirect::route('payment_types.index');
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
        return view('payment_types.edit',[
            'id'=>$obj->id,
            'payments'=>$payment_type
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
        $obj = new PaymentType();
        $obj->id = $request->id;
        $obj->payment_type_name = $request->payment_type_name;
        $obj->discount = $request->discount;
        $obj->payment_times = $request->payment_times;
        $obj->updatePaymentType();
        return Redirect::route('payment_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentType $paymentType, Request $request)
    {
        $obj = new PaymentType();
        $obj->id = $request->id;
        $obj->destroyPaymentType();
        return Redirect::route('payment_types.index');
    }
}
