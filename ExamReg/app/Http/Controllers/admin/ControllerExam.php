<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Collection;
use DB;
use Validator;
use Importer;
use Exporter;

use App\Model\Student;
use App\Model\Semester;
use App\Model\Subject;
use App\Model\Exam;
use App\Model\Exam_Selection;
use App\Model\NoTested;
use App\Model\Tested;

class ControllerExam extends Controller
{
    /** Create Exam with a special semester
     * or
     * Return data of Special Exam
    */
    
    //return exams ~ semesters which were created
    public function getExam() {
        $semesters = DB::select('select * from semesters');
        return $semesters;
    }

    //activate a special exam
    public function activateExam($maky) {
        DB::update('update semesters set active = 0'); //off
        DB::update('update semesters set active = 1 where maky = :maky', ['maky' => $maky]); //on
    }

    //deactivate a speacial exam
    public function deactivateExam($maky) {
        DB::update('update semesters set active = 0 where maky = :maky', ['maky' => $maky]); //off
    }

    //show data in special created exam
    public function showExam($maky) {
        //$tests = DB::select('select * from exams where maky = '.$maky);
        $exam = DB::select('select * from semesters where maky = :maky', ['maky' => $maky]);
        if (!$exam) {
            $exam[0] = 'new';
            $exam[1] = 0;
        } 
        $tests = DB::select('select * from exams where maky = :maky', ['maky' => $maky]);
        return view('admin.exam',['exam'=>$exam, 'tests'=>$tests]);
    }

    //Create new Exam
    public function getCreateExam($maky) {
        DB::table('semesters')->insert([
            [
                'maky' => $maky,
                'active' => 0 //off
            ],
        ]);
    }

    //rename special exam
    public function renameExams(Request $request)
    {
        //create a exam with new name
        DB::table('semesters')->insert([
            [
                'maky' => $request->new,
                'active' => $request->active
            ],
        ]);

        //update tests with this exam
        DB::update('update semesters set maky = '.$request->new.'where maky = '.$request->old);

        //delete the old exam
        DB::delete('delete from semesters where maky = '.$request->old);
    }

    //copy the current exam
    public function copyExam($maky, $copy){
        $tests = DB::select('select * from exams where maky = '.$copy);
        foreach ($tests as $test) {
            DB::table('exams')->insert([
                [
                    'maky' => $maky,
                    'maca' => $test[1],
                    'mahp' => $test[2],
                    'tenhp' => $test[3],
                    'TC' => $test[4],
                    'SL' => $test[5],
                    'timestart' => $test[6],
                    'timeend' => $test[7],
                    'diadiem' => $test[8]
                ],
            ]);
        }
    }

    //add test into exam
    public function addTest(Request $request) {

    }

    //delete test in exam
    public function deleteTest() {

    }

    //update test in exam
    public function updateTest() {

    }
}
