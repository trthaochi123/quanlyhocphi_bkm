<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        return view('payment_methods.index',[
            'payment_methods'=>$payment_methods
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
        $obj = new PaymentMethod();
        $obj->name= $request->name;
        $obj->store();
        return Redirect::route('payment_methods.index');
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
        return view('payment_methods.edit',[
            'id'=>$obj->id,
            'payments'=>$payment
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
        $obj = new PaymentMethod();
        $obj->id = $request->id;
        $obj->name = $request->name;
        $obj->updatePayMethod();
        return Redirect::route('payment_methods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod, Request $request)
    {
        $obj = new PaymentMethod();
        $obj->id = $request->id;
        $obj->destroyPaymentMethod();
        return Redirect::route('payment_methods.index');
    }
}
