<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey =['msv','username'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'msv',
        'ten',
        'ngaysinh',
        'lop',
        'gioitinh',
        'quequan',
        'username',
        'password'
    ];

    public function exams() {
        return $this->belongsToMany(
            'App\Model\Exam',
            'exam_selection',
            'msv',
            'maca');
    }

    public function tested() {
        return $this->belongsToMany(
            'App\Model\Subject',
            'tested',
            'msv',
            'mahp');
    }

    public function noTested() {
        return $this->belongsToMany(
            'App\Model\Subject',
            'notested',
            'msv',
            'mahp');
    }

    public function insertFromExcel($data) {
        DB::table('students')->insert([
            [
                'msv' => $data[1],
                'ten' => $data[2],
                'ngaysinh' => $data[3],
                'lop' => $data[4],
                'gioitinh' => $data[5],
                'quequan'=> $data[6],
                'username' => $data[7],
                'password' => $data[8]
            ],
        ]);
    }

    public function getTableColumns() {
        $qry = "SELECT column_name
                FROM information_schema.columns
                WHERE table_name = 'students'
                AND table_schema = 'examreg' ";

        $result = DB::select($qry);
        $result = $this->transposeData($result);
        return $result;
    }

    public function transposeData($data) {
        $result = array();

        foreach($data as $index =>$objects) {
            
            foreach ($objects as $indexName => $value) {
                
                $result[$indexName][$index] = $value;
            }
        }
        return $result;
    }

    public function getAll() {
        return collect(DB::select("select * from ". $this->getTable()));
    }

    public function find($msv){
        return Students::where('msv', $msv)->first();
    }
    public function listSubcribe($mssv)
	{
		// $this->db->select('*');
		// $this->db->where('mssv', $mssv);
		// $dulieu=$this->db->get('danhsachdadangki');
		$dulieu=DB::table('tested')->where('msv',$mssv)->get();
		return $dulieu;
	}						
    
}
