<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Scholarship extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function index(){
        $scholarship = DB::table('scholarships')
            ->get();
        return $scholarship;
    }
    public function store(){
        DB::table('scholarships')
            ->insert([
                'scholarship_amount'=>$this->scholarship_amount,
            ]);
    }

    public function edit(){
        $scholarship = DB::table('scholarships')
            ->where('id', $this->id)
            ->get();
        return $scholarship;
    }

    public function updateScholarship(){
        DB::table('scholarships')
            ->where('id',$this->id)
            ->update([
                'scholarship_amount' => $this->scholarship_amount,
            ]);
    }
    public function destroyScholarship(){
        DB::table('scholarships')
            ->where('id',$this->id)
            ->delete();
    }
}
