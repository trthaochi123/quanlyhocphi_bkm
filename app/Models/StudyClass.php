<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudyClass extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function index(){
        $study_classes = DB::table('study_classes')
            ->join('academic_years','study_classes.academic_id','=','academic_years.id')
            ->join('majors','study_classes.major_id','=','majors.id')
            ->select([
                'study_classes.*',
                'academic_years.academic_name AS academicName',
                'majors.name AS majorName'
            ])
            ->get();
        return $study_classes;
    }
    public function store(){
        DB::table('study_classes')
            ->insert([
                'class_name'=>$this->class_name,
                'major_id'=>$this->major_id,
                'academic_id'=>$this->academic_id
            ]);
    }
    public function edit(){
        $classes = DB::table('study_classes')
            ->where('id',$this->id)
            ->get();
        return $classes;
    }
    public function updateClass(){
        DB::table('study_classes')
            ->where('id',$this->id)
            ->update([
                'class_name'=>$this->class_name,
                'major_id'=>$this->major_id,
                'academic_id'=>$this->academic_id
            ]);
    }
    public function destroyClass(){
        DB::table('study_classes')
            ->where('id', $this->id)
            ->delete();
    }
    public function classFilter(){
        $classes = DB::table('study_classes')
            ->join('academic_years','study_classes.academic_id','=','academic_years.id')
            ->select([
                'study_classes.*',
                'academic_years.academic_name AS academicName',
            ])
            ->where('academic_id','=',$this->academic_id)
            ->get();
        return $classes;
    }
}
