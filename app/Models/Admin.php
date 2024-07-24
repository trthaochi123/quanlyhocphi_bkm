<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    use Authenticatable;

    public function index(){
        $admins = DB::table('admins')
            ->get();
        return $admins;
    }
    public function store(){
        DB::table('admins')
            ->insert([
                'admin_name'=>$this->admin_name,
                'admin_phone'=>$this->admin_phone,
                'province'=>$this->province,
                'district'=>$this->district,
                'street'=>$this->street,
                'email'=>$this->email,
                'password'=>$this->password
            ]);
    }
    public function edit(){
        $admin = DB::table('admins')
            ->where('id',$this->id)
            ->get();
        return $admin;
    }
    public function updateAdmin(){
        DB::table('admins')
            ->where('id',$this->id)
            ->update([
                'admin_name'=>$this->admin_name,
                'admin_phone'=>$this->admin_phone,
                'province'=>$this->province,
                'district'=>$this->district,
                'street'=>$this->street,
                'email'=>$this->email,
            ]);
    }

    public function destroyAdmin(){
        DB::table('admins')
            ->where('id',$this->id)
            ->delete();
    }
}
