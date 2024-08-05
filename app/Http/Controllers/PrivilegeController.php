<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PrivCategory;
use App\Models\PrivSubcategory;
use App\Models\PrivilegeSection;
use App\Models\PrivilegeMst;

class PrivilegeController extends Controller
{

    public function addcategory(Request $request) {
        
        $category = strtolower($request->input('category'));

        $existingCategory = PrivCategory::whereRaw('LOWER(name) = ?', [$category])->first();

        if ($existingCategory) {
            return response()->json(['status' => 'error', 'message' => 'Category already exists!']);
        }else{
            PrivCategory::create([
                'name' => $category,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Category added successfully!']);
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"category added ",$username, "Category Added");
    }

    public function addsubcategory(Request $request) {
        $subcategory = strtolower($request->input('subcategory'));
        $category = $request->input('category');
    
        // Corrected the whereRaw clause to properly handle the query
        $existingSubCategory = PrivSubCategory::whereRaw('LOWER(name) = ?', [$subcategory])
                                              ->where('cat_id', $category)
                                              ->first();
    
        if ($existingSubCategory) {
            return response()->json(['status' => 'error', 'message' => 'Sub Category already exists!']);
        } else {
            PrivSubCategory::create([
                'name' => $subcategory,
                'cat_id' => $category,
            ]);
    
            // Log the user's action after subcategory creation
            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress, "sub category added", $username, "Sub Category Added");
    
            return response()->json(['status' => 'success', 'message' => 'Sub Category added successfully!']);
        }
    }
    

    public function addprivilegesection(Request $request) {
        $subcategory = $request->input('subcategory');
        $category = $request->input('category');
        $sec_name    = $request->input('privilegesection');
        $route_name  = $request->input('routename');
        $username = session()->get('username');

        PrivilegeSection::create([
            'cat_id' => $category,
            'subcat_id' => $subcategory,
            'route_name' => $route_name,
            'section_name' => $sec_name,
            'cre_user' => $username,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Privilege added successfully!']);


        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"privilege section added ",$username, "Privilege Section Added");


    }

    public function get_sub_categories(Request $request){

        $cat_id = $request->input('cat_id');

        if ($cat_id && $cat_id != "All") {
            $data = PrivSubcategory::where('cat_id', $cat_id)->get();
        } else {

            $data = PrivSubcategory::all();
        }

        return response()->json(['data' => $data]);

    }

    public function get_categories(){

        $data = PrivCategory::all();

        return response()->json(['data' => $data]);

    }

    public function get_prev_section(){

        $cat_id = $_GET['cat_id'];
        $sub_cat_id = $_GET['sub_cat_id'];
        $user_type  = $_GET['user_type'];

        $user_id    = session('userid');

        if($sub_cat_id != 'All'){
            $sub_cat_filter = "AND tbl_prev_sec_mst.sub_cat_id = $sub_cat_id";
        }else{
            $sub_cat_filter = "";
        }
        if($user_type != 'All'){
            $user_filter = "AND tbl_prev_mst.user_type_id = $user_type";
        }else{
            $user_filter = "";
        }

        $ext_user = DB::table('tbl_prev_mst')
                    ->where('user_type_id','=',$user_type)
                    ->where('sub_cat_id','=',$sub_cat_id)
                    ->get();

        if(count($ext_user) > 0){

            $data = DB::select("SELECT tbl_prev_sec_mst.*,
                                    tbl_prev_sec_mst.sec_name,
                                    tbl_prev_mst.permission,
                                    concat('row_id_',tbl_prev_mst.sec_id) AS DT_RowId
                                FROM tbl_prev_mst
                                INNER JOIN tbl_prev_sec_mst ON tbl_prev_sec_mst.id = tbl_prev_mst.sec_id
                                WHERE tbl_prev_mst.com_id = $com_id $sub_cat_filter $user_filter");

            return compact('data', $data);

        }else{

            $data = DB::select("SELECT tbl_prev_sec_mst.*, 
                                    tbl_prev_sec_mst.sec_name,
                                    concat('row_id_',tbl_prev_sec_mst.id) AS DT_RowId
                                FROM tbl_prev_sec_mst 
                                WHERE tbl_prev_sec_mst.com_id = $com_id $sub_cat_filter");

            return compact('data', $data);
        }
    }

        public function save_user_prev(){

        $selected_sec   = $_GET['selected'];
        $deselected_sec = $_GET['deselected'];
        $cat_id         = $_GET['cat_id'];
        $sub_cat_id     = $_GET['sub_cat_id'];
        $user_type      = $_GET['user_type'];

        $user_id     = session('userid');
        $cre_date    = Carbon::now();
        $get_com_id  = DB::table('user_master')->where('id',$user_id)->first();
        $com_id      = $get_com_id->com_id;

        DB::table('tbl_prev_mst')
            ->where('cat_id', $cat_id)
            ->where('sub_cat_id', $sub_cat_id)
            ->where('user_type_id', $user_type)
            ->delete();

        if($selected_sec !== 'null') {

            foreach ($selected_sec as $section_id) {

                DB::table('tbl_prev_mst')
                    ->insert([
                        'user_type_id' => $user_type,
                        'cat_id' => $cat_id,
                        'sub_cat_id' => $sub_cat_id,
                        'route_id' => $section_id,
                        'sec_id' => $section_id,
                        'cre_user' => $user_id,
                        'cre_datetime' => $cre_date,
                        'com_id' => $com_id,
                    ]);
            }
        }

        if($deselected_sec !== 'null') {

            foreach ($deselected_sec as $section_id) {

                DB::table('tbl_prev_mst')
                    ->insert([
                        'user_type_id' => $user_type,
                        'cat_id' => $cat_id,
                        'sub_cat_id' => $sub_cat_id,
                        'route_id' => $section_id,
                        'sec_id' => $section_id,
                        'cre_user' => $user_id,
                        'cre_datetime' => $cre_date,
                        'com_id' => $com_id,
                        'permission' => '0'
                    ]);
            }
        }

        return $com_id;
    }

}
