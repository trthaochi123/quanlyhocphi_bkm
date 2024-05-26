<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AcademicYear extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function index(){
        $academic = DB::table('academic_years')
            ->get();
        return $academic;
    }
    public function store(){
        DB::table('academic_years')
            ->insert([
                'academic_start_year'=>$this->academic_start_year,
                'academic_end_year'=>$this->academic_end_year,
                'academic_name'=>$this->academic_name
            ]);
    }
    public function edit(){
        $academic = DB::table('academic_years')
            ->where('id', $this->id)
            ->get();
        return $academic;
    }
    public function updateAcademic(){
        DB::table('academic_years')
            ->where('id',$this->id)
            ->update([
                'academic_start_year' => $this->academic_start_year,
                'academic_end_year' => $this->academic_end_year,
                'academic_name' => $this->academic_name
            ]);
    }
    public function destroyAcademic(){
        DB::table('academic_years')
            ->where('id',$this->id)
            ->delete();
    }
}
