<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class UserController extends Controller

{
    
    public function index()
    {
        $data['users'] = DB::table('lichthi')->get()->toarray();
        return view('templates.dangki',$data);
    //   $user=DB::table('kythi')->get()->toarray();
    //   dd($user);
    }
    public function index1()
    {
        $examinations = DB::table('lichthi')
            ->get();
        return view('templates.dangki', ['examinations' => $examinations]);
    }
    public function checkSameSchedule(Request $request) {
        $response = ['disable' =>  []];
        $list = $request->query('list');
        if($list) {
            $listSameSchedule = [];
            foreach ($list as $element) {
                $items = DB::table('lichthi')
                    ->where('maca','!=', $element['maca'])
                    ->where('ca' , $element['ca'])
                    ->where('date' , $element['date'])
                    ->pluck('maca')->toArray();
                $listSameSchedule= array_merge($listSameSchedule, $items);
            }
            $response['disable'] = array_unique((array) $listSameSchedule);
        }
        return response($response);
    }
    public function inlich()
    {
        $data['users'] = DB::table('lichthi')->get()->toarray();
        return view('templates.inlich',$data);
    //   $user=DB::table('kythi')->get()->toarray();
    //   dd($user);
   
    }
   public function generate(){
       $fileName='dangkithi.pdf';
      $mpdf=new \Mpdf\Mpdf([]);
      $html=\View::make('templates.pdf');
      $html=$html->render();
      $mpdf->WriteHTML($html);
      $mpdf->Output($fileName,'I');
   }
   
}
