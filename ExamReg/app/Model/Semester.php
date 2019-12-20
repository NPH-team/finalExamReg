<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Semester extends Model
{
    protected $table = 'semesters';
    protected $primaryKey ='maky';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'maky',
        'active'
    ];

    public function exams() {
        return $this->hasMany('App\Model\Exam');
    }

    public function noTesteds() {
        return $this->belongsToMany('App\Model\NoTested');
    }

    public function testeds() {
        return $this->belongsToMany('App\Model\Tested');
    }

    public function exam_selections() {
        return $this->belongsToMany('App\Model\Exam_Selection');
    }

}
