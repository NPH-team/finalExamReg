<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Exam_Selection;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller

{
    
    // public function index()
    // {
        
    //     $data['users'] = ;
    //     return view('templates.dangki',$data);
    //    $user=DB::table('kythi')->get()->toarray();
    //    dd($user);
    //}
    //load lịch thi
    public function index1()
    {
        $examinations=DB::table('exams')->get()->toarray();
        return view('templates.dangki', ['examinations' => $examinations]);
    }
    public function checkSameSchedule(Request $request) {
        $response = ['disable' =>  []];
        $list = $request->query('list');
        if($list) {
            $listSameSchedule = [];
            foreach ($list as $element) {
                $items = DB::table('exams')
                    ->where('maca','!=', $element['maca'])
                    ->where('tenhp' , $element['tenhp'])
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
        $data['users'] = DB::table('exam_selection')->get()->toarray();
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
   // hàm đếm môn
   public function countStudentSubcribe()
	{
		$this->db->select('*');
		$dulieu=$this->db->get('exam_selection');
		$dulieu=$dulieu->result_array();
		foreach ($dulieu as $key => $value) {
			$this->db->select('*');
			$this->db->where('maca', $value['maca']);
			$dulieu1=$this->db->get('exams');
			$dulieu1=$dulieu1->result_array();
			$sum=count($dulieu1);
			// echo $sum;
			$sumSubcribe =array('TC'=>$sum);
			// echo $sumSubcribe['dadangki'];
			$this->db->where('maca', $value['maca']);
			$this->db->update('exams', $sumSubcribe);
		}

    }
    public function store(Request $request)
    {
        $news = new Exam_Selection();
        $news->msv = $_SESSION['login']; 
        $news->maky = $request->maky;
        $news->maca = $request->maca;
        $news->save();
        return redirect()->action('UserController@create');
    }
}
