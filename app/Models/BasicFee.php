<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BasicFee extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $fillable = ['major_id', 'academic_id', 'basic_fee_amount'];

    public function index(){
        $basic_fees = DB::table('basic_fees')
            ->join('majors','basic_fees.major_id','=','majors.id')
            ->join('academic_years','basic_fees.academic_id','=','academic_years.id')
            ->select([
                'basic_fees.*',
                'majors.name AS majorName',
                'academic_years.academic_name AS academicName'
            ])
            ->get();
        return $basic_fees;
    }

    public function store(){
        DB::table('basic_fees')
            ->insert([
                'major_id'=>$this->major_id,
                'academic_id'=>$this->academic_id,
                'basic_fee_amount'=>$this->basic_fee_amount
            ]);
    }


    public function edit(){
        $basic_fees = DB::table('basic_fees')
            ->where([
                ['major_id',$this->major_id],
                ['academic_id',$this->academic_id]
                ])
            ->get();
        return $basic_fees;
    }
    public function updateBasicFee(){
        DB::table('basic_fees')
            ->where([
                ['major_id',$this->major_id],
                ['academic_id',$this->academic_id]
            ])
            ->update([
                'basic_fee_amount'=>$this->basic_fee_amount
            ]);
    }
    public function destroyBasicFee(){
        DB::table('basic_fees')
            ->where([
                ['major_id',$this->major_id],
                ['academic_id',$this->academic_id]
            ])
            ->delete();
    }

    public  static function uniqueMajorAndAcademic($majorId){
        {
            return function ($attribute, $value, $fail) use ($majorId) {
                if (self::where('major_id', $majorId)
                    ->where('academic_id', $value)
                    ->exists()) {
                    $fail('Bản ghi đã tồn tại!');
                }
            };
        }
    }
}
