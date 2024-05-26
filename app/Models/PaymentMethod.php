<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentMethod extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function index(){
        $payment_methods = DB::table('payment_methods')
            ->get();
        return $payment_methods;
    }
    public function store(){
        DB::table('payment_methods')
            ->insert([
                'name'=>$this->name
            ]);
    }

    public function edit(){
        $payment = DB::table('payment_methods')
            ->where('id',$this->id)
            ->get();
        return $payment;
    }
    public function updatePayMethod(){
        DB::table('payment_methods')
            ->where('id',$this->id)
            ->update([
                'name' => $this->name,

            ]);
    }
    public function destroyPaymentMethod(){
        DB::table('payment_methods')
            ->where('id',$this->id)
            ->delete();
    }
}
