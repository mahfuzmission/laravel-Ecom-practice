<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
session_start();

class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')
            ->where('admin_email',$admin_email)
            ->where('admin_password',$admin_password)
            ->first();
//        echo "<pre>";
//        print_r($result);
//        exit();

        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message','Email or Password Invalid');
            return Redirect::to('/admin');
        }

//    $result['usersInfo']=$users = DB::table('tbl_admin')->get();
//    return view('check',$result);
    }

    public function api($key){
        if($key=="1235") {
            $arr = [
                "name" => "Mission",
                "age" => 25,
                "gender" => "male"
            ];
            return json_encode($arr);
        } else {
            return 0;
        }
    }
}
