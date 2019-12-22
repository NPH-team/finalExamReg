<?php

namespace App\Http\Controllers\access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Student;
use App\Model\Admin;

class ControllerLogin extends Controller
{
    /** check session */
    public function checkAuthentication() {
        session_start();
        if (!isset($_SESSION["login"])) { //did not login yet
            return false;
        } else { //loged in
            return true;
        }
    }

    /** return login page */
    public function getLogin(){
        if ($this->checkAuthentication()) return redirect('');
        return view('login/login');
    }

    /** check user in database */
    public function checkLogin(Request $request) {
        session_start();
        $username = $request->username;
        $password = $request->password;

        //user is admin ?!
        $admin = Admin::where([['username', $request->username], ['password', $password]])->first();
        if ($admin != null) { //it is admin user
            $_SESSION['login'] = $admin->username;
            $_SESSION['level'] = 'admin';
            $result = json_encode(array('result'=>'correct'));
            return $result;
            
            //return Location: localhost/ExamReg/public/home
            //return redirect('home');
            //echo"admin";

        } else { //it's not admin user
            //user is student ?!
            $student = Student::where([['username', $request->username], ['password', $password]])->first();
            if ($student != null) { //it is student user
               
                $_SESSION['login'] = $student->username;
                $_SESSION['level'] = 'student';
                $result = json_encode(array('result'=>'correct'));
                return $result;

                //return Location: localhost/ExamReg/public/home
                //return redirect('home');
                //echo "student";

            } else { //it is not both admin and student users
                $result = json_encode(array('result'=>'Tên truy cập hoặc mật khẩu không đúng'));
                return $result;
            }

        }
    }

    /** logout */
    public function logout() {
        session_start();
        unset($_SESSION['login']);
        unset($_SESSION['level']);
        //return Location: localhost/ExamReg/public/login
        return redirect('login');
    }
}
