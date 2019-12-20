<?php

namespace App\Http\Controllers\access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Student;
use App\Model\Admin;

class ControllerHome extends Controller
{
    //return exams ~ semesters which were created
    public function getExam() {
        $semesters = DB::select('select * from semesters');
        return $semesters;
    }

    public function getHome() {
        //check access
        $controllerLogin = new ControllerLogin();
        if (! $controllerLogin->checkAuthentication()) { //not login yet
            //return Location: localhost/ExamReg/public/home
            return redirect('login');
        } else { //loged in
            if (!isset($_SESSION['level'])) { //error! return student home which is default
                return view('student.home'); //->with('username', $_SESSION['login']);
                //echo "student";
            }
            else {
                if ($_SESSION['level'] == 'admin') { //it is admin user
                    $semesters = $this->getExam();
                    $_SESSION['semesters'] = $semesters;
                    return view('admin.home'); //->with('username', $_SESSION['login']); 
                    //echo "admin";
                } else { //it is student user or not. if its not return with default //student home 
                    return view('student.home'); //->with('username', $_SESSION['login']);
                    //echo "student";
                }
            }
        }
    }
}
