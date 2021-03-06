<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\SequrityQuestion;


class SequrityQuestionController extends Controller
{
    public function response_security_questions_list(Request $request){

        $params = $columns = $totalRecords = $data = array();
        $params = $_REQUEST;

		//define index of column
        $columns = array( 
            0 => 'id',
            1 => 'question',
            2 => 'status',
            3 => 'postedTIme'
        );

        $where = $sqlTot = $sqlRec = "";
        $where =" WHERE 1 ";
        // check search value exist
        if( !empty($params['search']['value']) ) {   
            
            $where .=" AND ( question LIKE '".$params['search']['value']."%' ";    
            $where .=" ) ";
        }

        // getting total number records without any search
        $sql = "SELECT * FROM `security_questions` ";
        $sqlTot .= $sql;
        $sqlRec .= $sql;
        //concatenate search sql if value exist
        if(isset($where) && $where != '') {

            $sqlTot .= $where;
            $sqlRec .= $where;
        }
        
        $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
        
        $all_data = DB::select($sqlTot);
        $queryTot = count($all_data);

        $i=1;
        foreach($all_data as $alldata){
            $status_val = $alldata->status=='Y'?'<span class="label_status label_status-success"> Active </span>':'<span class="label_status label_status-danger"> In Active </span>';
            $data[] = array(
                            $i,
                            $alldata->question,
                            $status_val.'<a class="btn btn_icon-xs" title="Toggle Status" alt="Toggle Status" onClick="change_security_question_status('.$alldata->id.',this)"><i class="fa fa-exchange" aria-hidden="true"></i></a>',
                            date('d-m-Y',$alldata->postedTime),
                            '<a class="btn btn_icon-xs btn_icon-success" href="'.url('admin/security_questions/edit/'.$alldata->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a class="btn btn_icon-xs btn_icon-danger" href="'.url('admin/security_questions/delete/'.$alldata->id).'"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            );
            $i++;
        }
        
       

        $json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
            );
            
        return $json_data;
    }

    public function change_status(Request $request){
        $questionID = $request->input('questionID');

        try{
            $query_check = SequrityQuestion::select('id','status')->where(array('id' => $questionID))->get()->toArray();
            if(count($query_check)>0){
                $question_details = $query_check[0];
                $new_stat = $question_details['status']=='Y'?'N':'Y';
                $response = $question_details['status']=='Y'?'false':'true';

                $SequrityQuestion = SequrityQuestion::find($questionID);
                $SequrityQuestion->timestamps = false;
                $SequrityQuestion->status = $new_stat;

                if($SequrityQuestion->save() === true){
                    $result = array('status' => true);
                    $result['response'] = $response;
                }
                else{
                    throw new Exception("Updatation unsuccessfull");
                }
            }
            else{
                throw new Exception("No question found with this id");
            }
        }catch(Exception $e){
            $result = array('status' => false);
            $result['message'] = $e->getMessage();
        }

        if($result['status'] === true){
            echo $result['response'];
        }
        exit;
    }
}
