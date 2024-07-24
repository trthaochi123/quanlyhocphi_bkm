<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreStartRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = new Admin();
        $admins = $obj->index();
        return view('admins.index', [
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        if ($request->validated()) {
            $obj = new Admin();
            $obj->admin_phone = $request->admin_phone;
            $obj->admin_name = $request->admin_name;
            $obj->province = $request->province;
            $obj->district = $request->district;
            $obj->street = $request->street;
            $obj->email = $request->email;
            $obj->password = bcrypt($request->get('password'));
            $obj->store();
            session()->flash('success', 'Đã tạo thành công!');
            return Redirect::route('admins.index');
        } else {
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin, Request $request)
    {
        $obj = new Admin();
        $obj->id = $request->id;
        $admins = $obj->edit();
        return view('admins.edit', [
            'id' => $obj->id,
            'admins' => $admins
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        if ($request->validated()) {
            $obj = new Admin();
            $obj->id = $request->id;
            $obj->admin_phone = $request->admin_phone;
            $obj->admin_name = $request->admin_name;
            $obj->province = $request->province;
            $obj->district = $request->district;
            $obj->street = $request->street;
            $obj->email = $request->email;
            $obj->updateAdmin();
            session()->flash('success', 'Cập nhật thành công!');
            return Redirect::route('admins.index');
        } else Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin, Request $request)
    {
        $obj = new Admin();
        $obj->id = $request->id;
        $obj->destroyAdmin();
        session()->flash('success', 'Đã xoá thành công!');
        return Redirect::route('admins.index');
    }

    // public function loginAdmin(Request $request)
    // {

    //     $account = $request->only(['email', 'password']);

    //     if (Auth::guard('admins')->attempt($account)) {
    //         $admin = Auth::guard('admins')->user();
    //         Auth::guard('admins')->login($admin);
    //         session(['admin' => $admin]);
    //         return Redirect::route('dashboards.index');
    //     } else {
    //         return Redirect::back()->with('error', 'Thông tin đăng nhập không đúng!');
    //     }
    // }

    public function loginAdmin(StoreStartRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $account = $request->only('email', 'password');

            if (Auth::guard('admins')->attempt($account)) {
                $admin = Auth::guard('admins')->user();
                Auth::guard('admins')->login($admin);
                session(['admin' => $admin]);
                return redirect()->route('dashboards.index');
            } else {
                return back()->withErrors('Thông tin đăng nhập không chính xác.');
            }
        } else {
            return back()->withErrors($request->errors())->withInput();
        }
    }

    public function logoutAdmin()
    {
        Auth::guard('admins')->logout();
        session()->forget('admin');
        return Redirect::route('start.index');
    }
}
