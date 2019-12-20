<?php

namespace App\Http\Controllers;
use Validator;
use Excel;
use Illuminate\Http\Request;
use DB;
use Importer;


class AdminController extends Controller
{
    public function nhapdulieu()
    {
       return view('templates.nhapdl');
    }
    public function importexcel(Request $request)
    {
       $validator = Validator::make($request->all(),['file'=>'required|max:5000|mimes:xlsx,xls,csv']);
       if($validator->passes()){
        return redirect()->back()->with(['success'=>'upload success']);
       }
       else{
           return redirect()->back()->with(['errors'=>$validator->errors()->all()]);
       }
    }
    public function importexcel1(Request $request)
    {
       $validator = Validator::make($request->all(),['file'=>'required|max:5000|mimes:xlsx,xls,csv']);
       if($validator->passes()){
        return redirect()->back()->with(['success'=>'upload thành công danh sách sinh viên đủ điều kiện']);
       }
       else{
           return redirect()->back()->with(['errors'=>$validator->errors()->all()]);
       }
    }
    // function importexcel(Request $request)
    // {
    //  $this->validate($request, [
    //   'file'  => 'required|mimes:xls,xlsx'
    //  ]);

    //  $path = $request->file('file')->getRealPath();

    //  $data = Excel::load(new nh,$path)->get();

    //  if($data->count() > 0)
    //  {
    //   foreach($data->toArray() as $key => $value)
    //   {
    //    foreach($value as $row)
    //    {
    //     $insert_data[] = array(
    //      'hoten'  => $row['hoten'],
    //      'mssv'   => $row['mssv'],
    //      'ngaysinh'   => $row['ngaysinh'],
    //      'lop'    => $row['lop'],
    //      'khoa'  => $row['khoa'],
    //     );
    //    }
    //   }

    //   if(!empty($insert_data))
    //   {
    //    DB::table('sinhvien')->insert($insert_data);
    //   }
    //  }
    //  return back()->with('success', 'Excel Data Imported successfully.');
    // }
}
