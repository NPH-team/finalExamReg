<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ControllerExamSelection extends Controller
{
    /** Controll Student's Registion */
    public function getExam() {
        $semesters = DB::select('select * from semesters');
        return $semesters;
    }
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
}
