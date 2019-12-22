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

use App\Model\Subject;
use App\Model\Exam;
use App\Model\Exam_Selection;
use App\Model\NoTested;
use App\Model\Tested;
use App\Model\Semester;

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
        //DB::update('update semesters set active = 0'); //off
        DB::table('semesters')
            ->update(['active' => 0]);
        //DB::update('update semesters set active = 1 where maky = :maky', ['maky' => $maky]); //on
        DB::table('semesters')
            ->where('maky', $maky)
            ->update(['active' => 1]);
    }

    //deactivate a speacial exam
    public function deactivateExam($maky) {
        //DB::update('update semesters set active = 0 where maky = :maky', ['maky' => $maky]); //off
        DB::table('semesters')
            ->where('maky', $maky)
            ->update(['active' => 0]);
    }

    //show data in special created exam
    public function showExam($maky) {
        $semesters = $this->getExam();
        session_start();
        if (isset($_SESSION['semesters'])) unset($_SESSION['semesters']);
        $_SESSION['semesters'] = $semesters;
        
        //$tests = DB::select('select * from exams where maky = '.$maky);
        $exam = DB::select('select * from semesters where maky = :maky', ['maky' => $maky]);
        if (!$exam) {
            return redirect('/exam');
        }

        $tests = DB::select('select * from exams where maky = :maky', ['maky' => $maky]);
        $tests = $tests;
        //dd($tests);
        return view('admin.exam',['exam'=>$exam[0], 'tests'=>$tests]);
    }

    //Create new Exam
    public function getCreateExam() {
        $semesters = $this->getExam();
        session_start();
        //unset($_SESSION['semesters']);
        if (isset($_SESSION['semesters'])) unset($_SESSION['semesters']);
        $_SESSION['semesters'] = $semesters;

        return view('admin.createexam');
    }
    public function createExam(Request $request) {
        $result = $this->checkExam($request->maky);
        if (isset($result['error'])) {
            return redirect()->back()->with(['errors' => $result['error']]);
        }
        if ($result) {
            $val['error'] = 'Mã kỳ đã tồn tại';
            return redirect()->back()->with(['errors'=> $val['error']]);
        }
        DB::table('semesters')->insert([
            [
                'maky' => $request->maky,
                'active' => 0 //off
            ],
        ]);

        return redirect('exam/'.$request->maky);
    }

    //rename special exam
    public function renameExams($request)
    {
        //create a exam with new name
        DB::table('semesters')->insert([
            [
                'maky' => $request->maky,
                'active' => $request->active == 'Deactivated'?0:1
            ],
        ]);

        //update tests with this exam
        //DB::update('update exams set maky = :maky where maky = : oldmaky',['maky' =>$request->maky, 'oldmaky'->$request->oldmaky]);
        DB::table('exams')
            ->where('maky', $request->oldmaky)
            ->update(['maky' => $request->maky]);

        DB::table('tested')
            ->where('maky', $request->oldmaky)
            ->update(['maky'=> $request->maky]);

        DB::table('notested')
            ->where('maky', $request->oldmaky)
            ->update(['maky'=> $request->maky]);

        //delete the old exam
        //DB::delete('delete from semesters where maky = '.$request->oldmaky);
        DB::delete('delete from semesters where maky=:maky', ['maky'=>$request->oldmaky]);
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
                    'ca' => $test[6],
                    'date' => $test[7],
                    'timestart' => $test[8],
                    'timeend' => $test[9],
                    'diadiem' => $test[10]
                ],
            ]);
        }
    }

    public function deleteExam(Request $request) {
        try {
            DB::table('exams')->where('maky', $request->maky)->delete();
            DB::table('semesters')->where('maky', $request->maky)->delete();
            $result = json_encode(array('result'=>'delete'));
            return $reslut;
        } catch(Exception $e) {
            $result = json_encode(array('result'=>$e->getMessage()));
            return $result;
        }
    }

    public function checkExam($maky) {
        if ($maky == 'new')  {
            $result['error'] = 'Không được đặt tên là new! Hay để tên khác';
            return $result;
        }
        $semester = DB::table('semesters')->where('maky', $maky)->get()->first();
        if ($semester) return true; //chua ton tai
        else return false; //da ton tai
    }

    public function makeupExam(Request $request) {
        DB::table('exams')->where('maky', $request->maky)->delete();
        $result = json_encode(array('result'=>'makeup'));
        return $result;
    }


    public function importTestsData(Request $request) {
        DB::table('exams')->insert([
            [
                'maky' => $request->maky,
                'maca' => $request->maca,
                'mahp' => $request->mahp,
                'tenhp' => $request->tenhp,
                'TC' => $request->TC,
                'SL' => $request->SL,
                'ca' => $request->ca,
                'date' => $request->date,
                'timestart' => $request->timestart,
                'timeend' => $request->timeend,
                'diadiem' => $request->diadiem
            ],
        ]);

        $result = json_encode(array('result'=>'success'));
        return $result;
    }

    public function importExam(Request $request) {
        if ($request->oldmaky != $request->maky) {
            $this->renameExams($request);
        } else {
            if ($request->active == 'Activated') $this->activateExam($request->maky);
            else $this->deactivateExam($request->maky);
        }

        return redirect('exam/'.$request->maky);
    }
}
