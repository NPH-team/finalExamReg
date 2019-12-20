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

class ControllerSubject extends Controller
{
    /** Import subject data from excel file*/

    //return upload form
    public function getImport(){
        /*$controllerImport = new ControllerImport();
        return $controllerImport->importFile();*/
        return view('admin.subject');
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

    //check subject's data
    public function checkData($data)
    {
        foreach ($data as $value) {
            if ($value) return false;
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
        if (sizeof($collection[0])  == 4){
            //create data variable to save the subject import successfully
            $data = array();
            $modelSubject = new Subject();
            for ($row = 1; $row < sizeof($collection); $row++){
                try {
                    //check mahp is exist in data or not?
                    //$subject = DB::select('select * from subjects where mahp = '.$collection[$row][1]);
                    $subject = DB::select('select * from subjects where mahp = :mahp limit 0,1', ['mahp' => $collection[$row][1]]);

                    $subjectData = $this->chuanHoa($collection[$row]);
                    if ($subject != null || $this->checkData($subjectData)) continue; //subject with mahp is exits or subject's data is error
                    
                    //import subject's data into database
                    $modelSubject->insertFromExcel($subjectData);

                    //add subject's data into returned data
                    array_push($data, $subjectData);

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

        //return json_encode($result);
        return redirect() -> back()
                -> with(['success' => 'File uploaded successfully!' , 'datas' => $data]);
    }
    
    public function findSubjectData(Request $request){
        $subject = DB::select('select * from subjects where mahp = '.$request->info.'or tenhp ='.$request->info);
        return $subject;
    }

    public function updateSubjectData(Request $request){
        DB::delete('delete from subjects where mahp = '.$request->mahp);
        DB::table('subjects')->insert([
            [
                'mahp' => $request->mahp,
                'tenhp' => $request->tenhp,
                'TC' => $request->TC,
            ],
        ]);
    }

    public function showAll() {
        $subjects = DB::select('select * from subjects');
        return $subjects;
    }
}
