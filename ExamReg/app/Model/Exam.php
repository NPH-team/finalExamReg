<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    protected $primaryKey =['maky','maca'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'maky',
        'maca',
        'mahp',
        'tenhp',
        'TC',
        'SL',
        'timestart',
        'timeend',
        'diadiem'
    ];

    public function students() {
        return $this->belongsToMany(
            'App\Model\Student',
            'exam_selection',
            'maca',
            'msv');
    }

    public function subject() {
        return $this->belongsTo('App\Model\Subject');
    }

    public function semester() {
        return $this->belongsTo('App\Model\Semester');
    }

/*
    public function getTableColumns() {
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
