<?php

namespace App\Http\Controllers;

use App\Models\Accountant;
use App\Http\Requests\StoreAccountantRequest;
use App\Http\Requests\UpdateAccountantRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AccountantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new Accountant();
        $accountants = $obj->index();
        return view('accountants.index',[
            'accountants'=>$accountants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accountants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountantRequest $request)
    {
        $obj = new Accountant();
        $obj->accountant_phone = $request->accountant_phone;
        $obj->accountant_name = $request->accountant_name;
        $obj->province = $request->province;
        $obj->district = $request->district;
        $obj->street = $request->street;
        $obj->email= $request->email;
        $obj->password = bcrypt($request->get('password'));
        $obj->store();
        return Redirect::route('accountants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function show(Accountant $accountant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function edit(Accountant $accountant, Request $request)
    {
        $obj = new Accountant();
        $obj->id = $request->id;
        $accountant = $obj->edit();
        return view('accountants.edit',[
            'accountant'=>$accountant,
            'id'=>$obj->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountantRequest  $request
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountantRequest $request, Accountant $accountant)
    {
        $obj = new Accountant();
        $obj->id = $request->id;
        $obj->accountant_phone = $request->accountant_phone;
        $obj->accountant_name = $request->accountant_name;
        $obj->province = $request->province;
        $obj->district = $request->district;
        $obj->street = $request->street;
        $obj->email = $request->email;
        $obj->password = bcrypt($request->get('password'));
        $obj->updateAccountant();
        return Redirect::route('accountants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accountant $accountant, Request $request)
    {
        $obj = new Accountant();
        $obj->id = $request->id;
        $obj->destroyAccountant();
        return Redirect::route('accountants.index');
    }

    public function loginAccountant(Request $request){
        $account = $request->only(['email','password']);
        if(Auth::guard('accountants')->attempt($account)){
            $accountant = Auth::guard('accountants')->user();
            Auth::guard('accountants')->login($accountant);
            session(['accountant'=>$accountant]);
            return Redirect::route('receipts.index');
        }else{
            return Redirect::back();
        }
    }

    public function logoutAccountant(){
        Auth::guard('accountants')->logout();
        session()->forget('accountant');
        return Redirect::route('start.index');
    }

}
