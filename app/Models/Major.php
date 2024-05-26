<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Major extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function index(){
        $majors = DB::table('majors')
            ->get();
        return $majors;
    }
    public function store(){
        DB::table('majors')
            ->insert([
                'name'=>$this->name
            ]);
    }
    public function edit(){
        $major = DB::table('majors')
            ->where('id', $this->id)
            ->get();
        return $major;
    }
    public function updateMajor(){
        DB::table('majors')
            ->where('id',$this->id)
            ->update([
                'name'=>$this->name
            ]);
    }
    public function destroyMajor(){
        DB::table('majors')
            ->where('id',$this->id)
            ->delete();
    }
}
