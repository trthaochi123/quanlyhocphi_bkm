<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentType extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function index(){
        $payment_types = DB::table('payment_types')
            ->get();
        return $payment_types;
    }
    public function store(){
        DB::table('payment_types')
            ->insert([
                'payment_type_name'=>$this->payment_type_name,
                'discount'=>$this->discount,
                'payment_times'=>$this->payment_times
            ]);
    }

    public function edit(){
        $payment = DB::table('payment_types')
            ->where('id',$this->id)
            ->get();
        return $payment;
    }
    public function updatePaymentType(){
        DB::table('payment_types')
            ->where('id',$this->id)
            ->update([
                'payment_type_name' => $this->payment_type_name,
                'discount'=>$this->discount,
                'payment_times'=>$this->payment_times
            ]);
    }
    public function destroyPaymentType(){
        DB::table('payment_types')
            ->where('id',$this->id)
            ->delete();
    }
}
