<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ControllerExamSelection extends Controller
{
    /** export test lists */

    public function getTestList() {
        return view('admin.testlist');
    }

    public function exportExam(Request $request) {
        $maky = $request->maky;

        //select all tests with maky in exams
        //or use select semecter with maky then reference to exams to get all tests

        //with a [maky, maca] has many [maky, maca, msv]
        //wwe need to get the list of student with msv in a special test [maky, maca] in exam
    }


}
