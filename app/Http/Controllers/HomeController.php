<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class HomeController extends Controller
{
    protected $salt = 'ealarm911';

    public function process_login(Request $request){
        $username = $request->input('username');
        $password = md5($this->salt.$request->input('password'));

        $result = User::select('id')->where(array('username' => $username , 'password' => $password))->get()->toArray();
        if(count($result)==1){
            $request->session()->flash('notify_mssg', 'Logged in successfully!');
            $request->session()->flash('notify_stat', 'success');
            $request->session()->put('user_id',$result[0]['id']);
			return redirect('admin/dashboard');
		}
		else{
            $request->session()->flash('notify_mssg', 'Please check the login credentials');
            $request->session()->flash('notify_stat', 'error');
			return redirect('admin');
		}
    }

    public function process_logout(Request $request){
        $request->session()->flush();
        return redirect('admin');
    }
}
?>