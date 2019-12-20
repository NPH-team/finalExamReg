<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tested extends Model
{
    protected $table = 'tested';
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
        DB::table('tested')->insert([
            [
                'maky' => $data[1],
                'msv' => $data[2],
                'mahp' => $data[3],
            ],
        ]);
    }
}
