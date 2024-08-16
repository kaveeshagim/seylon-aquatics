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
        // Define validation rules
        $rules = [
            'category' => 'required|numeric',
            'subcategory' => 'required|numeric',
            'privilegesection' => 'required|string',
            'routename' => 'required|string',
        ];
        
        // Validate the request data
        $validatedData = $request->validate($rules);
        
        $subcategory = $validatedData['subcategory'];
        $category = $validatedData['category'];
        $sec_name = $validatedData['privilegesection'];
        $route_name = $validatedData['routename'];
        $username = session()->get('username');
        
        // Check if a record with the same route_name already exists
        $existingRecord = PrivilegeSection::where('route_name', $route_name)->first();
        
        if ($existingRecord) {
            // Return error response if the record already exists
            return response()->json(['status' => 'error', 'message' => 'A privilege section with this route name already exists.']);
        }
    
        // Create the privilege section
        PrivilegeSection::create([
            'cat_id' => $category,
            'subcat_id' => $subcategory,
            'route_name' => $route_name,
            'section_name' => $sec_name,
            'cre_user' => $username,
        ]);
        
        // Log the action (if needed)
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "privilege section added", $username, "Privilege Section Added");
        
        // Return success response
        return response()->json(['status' => 'success', 'message' => 'Privilege added successfully!']);
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

    public function get_prev_section() {
        $cat_id = $_GET['cat_id'];
        $sub_cat_id = $_GET['sub_cat_id'];
        $user_type = $_GET['user_type'];
    
        $sections = DB::table('tbl_privilege_section')
                      ->leftJoin('tbl_privilege_mst', function($join) use ($user_type) {
                          $join->on('tbl_privilege_section.id', '=', 'tbl_privilege_mst.sec_id')
                               ->where('tbl_privilege_mst.user_type', '=', $user_type);
                      })
                      ->where('tbl_privilege_section.cat_id', $cat_id)
                      ->where('tbl_privilege_section.subcat_id', $sub_cat_id)
                      ->select('tbl_privilege_section.*', 'tbl_privilege_mst.permission')
                      ->get();
    
        return response()->json(['data' => $sections]);
    }
    

    public function save_user_prev(Request $request)
    {
        $selected = $request->input('selected');
        $deselected = $request->input('deselected');
        $cat_id = $request->input('cat_id');
        $sub_cat_id = $request->input('sub_cat_id');
        $user_type = $request->input('user_type');
    
        // Process the selected privileges
        if ($selected !== 'null') {
            foreach ($selected as $sec_id) {
                // Find the route_name from tbl_privilege_section
                $section = DB::table('tbl_privilege_section')
                    ->select('route_name')
                    ->where('id', $sec_id)
                    ->first();
    
                // Check if the privilege already exists
                $privilege = DB::table('tbl_privilege_mst')
                    ->where('user_type', $user_type)
                    ->where('cat_id', $cat_id)
                    ->where('subcat_id', $sub_cat_id)
                    ->where('sec_id', $sec_id)
                    ->first();
    
                if ($privilege) {
                    // Update the privilege if it already exists
                    DB::table('tbl_privilege_mst')
                        ->where('id', $privilege->id)
                        ->update([
                            'permission' => 1,
                            'route_name' => $section->route_name ?? null,
                        ]);
                } else {
                    // Insert a new privilege record
                    DB::table('tbl_privilege_mst')->insert([
                        'user_type' => $user_type,
                        'cat_id' => $cat_id,
                        'subcat_id' => $sub_cat_id,
                        'sec_id' => $sec_id,
                        'route_name' => $section->route_name ?? null,
                        'cre_user' => session()->get('userid'),
                        'permission' => 1,
                    ]);
                }
            }
        }
    
        // Process the deselected privileges
        if ($deselected !== 'null') {
            foreach ($deselected as $sec_id) {
                // Update the privilege to remove permission
                DB::table('tbl_privilege_mst')
                    ->where('user_type', $user_type)
                    ->where('cat_id', $cat_id)
                    ->where('subcat_id', $sub_cat_id)
                    ->where('sec_id', $sec_id)
                    ->update([
                        'permission' => 0,
                        'updated_user' => session()->get('userid'),
                    ]);
            }
        }
    
        return response()->json(['success' => true, 'message' => 'User Privilege Added Successfully']);
    }

    public function privcheck(Request $request) {

        if(Util::Privilege($request->input('priv')) == 'LOGOUT'){
            return response()->json(['status' => 'error', 'message' => 'You dont have necessary privileges']);
        }
        if(Util::Privilege($request->input('priv')) == 'DENIED'){
            return response()->json(['status' => 'error', 'message' => 'You dont have necessary privileges']);
        }

        return response()->json(['status' => 'success', 'message' => '']);


    }
    

}
