<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\UserType;
use App\Models\User;
use App\Models\Customer;
use App\Models\Fish;
use App\Models\Size;
use App\Models\FishHabitat;
use App\Models\FishVariety;
use App\Models\FishFamily;
use App\Models\FishSpecies;
use App\Models\ResetPasswordReq;
use App\Models\PrivCategory;
use App\Models\PrivSubcategory;

class PageController extends Controller
{

    public function home()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened home page",$username, "View Home Page");


        return view('pages.home');
    }

    public function users()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user page",$username, "View User Page");

        return view('pages.users');
    }

    public function adduserpage(){

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $usertypelist = UserType::select('id', 'title')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened adduser page ",$username, "View Add User Page");
        
        return view('pages.addusers')->with('usertypelist', $usertypelist);

    }

    public function edituserpage($id) {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $data = User::find($id);
        // dd($data);
        $usertypelist = UserType::select('id', 'title')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened edit user page ",$username, "View Edit User Page");
        
        return view('pages.edituser')->with('data', $data)->with('usertypelist', $usertypelist);        
    }
    

    public function usertype()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $count = UserType::count();
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened usertype page",$username, "View Usertype Page");

        return view('pages.usertype', ['count' => $count]);
    }

    
    public function addusertypepage(){


        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add usertype page ",$username, "View Add User Type Page");

        return view('pages.addusertype');

    }

    public function editusertypepage($id) {
        // $id = $_GET['id'];

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $data = UserType::find($id);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened edit usertype page ",$username, "View Edit User Type Page");
        
        return view('pages.editusertype')->with('data', $data);        
    }

    
    public function customers()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened customer page ",$username, "View Customer Page");

        return view('pages.customers');
    }

    public function subcustomers()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened subcustomer page ",$username, "View Sub Customer Page");

        return view('pages.subcustomers');
    }

    public function addcustomerspage(){


        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $executives = User::select('fname', 'id')
                    ->whereHas('userType', function ($query) {
                        $query->where('title', 'Executive');
                    })
                    ->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add customer page",$username, "View Add Customer Page");

        return view('pages.addcustomers')->with('executives', $executives);

    }

    public function addsubcustomerspage(){


        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $maincustomerlist = Customer::select('id', \DB::raw("CONCAT(fname, ' ', lname) as full_name"))
                ->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add subcustomer page",$username, "View Add Sub Customer Page");        

        return view('pages.addsubcustomers')->with('maincustomerlist', $maincustomerlist);

    }

    public function suppliers()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened supplier page ",$username, "View Supplier Page");

        return view('pages.suppliers');
    }


    public function addsupplierspage(){

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add supplier page",$username, "View Add Supplier Page");

        return view('pages.addsuppliers');

    }


    public function dashboard()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened dashboard ",$username, "View Dashboard Page");

        return view('pages.dashboard');
    }

    public function passwordmanager()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened password manager ",$username, "View Password Manager Page");

        return view('pages.passwordmanager');
    }

    public function resetpasswordpage($id) {
        // $id = $_GET['id'];

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $data = ResetPasswordReq::with('user')
                ->where('id', $id)
                ->first();


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened reset password page ",$username, "View Reset Password Page");
        
        return view('pages.resetpassword')->with('data', $data);        
    }

    public function orderupload()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened order upload page ",$username, "View Order Upload Page");

        return view('pages.orderupload');
    }

    public function orders()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened orders page ",$username, "View Orders Page");

        return view('pages.orders');
    }

        public function orderhistory()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened orders page ",$username, "View Orders Page");

        return view('pages.orderhistory');
    }

        public function customerorders()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened orders page ",$username, "View Orders Page");

        return view('pages.customerorders');
    }

    public function addorderpage()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add order page ",$username, "View Add Order Page");

        return view('pages.addorder');
    }

    public function show($username)
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $data = User::where('username', $username)->first();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user profile page ",$username, "View User Profile Page");

        return view('pages.userprofile')->with('data', $data);
    }

    
    public function showprofile()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user profile ",$username, "View Profile Page");

        return view('pages.userprofile');
    }

    public function fish_stock() {


        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish stock interface ",$username, "View Fish Stock Page");

        return view('pages.fishstock');

    }

    public function fish_species() {


        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $fishfamilylist = FishFamily::select('id', 'name')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish species interface ",$username, "View Fish Species Page");

        return view('pages.fishspecies')->with('fishfamilylist',$fishfamilylist);

    }

    public function addfishweeklypage() {


        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add fish weekly interface ",$username, "View Add Fish Weekly Page");

        return view('pages.addfishweekly');

    }

    public function addfishpage() {


        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $fishhabitatlist = FishHabitat::select('id', 'name')->get();

        $fishvarietylist = FishVariety::select('id', 'name')->get();

        $fishsizelist = Size::select('id', 'name')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add fish interface ",$username, "View Add Fish Page");

        return view('pages.addfish')->with('fishhabitatlist', $fishhabitatlist)->with('fishvarietylist', $fishvarietylist)->with('fishsizelist', $fishsizelist);;

    }

    public function fish_weekly() {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish weekly interface ",$username, "View Fish Weekly Page");

        return view('pages.fishweekly');

    }

    public function fish_habitat() {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish habitat interface ",$username, "View Fish Habitat Page");

        return view('pages.fishhabitat');

    }
    
    public function addfishhabitatpage() {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add fish habitat interface ",$username, "View Add Fish Habitat Page");

        return view('pages.addfishhabitat');

    }

    public function editfishhabitatpage($id) {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $data = FishHabitat::find($id);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened edit fish habitat interface ",$username, "View Edit Fish Habitat Page");

        return view('pages.editfishhabitat')->with('data', $data);

    }

    public function fish_variety() {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $fishhabitatlist = FishHabitat::select('id', 'name')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish variety interface ",$username, "View Fish Variety Page");

        return view('pages.fishvariety')->with('fishhabitatlist', $fishhabitatlist);

    }

    public function fish_size() {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish size interface ",$username, "View Fish Size Page");

        return view('pages.fishsize');

    }

        public function fish_family() {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $fishhabitatlist = FishHabitat::select('id', 'name')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish family interface ",$username, "View Fish Family Page");

        return view('pages.fishfamily')->with('fishhabitatlist', $fishhabitatlist);

    }
    
    public function add_fish_variety() {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add fish variety interface ",$username, "View Add Fish Variety Page");

        return view('pages.add_fish_variety');

    }

    public function editfishvarietypage($id) {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $data = FishVariety::find($id);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened edit fish variety interface ",$username, "View Edit Fish Variety Page");

        return view('pages.editfishvariety')->with('data', $data);

    }

    public function categorysection(){

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened category section interface ",$username, "View Category Section Page");

        return view('pages.categorysection');
        
    }

    public function subcategorysection(){

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $categorylist = PrivCategory::select('id', 'name')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened subcategory section interface ",$username, "View Subcategory Section Page");

        return view('pages.subcategorysection')->with('categorylist', $categorylist);

    }

    public function privilegesection(){

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $categorylist = PrivCategory::select('id', 'name')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened privilege section interface ",$username, "View Privilege Section Page");

        return view('pages.privilegesection')->with('categorylist', $categorylist);

    }

    public function userprivilegesection(){

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $usertypelist = UserType::select('id', 'title')->get();
        $categorylist = PrivCategory::select('id', 'name')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user privilege section interface ",$username, "View User Privilege Section Page");

        return view('pages.userprivilegesection')->with('usertypelist', $usertypelist)->with('categorylist', $categorylist);

    }

    
    public function notifications(){

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user notifications interface ",$username, "View Notifications Page");

        return view('pages.notifications');

    }

    public function orderconfirmation(){

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened order confirmation interface ",$username, "View Order Confirmation Page");

        return view('pages.orderconfirmation');

    }

    public function invoices()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened invoice page",$username, "View Invoice Page");

        return view('pages.invoice');
    }
}
