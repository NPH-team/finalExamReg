<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class NoTested extends Model
{
    protected $table = 'notested';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'maky',
        'msv',
        'malop'
    ];

    public function student() {
        return $this->belongsToMany('App\Model\Student');
    }

    public function subjects() {
        return $this->belongsToMany('App\Model\Subject');
    }

    public function semester() {
        return $this->belongsToMany('App\Model\Semester');
    }

    public function insertFromExcel($data) {
        DB::table('notested')->insert([
            [
                'maky' => $data[1],
                'msv' => $data[2],
                'mahp' => $data[3],
            ],
        ]);
    }
}
