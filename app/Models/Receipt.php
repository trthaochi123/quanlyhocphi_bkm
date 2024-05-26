<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Receipt extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function index(){
        $receipts = DB::table('receipts')
            ->join('students','receipts.student_id','=','students.id')
            ->join('payment_methods','receipts.payment_method_id','=','payment_methods.id')
            ->join('accountants','receipts.accountant_id','=','accountants.id')
            ->select([
                'receipts.*',
                'students.student_name AS studentName',
                'payment_methods.name AS methodName',
                'accountants.accountant_name AS accountantName'
            ])
            ->get();
        return $receipts;
    }

    public function export(){
        $receipts = DB::table('receipts')
        ->join('students','receipts.student_id','=','students.id')
        ->join('payment_methods','receipts.payment_method_id','=','payment_methods.id')
        ->join('accountants','receipts.accountant_id','=','accountants.id')
        ->select([
            'receipts.*',
            'students.student_name AS studentName',
            'students.student_phone AS studentPhone',
            'students.province AS studentProvince',
            'students.district AS studentDistrict',
            'students.street AS studentStreet',
            'payment_methods.name AS methodName',
            'accountants.accountant_name AS accountantName'
        ])
        ->where('receipts.id',$this->id)
        ->get();
        return $receipts;
    }

    public function debt(){
        $receipts = DB::table('receipts')
            ->join('students','receipts.student_id','=','students.id')
            ->join('payment_methods','receipts.payment_method_id','=','payment_methods.id')
            ->join('accountants','receipts.accountant_id','=','accountants.id')
            ->select([
                'receipts.*',
                'students.student_name AS studentName',
                'payment_methods.name AS methodName',
                'accountants.accountant_name AS accountantName'
            ])
            ->where('amount_owed','>','0')
            ->get();
        return $receipts;
    }
    public function create(){
        $student = DB::table('students')
            ->where('id',$this->id)
            ->get();
        return $student;
    }
    public function store(){
        DB::table('receipts')
            ->insert([
                'student_id'=>$this->student_id,
                'payment_method_id'=>$this->payment_method_id,
                'accountant_id'=>$this->accountant_id,
                'submitter_name'=>$this->submitter_name,
                'submitter_phone'=>$this->submitter_phone,
                'payment_date_time'=>$this->payment_date_time,
                'amount_of_money'=>$this->amount_of_money,
                'amount_owed'=>$this->amount_owed,
                'note'=>$this->note
            ]);


    }
}
