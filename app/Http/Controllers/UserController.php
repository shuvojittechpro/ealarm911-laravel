<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use DB;

class UserController extends Controller
{


    public function response_user_list(Request $request){
        $params = $_REQUEST;
        $columns = $totalRecords = $data = array();
		//define index of column
        $columns = array( 
            0 => 'id',
            1 => 'username',
            4 => 'employee_age'
        );

        $where = $sqlTot = $sqlRec = "";
        $where =" WHERE user_type != 'A' ";
        // check search value exist
        if( !empty($params['search']['value']) ) {   
            
            $where .=" AND ( username LIKE '".$params['search']['value']."%' ";    
            $where .=" OR social_type LIKE '".$params['search']['value']."%') ";
        }

        // getting total number records without any search
        $sql = "SELECT * FROM `user` ";
        $sqlTot .= $sql;
        $sqlRec .= $sql;
        //concatenate search sql if value exist
        if(isset($where) && $where != '') {

            $sqlTot .= $where;
            $sqlRec .= $where;
        }

       $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

        $alluser_data = DB::select($sqlTot);
        $totalRecords = count($alluser_data);
        $i=1;
        foreach($alluser_data as $alluser){
            $data[] = array(
                            $i,
                            $alluser->username,
                            date('d-m-Y',$alluser->postedTime)
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

}
