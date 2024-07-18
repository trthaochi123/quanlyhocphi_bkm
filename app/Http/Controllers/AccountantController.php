<?php

namespace App\Http\Controllers;

use App\Models\Accountant;
use App\Http\Requests\StoreAccountantRequest;
use App\Http\Requests\StoreStartRequest;
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
        return view('accountants.index', [
            'accountants' => $accountants
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
        if ($request->validated()) {
            $obj = new Accountant();
            $obj->accountant_phone = $request->accountant_phone;
            $obj->accountant_name = $request->accountant_name;
            $obj->province = $request->province;
            $obj->district = $request->district;
            $obj->street = $request->street;
            $obj->email = $request->email;
            $obj->password = bcrypt($request->get('password'));
            $obj->store();
            session()->flash('success', 'Đã tạo thành công!');
            return Redirect::route('accountants.index');
        } else {
            return Redirect::back();
        }
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
        return view('accountants.edit', [
            'accountant' => $accountant,
            'id' => $obj->id
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
        if ($request->validated()) {
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
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('accountants.index');
        } else return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $receiptsCount = \DB::table('receipts')->where('accountant_id', $id)->count();

        // kiem tra xem co ban ghi tham chieu ko
        if ($receiptsCount > 0) {
            return redirect()->back()->with('error', 'Không thể xóa phương thức thanh toán này vì vẫn còn Phiếu thu tham chiếu đến nó.');
        }

        // Nếu không có bản ghi liên quan, tiến hành xóa
        Accountant::destroy($id);
        return redirect()->route('accountants.index')->with('success', 'Đã xóa thành công!');
    }



    // public function loginAccountant(StoreStartRequest $request)
    // {
    //     $validated = $request->validated();

    //     if ($validated) {
    //         $account = $request->only('email', 'password');

    //         if (Auth::guard('accountants')->attempt($account)) {
    //             $accountant = Auth::guard('accountants')->user();
    //             Auth::guard('accountants')->login($accountant);
    //             session(['accountants' => $accountant]);
    //             return Redirect::route('receipts.index');
    //         } else {
    //             return back()->withErrors('Thông tin đăng nhập không chính xác.');
    //         }
    //     } else {
    //         return back()->withErrors($request->errors())->withInput();
    //     }
    // }

    public function loginAccountant(StoreStartRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $account = $request->only(['email', 'password']);
            if (Auth::guard('accountants')->attempt($account)) {
                $accountant = Auth::guard('accountants')->user();
                Auth::guard('accountants')->login($accountant);
                session(['accountant' => $accountant]);
                return Redirect::route('receipts.dashboard');
            } else {
                return Redirect::back()->withErrors('Thông tin đăng nhập không chính xác.');
            }
        } else {
                return back()->withErrors($request->errors())->withInput();
        }
    }

    public function logoutAccountant()
    {
        Auth::guard('accountants')->logout();
        session()->forget('accountant');
        return Redirect::route('start.index');
    }
}
