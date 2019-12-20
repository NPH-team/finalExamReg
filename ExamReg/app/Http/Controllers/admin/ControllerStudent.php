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

class ControllerStudent extends Controller
{
    /** Import student data from excel file*/

    //return upload form
    public function getImport(){
        //$controllerImport = new ControllerImport();
        //return $controllerImport->importFile();
        return view('admin.student');
    }
    
    //chuan hoa data
    public function chuanHoa($data) {
        /*foreach ($data as $value) {
            for ($c = 0; ; $c < sizeof($value)) {
                if (%va)
            }
        }*/
        return $data;
    }

    //check student's data
    public function checkData($data)
    {
        foreach ($data as $value) {
            if ($value == null) return false;
        }
        return true;
    }
    //import data to DB if request is passed
    public function importData(Request $request){
        //check file is excel or not
        $controllerImport = new ControllerImport();
        $result = $controllerImport->checkExcel($request);
        if (isset($result['error'])) { //file is not excel
            //return json_encode($result);
            return redirect() -> back()
                -> with(['errors' => $result['error']]);
        } elseif (!isset($result['success'])) { //file have orther errors
            //return json_encode(array('error'=>'Something did not work correctly'));
            return redirect() -> back()
                -> with(['errors' => 'Something did not work correctly']);
        }

        //file is excel and having no orther error
        $excel = Importer::make('Excel');
        $excel->load($result['success']);
        $collection = $excel -> getCollection();

        //check provided data
        if (sizeof($collection[0])  == 9){
            //create data variable to save the student import successfully
            $data = array();

            $modelStudent = new Student();
            for ($row = 1; $row < sizeof($collection); $row++){
                try {
                    //check msv is exist in data or not?
                    //$student = DB::select('select * from students where msv = '.$collection[$row][1]);
                    //$student = Student::where(['msv', $collection[$row][1]])->first();
                    $student = DB::select('select * from students where msv = :msv limit 0,1', ['msv' => $collection[$row][1]]);

                    $studentData = $this->chuanHoa($collection[$row]);
                    if ($student != null || !$this->checkData($studentData)) continue; //student with msv is exits or student's data is error
                    
                    //import student's data into database
                    $modelStudent->insertFromExcel($studentData);

                    //add student's data into returned data
                    array_push($data, $studentData);

                } catch(Exception $e){
                    //return json_encode(array('error'=>$e->getMessage()));
                    return redirect() -> back()
                        -> with(['errors' => $e->getMessage()]);
                }
            }
        } else {
            //return json_encode(array('error'=>'Please provide data in file according to sample file.'));
            return redirect() -> back()
                -> with(['errors' => [0 => 'Please provide data in file according to sample file.']]);
        }

        return redirect() -> back()
                -> with(['success' => 'File uploaded successfully!' , 'datas' => $data]);

    }
    
    public function findStudentData(Request $request){
        $student = DB::select('select * from students where msv = '.$request->info.'or ten ='.$request->info);
        return $student;
    }

    public function updateStudentData(Request $request){
        DB::delete('delete from students where msv = '.$request->msv);
        DB::table('students')->insert([
            [
                'msv' => $request->msv,
                'ten' => $request->ten,
                'ngaysinh' => $request->ngaysinh,
                'lop' => $request->lop,
                'gioitinh' => $request->gioitinh,
                'quequan'=> $request->quequan,
                'username' => $request->username,
                'password' => $request->password
            ],
        ]);
    }

    public function showAll() {
        $students = DB::select('select * from students');
        return $students;
    }
}