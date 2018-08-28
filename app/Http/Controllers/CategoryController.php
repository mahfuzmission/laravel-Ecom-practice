<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class CategoryController extends Controller
{
    public function index(){
        //echo "add category";
        return view('admin.add_category');
    }
    public function all_category(){
        $all_category = DB::table('tbl_category')->get();
        $manage_category = view('admin.all_category')->with('all_category',$all_category);
       // dd($manage_category);
        return view('admin_layout')
            ->with('admin.all_category',$manage_category);
    }
    public function save_category(Request $request){
        $data=array();
        $data['category_id']=$request->category_id;
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;
        $data['publication_status']=$request->publication_status;

//        echo "<pre>";
//            print_r($data);
//        echo "</pre>";
        DB::table('tbl_category')->insert($data);
        Session::put('message','Category added successfully !!');
        return redirect::to('/add-category');
    }

    public function inactive_category($category_id){
       DB::table('tbl_category')
           ->where('category_id',$category_id)
           ->update(['publication_status'=>0]);
       Session::put('message','Category inactive successfully !!');
       return Redirect::to('/all-category');
    }

    public function active_category($category_id){
        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update(['publication_status'=>1]);
        Session::put('message','Category active successfully !!');
        return Redirect::to('/all-category');
    }
    public function edit_category($category_id){
        $all_category_info = DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->first();

        $category_info = view('admin.edit_category')->with('category_info',$all_category_info);
        // dd($category_info);
        return view('admin_layout')
            ->with('admin.edit_category',$category_info);
           // return view('admin.edit_category');
    }

    public function update_category(Request $request,$category_id){
        $data = array();
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;

        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update($data);

        Session::put('message','Category updated successfully !!');
        return Redirect::to('/all-category');

    }
}
