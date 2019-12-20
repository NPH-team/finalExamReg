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

class ControllerSubjectSelection extends Controller
{
    /** Import tested or notested subject selection data from excel file*/

    public function getImport(){
        $controllerImport = new ControllerImport();
        return $controllerImport->importFile();
    }
    
    //import data to DB if request is passed
    public function importTestedData(Request $request){
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
            //create data variable to save the tested subject import successfully
            $data = array();
            $modelTested = new Tested();

            for ($row = 1; $row < sizeof($collection); $row++){
                try {
                    //check tested subject selection is exist in data or not?
                    //$selection = DB::select('select * from tested where maky = '.$collection[$row][1].'and msv = '.$collection[$row][2].'and mahp = '.$collection[$row][3]);
                    $selection = Tested::where([['maky', $collection[$row][1]], ['msv', $collection[$row][2]], ['mahp', $collection[$row][3]]])->first();
                    if ($selection != null || sizeof($collection[$row]) != 4) continue; //tested subject selection is exits or subject's data is error
                    
                    //import testes subject selection into database
                    $modelTested->insertFromExcel($collection[$row]);

                    //add tested subject selection into returned data
                    array_push($data, $collection[$row]);

                } catch(Exception $e){
                    //return json_encode(array('error'=>$e->getMessage()));
                    return redirect() -> back()
                        -> with(['errors' => $e->getMessage()]);
                }
            }
        } else {
            //return json_encode(array('error'=>'Please provide data in file according to sample file.'));
            return redirect() -> back()
                -> with(['errors' => [0 => 'Please provide data in file according to sample file.'.sizeof($collection[0])]]);
        }
        
        //return json_encode($result);
        return redirect() -> back()
                -> with(['successTested' => 'File uploaded successfully!' , 'dataTested' => $data]);
    }

    public function importNoTestedData(Request $request){
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
            //create data variable to save the notested subject import successfully
            $data = array();
            $modelNoTested = new NoTested();
            for ($row = 1; $row < sizeof($collection); $row++){
                try {
                    //check notested subject selection is exist in data or not?
                    //$selection = DB::select('select * from notested where maky = '.$collection[$row][1].'and msv = '.$collection[$row][2].'and mahp = '.$collection[$row][3]);
                    $selection = Tested::where([['maky', $collection[$row][1]], ['msv', $collection[$row][2]], ['mahp', $collection[$row][3]]])->first();

                    if ($selection != null || sizeof($collection[$row]) != 4) continue; //notested subject selection is exits or subject's data is error
                    
                    //import notested subject selection into database
                    
                    $modelNoTested->insertFromExcel($collection[$row]);

                    //add notested subject selection into returned data
                    array_push($data, $collection[$row]);

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
                -> with(['successNoTested' => 'File uploaded successfully!' , 'dataNoTested' => $data]);
    }

    public function deleteTested(Request $request){
        DB::delete('delete from tested where where maky = '.$request->maky.'and msv = '.$request->msv.'and mahp = '.$request->mahp);
    }

    public function deleteNoTested(Request $request){
        DB::delete('delete from tested where where maky = '.$request->maky.'and msv = '.$request->msv.'and mahp = '.$request->mahp);
    }
}
