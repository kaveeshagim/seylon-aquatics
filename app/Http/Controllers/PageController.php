<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function home()
    {

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened home page",$username, "View Home Page");


        return view('pages.home');
    }

    public function users()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user page",$username, "View User Page");

        return view('pages.users');
    }

    public function adduserpage(){

        $usertypelist = DB::table('tbl_usertype')
                ->select('tbl_usertype.id', 'tbl_usertype.title')
                ->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened adduser page ",$username, "View Add User Page");
        
        return view('pages.addusers')->with('usertypelist', $usertypelist);

    }

    public function edituserpage($id) {

        $data = DB::table('tbl_users')
                ->select('*')
                ->where('tbl_users.id','=', $id)
                ->first();

        $usertypelist = DB::table('tbl_usertype')
                ->select('tbl_usertype.id', 'tbl_usertype.title')
                ->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened edit user page ",$username, "View Edit User Page");
        
        return view('pages.edituser')->with('data', $data)->with('usertypelist', $usertypelist);        
    }
    

    public function usertype()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened usertype page",$username, "View Usertype Page");

        return view('pages.usertype');
    }

    
    public function addusertypepage(){

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add usertype page ",$username, "View Add User Type Page");

        return view('pages.addusertype');

    }

    public function editusertypepage($id) {
        // $id = $_GET['id'];

        $data = DB::table('tbl_usertype')
                ->select('*')
                ->where('tbl_usertype.id','=', $id)
                ->first();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened edit usertype page ",$username, "View Edit User Type Page");
        
        return view('pages.editusertype')->with('data', $data);        
    }

    
    public function customers()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened customer page ",$username, "View Customer Page");

        return view('pages.customers');
    }

    public function subcustomers()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened subcustomer page ",$username, "View Sub Customer Page");

        return view('pages.subcustomers');
    }

    public function addcustomerspage(){

        $executives = DB::table('tbl_users')
                    ->select('tbl_users.fname as fname','tbl_users.id as id')
                    ->join('tbl_usertype', 'tbl_usertype.id', '=', 'tbl_users.user_type')
                    ->where('tbl_usertype.title', '=', 'Executive')
                    ->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add customer page",$username, "View Add Customer Page");

        return view('pages.addcustomers')->with('executives', $executives);

    }

    public function addsubcustomerspage(){

        $maincustomerlist = DB::table('tbl_customers')
                ->select('tbl_customers.id', CONCAT('tbl_customers.fname', ' ','tbl_customers.lname' ))
                ->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add subcustomer page",$username, "View Add Sub Customer Page");        

        return view('pages.addsubcustomers')->with('maincustomerlist', $maincustomerlist);

    }

    public function suppliers()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened supplier page ",$username, "View Supplier Page");

        return view('pages.suppliers');
    }


    public function addsupplierspage(){

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add supplier page",$username, "View Add Supplier Page");

        return view('pages.addsuppliers');

    }


    public function dashboard()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened dashboard ",$username, "View Dashboard Page");

        return view('pages.dashboard');
    }

    public function passwordmanager()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened password manager ",$username, "View Password Manager Page");

        return view('pages.passwordmanager');
    }

    public function resetpasswordpage($id) {
        // $id = $_GET['id'];

        $data = DB::table('tbl_reset_password_req')
                ->select('tbl_reset_password_req.*', 'tbl_users.username', 'tbl_users.id as user_id')
                ->join('tbl_users', 'tbl_reset_password_req.user_id', '=', 'tbl_users.id')
                ->where('tbl_reset_password_req.id','=', $id)
                ->first();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened reset password page ",$username, "View Reset Password Page");
        
        return view('pages.resetpassword')->with('data', $data);        
    }

    public function orderupload()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened order upload page ",$username, "View Order Upload Page");

        return view('pages.orderupload');
    }

    public function orders()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened orders page ",$username, "View Orders Page");

        return view('pages.orders');
    }

    public function addorderpage()
    {
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add order page ",$username, "View Add Order Page");

        return view('pages.addorder');
    }

    public function show($username)
    {

        $data = DB::table('tbl_users')
                ->select('*')
                ->where('tbl_users.username','=', $username)
                ->first();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user profile page ",$username, "View User Profile Page");

        return view('pages.userprofile')->with('data', $data);
    }

    
    public function showprofile()
    {

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user profile ",$username, "View Profile Page");

        return view('pages.userprofile');
    }

    public function fish_habitat() {

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish habitat interface ",$username, "View Fish Habitat Page");

        return view('pages.fish_habitat');

    }
    
    public function add_fish_habitat() {

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add fish habitat interface ",$username, "View Add Fish Habitat Page");

        return view('pages.add_fish_habitat');

    }

    public function edit_fish_habitat() {

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened edit fish habitat interface ",$username, "View Edit Fish Habitat Page");

        return view('pages.edit_fish_habitat');

    }

    public function fish_variety() {

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish variety interface ",$username, "View Fish Variety Page");

        return view('pages.fish_variety');

    }
    
    public function add_fish_variety() {

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add fish variety interface ",$username, "View Add Fish Variety Page");

        return view('pages.add_fish_variety');

    }

    public function edit_fish_variety() {

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened edit fish variety interface ",$username, "View Edit Fish Variety Page");

        return view('pages.edit_fish_variety');

    }
}
