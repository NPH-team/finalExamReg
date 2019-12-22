<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Exam_Selection extends Model
{
    protected $table = 'exam_selection';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [   
        'msv',
        'maky',
        'maca'
      
    ];

    public function student() {
        return $this->belongsToMany('App\Model\Student');
    }

    public function exam() {
        return $this->belongsToMany('App\Model\Exam');
    }

    public function semester() {
        return $this->belongsToMany('App\Model\Semester');
    }
    
}
