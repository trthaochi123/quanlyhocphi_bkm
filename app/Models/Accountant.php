<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Accountant extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    use Authenticatable;

    public function index(){
        $accountants = DB::table('accountants')
            ->get();
        return $accountants;
    }

    public function store(){
        DB::table('accountants')
            ->insert([
                'accountant_name'=>$this->accountant_name,
                'accountant_phone'=>$this->accountant_phone,
                'province'=>$this->province,
                'district'=>$this->district,
                'street'=>$this->street,
                'email'=>$this->email,
                'password'=>$this->password
            ]);
    }
    public function edit(){
        $accountant = DB::table('accountants')
            ->where('id',$this->id)
            ->get();
        return $accountant;
    }
    public function updateAccountant(){
        DB::table('accountants')
            ->where('id',$this->id)
            ->update([
                'accountant_name'=>$this->accountant_name,
                'accountant_phone'=>$this->accountant_phone,
                'province'=>$this->province,
                'district'=>$this->district,
                'street'=>$this->street,
                'email'=>$this->email,
                'password'=>$this->password
            ]);
    }
    public function destroyAccountant(){
        DB::table('accountants')
            ->where('id',$this->id)
            ->delete();
    }
}
