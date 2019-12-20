<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Collection;
use DB;
use Validator;
use Importer;
use Exporter;

class ControllerImport extends Controller
{
    //return importFile view
    public function importFile() {
        return view('importFile');
    }

    //check file upload which is excel ?
    public function checkExcel(Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:5000|mimes:xlsx, xls, csv'
        ]);

        if ($validator -> passes()){ //excel file

            $dataTime = date('Ymd_His');
            $file = $request -> file('file');
            $fileName = $dataTime . '-' . $file->getClientOriginalName();
            $savePath = public_path('/upload/');
            $file -> move($savePath, $fileName);

            return array('success'=>$savePath.$fileName);
        }else { //it is not excel file
            return array('error'=>$validator -> errors() -> all());
        }
    }
}
