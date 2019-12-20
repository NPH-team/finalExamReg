<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey ='mahp';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'mahp',
        'tenhp',
        'TC'
    ];

    public function testedStudents() {
        return $this->belongsToMany(
            'App\Model\Student',
            'tested',
            'mahp',
            'msv');
    }

    public function noTestedStudents() {
        return $this->belongsToMany(
            'App\Model\Student',
            'notested',
            'mahp',
            'msv');
    }

    public function exams() {
        return $this->hasMany('App\Model\Exam');
    }

    public function insertFromExcel($data) {
        DB::table('subjects')->insert([
            [
                'mahp' => $data[1],
                'tenhp' => $data[2],
                'TC' => (int)$data[3],
            ],
        ]);
    }

    /*public function getTableColumns() {
        $qry = "SELECT column_name
                FROM information_schema.columns
                WHERE table_name = 'subjects'
                AND table_schema = 'demo' ";

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
    }*/
}
