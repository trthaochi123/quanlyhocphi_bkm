<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function index(){
        $students = DB::table('students')
            ->join('study_classes','students.class_id','=','study_classes.id')
            ->join('scholarships','students.scholarship_id','=','scholarships.id')
            ->join('payment_types','students.payment_type_id','=','payment_types.id')
            ->select([
                'students.*',
                'study_classes.class_name AS className',
                'scholarships.scholarship_amount AS scholarship',
                'payment_types.payment_type_name AS paymentTypeName'
            ])
            ->get();
        return $students;
    }
    public function store(){
        DB::table('students')
            ->insert([
                'student_name'=>$this->student_name,
                'student_dob'=>$this->student_dob,
                'student_phone'=>$this->student_phone,
                'student_parent_phone'=>$this->student_parent_phone,
                'province'=>$this->province,
                'district'=>$this->district,
                'street'=>$this->street,
                'total_fee'=>$this->total_fee,
                'amount_each_time'=>$this->amount_each_time,
                'class_id'=>$this->class_id,
                'scholarship_id'=>$this->scholarship_id,
                'payment_type_id'=>$this->payment_type_id,
                'tuition_status'=>$this->tuition_status,
                'debt'=>$this->debt
            ]);
    }

    public function edit(){
        $student = DB::table('students')
            ->where('id', $this->id)
            ->get();
        return $student;
    }
    public function updateStudent(){
        DB::table('students')
            ->where('id',$this->id)
            ->update([
                'student_name'=>$this->student_name,
                'student_dob'=>$this->student_dob,
                'student_phone'=>$this->student_phone,
                'student_parent_phone'=>$this->student_parent_phone,
                'province'=>$this->province,
                'district'=>$this->district,
                'street'=>$this->street,
                'total_fee'=>$this->total_fee,
                'amount_each_time'=>$this->amount_each_time,
                'class_id'=>$this->class_id,
                'scholarship_id'=>$this->scholarship_id,
                'payment_type_id'=>$this->payment_type_id,
                'payment_type_id'=>$this->payment_type_id,
                'tuition_status'=>$this->tuition_status,
                'debt'=>$this->debt
            ]);
    }
    public function destroyStudent(){
        DB::table('students')
            ->where('id',$this->id)
            ->delete();
    }
    public function debtByMonth(){
        $student = DB::table('students')
            ->join('study_classes','students.class_id','=','study_classes.id')
            ->join('scholarships','students.scholarship_id','=','scholarships.id')
            ->select([
                'students.*',
                'study_classes.class_name AS className',
                'scholarships.scholarship_amount AS scholarship',
            ])
            ->where('payment_type_id','=','12')
            ->where('tuition_status','=','0')
            ->get();
        return $student;
    }
    public function debtByQuarter(){
        $student = DB::table('students')
            ->join('study_classes','students.class_id','=','study_classes.id')
            ->join('scholarships','students.scholarship_id','=','scholarships.id')
            ->select([
                'students.*',
                'study_classes.class_name AS className',
                'scholarships.scholarship_amount AS scholarship',
            ])
            ->where('payment_type_id','=','13')
            ->where('tuition_status','=','0')
            ->get();
        return $student;
    }
    public function debtBySemester(){
        $student = DB::table('students')
            ->join('study_classes','students.class_id','=','study_classes.id')
            ->join('scholarships','students.scholarship_id','=','scholarships.id')
            ->select([
                'students.*',
                'study_classes.class_name AS className',
                'scholarships.scholarship_amount AS scholarship',
            ])
            ->where('payment_type_id','=','14')
            ->where('tuition_status','=','0')
            ->get();
        return $student;
    }
    public function debtByYear(){
        $student = DB::table('students')
            ->join('study_classes','students.class_id','=','study_classes.id')
            ->join('scholarships','students.scholarship_id','=','scholarships.id')
            ->select([
                'students.*',
                'study_classes.class_name AS className',
                'scholarships.scholarship_amount AS scholarship',
            ])
            ->where('payment_type_id','=','15')
            ->where('tuition_status','=','0')
            ->get();
        return $student;
    }

    public function studentFilter(){
        $students = DB::table('students')
            ->join('study_classes','students.class_id','=','study_classes.id')
            ->join('scholarships','students.scholarship_id','=','scholarships.id')
            ->join('payment_types','students.payment_type_id','=','payment_types.id')
            ->select([
                'students.*',
                'study_classes.class_name AS className',
                'scholarships.scholarship_amount AS scholarship',
                'payment_types.payment_type_name AS paymentTypeName'
            ])
            ->where('class_id','=',$this->class_id)
            ->get();
        return $students;
    }


}
