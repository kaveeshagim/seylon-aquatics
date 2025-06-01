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

    public function companydet()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        $data = DB::table('tbl_company')->select('*')->first();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened home page",$username, "View Home Page");


        return view('pages.companydetails')->with('data', $data);
    }


    public function home()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }


        if(Util::Privilege("View Data_23") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_23") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened home page",$username, "View Home Page");


        return view('pages.home');
    }

    public function dashboard()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Data_1") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_1") == 'DENIED'){
            return view('pages.accessdenied');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened dashboard ",$username, "View Dashboard Page");

        return view('pages.dashboard');
    }

    public function users()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Data_13") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_13") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user page",$username, "View User Page");

        return view('pages.users');
    }

    public function executives()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened executives page",$username, "View executives Page");

        return view('pages.executives');
    }

    public function adduserpage(){

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("Add Data_13") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("Add Data_13") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("Update Data_13") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("Update Data_13") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("View Data_14") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_14") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("Add Data_11") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("Add Data_11") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("Update Data_14") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("Update Data_14") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("View Data_15") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_15") == 'DENIED'){
            return view('pages.accessdenied');
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

    public function addcustomerspage()
    {
        $updateLastActivityTime = Util::updateLastActivityTime();
    
        if ($updateLastActivityTime == 'false') {
            return redirect('/expired');
        } elseif ($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }
    
        if (Util::Privilege("Add Data_15") == 'LOGOUT') {
            return redirect('/');
        }
        if (Util::Privilege("Add Data_15") == 'DENIED') {
            return view('pages.accessdenied');
        }
    
        // Fetching executives
        $executives = User::select('fname', 'id')
            ->whereHas('userType', function ($query) {
                $query->where('title', 'Executive - Marketing');
            })
            ->get();
    
        // Fetching customer accounts that are not linked to tbl_customers
        $cususeraccounts = User::select('username', 'id')
            ->whereHas('userType', function ($query) {
                $query->where('title', 'Customer');
            })
            ->whereNotIn('id', function ($query) {
                $query->select('user_id')
                    ->from('tbl_customers');
            })
            ->get();
    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user opened add customer page", $username, "View Add Customer Page");
    
        return view('pages.addcustomers')->with('executives', $executives)->with('cususeraccounts', $cususeraccounts);
    }
    

    public function editcustomerpage($id) {
        $updateLastActivityTime = Util::updateLastActivityTime();
    
        if ($updateLastActivityTime == 'false') {
            return redirect('/expired');
        } elseif ($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }
    
        if (Util::Privilege("Update Data_15") == 'LOGOUT') {
            return redirect('/');
        }
        if (Util::Privilege("Update Data_15") == 'DENIED') {
            return view('pages.accessdenied');
        }
    
        // Fetching the customer record
        $data = Customer::find($id);
    
        // Fetching executives
        $executivelist = User::select('id', 'username')
            ->where('tbl_usertype_id', 3)
            ->get();
    
        // Fetching customer accounts not linked to any customer record,
        // except for the account currently linked to this customer
        $cususeraccounts = User::select('id', 'username')
            ->where('tbl_usertype_id', 5)
            ->where(function($query) use ($data) {
                $query->whereNotIn('id', function($query) {
                    $query->select('user_id')
                        ->from('tbl_customers');
                })->orWhere('id', $data->user_id);
            })
            ->get();
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user opened edit customer page", $username, "View Edit Customer Page");

        return view('pages.editcustomer')
            ->with('data', $data)
            ->with('executivelist', $executivelist)
            ->with('cususeraccounts', $cususeraccounts);   
    }
    

    public function viewcustomerpage($id) {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Data_15") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_15") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $data = Customer::find($id);

        $ordercount = DB::table('tbl_order_mst')
        ->where('cus_id', $id)
        ->count();
    
        $completedordercount = DB::table('tbl_order_mst')
            ->where('cus_id', $id)
            ->where('status', 'completed')
            ->count();
        
        $pendingordercount = DB::table('tbl_order_mst')
            ->where('cus_id', $id)
            ->where('status', 'pending')
            ->count();
        
        $rejectedordercount = DB::table('tbl_order_mst')
            ->where('cus_id', $id)
            ->where('status', 'rejected')
            ->count();
        
        $completedinvoicecount = DB::table('tbl_invoice_mst')
            ->join('tbl_order_mst', 'tbl_order_mst.id', '=', 'tbl_invoice_mst.order_id')
            ->where('tbl_order_mst.cus_id', $id)
            ->where('tbl_order_mst.status', 'completed')
            ->count();
    

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add customer page",$username, "View Add Customer Page");

        return view('pages.customerdetail')
        ->with('data', $data)
        ->with('ordercount', $ordercount)
        ->with('completedordercount', $completedordercount)
        ->with('pendingordercount', $pendingordercount)
        ->with('rejectedordercount', $rejectedordercount)
        ->with('completedinvoicecount', $completedinvoicecount)
        ;

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




    public function passwordmanager()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Data_20") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_20") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("View Data_8") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_8") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("View Data_22") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_22") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("Add Data_8") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("Add Data_8") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $fishweeklylist = DB::table('tbl_fishweekly')
        ->select('tbl_fishweekly.fish_code','tbl_fishweekly.size', 'tbl_fishweekly.size_cm', 'tbl_fish_variety.common_name')
        ->join('tbl_fish_variety', DB::raw("CONVERT(tbl_fish_variety.fish_code USING utf8mb4) COLLATE utf8mb4_unicode_ci"), '=', 'tbl_fishweekly.fish_code')
        ->get();


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened add order page ",$username, "View Add Order Page");

        return view('pages.addorder')->with('fishweeklylist', $fishweeklylist);
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

        $data = User::where('username', $username)->with('userType')->first();
// dd($data);
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user profile ",$username, "View Profile Page");

        return view('pages.userprofile')->with('data', $data);
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

        if(Util::Privilege("View Data_5") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_5") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $fishfamilylist = FishFamily::select('id', 'name')->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish species interface ",$username, "View Fish Species Page");

        return view('pages.fishspecies')->with('fishfamilylist',$fishfamilylist);

    }

    public function addfishweeklypage() {
        $updateLastActivityTime = Util::updateLastActivityTime();
    
        if ($updateLastActivityTime == 'false') {
            return redirect('/expired');
        } elseif ($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("Add Data_2") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("Add Data_2") == 'DENIED'){
            return view('pages.accessdenied');
        }
    
        $fishvarietylist = DB::table('tbl_fish_variety')
        ->select('tbl_fish_variety.fish_code', 'tbl_fish_variety.common_name', 'tbl_fish_variety.size_cm as size_cm','tbl_size.name as size')
        ->leftjoin('tbl_size', 'tbl_size.id', '=', 'tbl_fish_variety.size')
        ->get();

    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user opened add fish weekly interface ", $username, "View Add Fish Weekly Page");
    
        return view('pages.addfishweekly')->with('fishvarietylist', $fishvarietylist);
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
        
        if(Util::Privilege("View Data_2") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_2") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("View Data_6") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_6") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("View Data_3") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_3") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $fishspecieslist = FishSpecies::select('id', 'name')->get();
        $fishsizelist = Size::select('id', 'name')->get();
// dd($fishspecieslist);
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened fish variety interface ",$username, "View Fish Variety Page");

        return view('pages.fishvariety')->with('fishspecieslist', $fishspecieslist)->with('fishsizelist', $fishsizelist);

    }

    public function fish_size() {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Data_7") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_7") == 'DENIED'){
            return view('pages.accessdenied');
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

        if(Util::Privilege("View Data_5") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_5") == 'DENIED'){
            return view('pages.accessdenied');
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

        // if(Util::Privilege("Add Data_13") == 'LOGOUT'){
        //     return redirect('/');
        // }
        // if(Util::Privilege("Add Data_13") == 'DENIED'){
        //     return view('pages.accessdenied');
        // }

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

        // if(Util::Privilege("Add Data_14") == 'LOGOUT'){
        //     return redirect('/');
        // }
        // if(Util::Privilege("Add Data_14") == 'DENIED'){
        //     return view('pages.accessdenied');
        // }

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

        // if(Util::Privilege("Add Data_15") == 'LOGOUT'){
        //     return redirect('/');
        // }
        // if(Util::Privilege("Add Data_15") == 'DENIED'){
        //     return view('pages.accessdenied');
        // }

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

        // if(Util::Privilege("View Data_16") == 'LOGOUT'){
        //     return redirect('/');
        // }
        // if(Util::Privilege("View Data_16") == 'DENIED'){
        //     return view('pages.accessdenied');
        // }

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

        if(Util::Privilege("View Data_23") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_23") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $notifications = DB::table('tbl_notifications')->select("*")->where('user_id', session()->get('userid'))->where('seen_status',0)->get();


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened user notifications interface ",$username, "View Notifications Page");

        return view('pages.notifications')->with('notifications', $notifications);

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

    public function vieworderdetpage($id) {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Data_24") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_24") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $orderid = $id;
        $orderno = DB::table('tbl_order_mst')->select('order_no')->where('id',$orderid)->first();



        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened view order interface ",$username, "View View Order Page");

        return view('pages.vieworder')->with('orderid', $orderid)->with('order_no',$orderno);


    }

    public function invoices()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Data_9") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_9") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened invoice page",$username, "View Invoice Page");

        return view('pages.invoice');
    }

    public function viewinvoicedetpage($orderId)
    {
        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Invoice Data_9") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Invoice Data_9") == 'DENIED'){
            return view('pages.accessdenied');
        }

        $invoiceavailability = DB::table('tbl_invoice_mst')->where('order_id', $orderId)->first();

        if($invoiceavailability) {

            return response()->json(['status' => 'success', 'message' => '']);

        }else{
            $response = app('App\Http\Controllers\InvoiceController')->generateinvoice($orderId);

            $responseData = json_decode($response->getContent(), true);

            return response()->json(['status' => $responseData['status'], 'message' => $responseData['message']]);

        }

    }

    public function viewinvoice($id) {


        $orderid = DB::table('tbl_invoice_mst')->select('order_id')->where('id', $id)->first();
        // Retrieve the invoice master details
        $invoiceMaster = DB::table('tbl_invoice_mst')
        ->select('tbl_invoice_mst.*', 'tbl_order_mst.*')
        ->join('tbl_order_mst','tbl_invoice_mst.order_id','=','tbl_order_mst.id')
        ->where('tbl_invoice_mst.order_id', $orderid->order_id)
        ->first();

        // Retrieve the invoice details
        $invoiceDetails = DB::table('tbl_invoice_det as invoice')
                ->join('tbl_order_det as order', 'invoice.orderdet_id', '=', 'order.id') // Join tbl_order_det
                ->join('tbl_fish_variety as variety', 'order.fish_code', '=', 'variety.fish_code') // Join tbl_order_det
                ->select(
                    'invoice.*',
                    'order.fish_code',
                    'order.quantity as qty',
                    'variety.*',
                )
                ->where('invoice.order_id', $orderid->order_id)
                ->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened invoice page",$username, "View Invoice Page");
        // dd($invoiceMaster);
        return view('pages.viewinvoice', [
            'invoiceMaster' => $invoiceMaster,
            'invoiceDetails' => $invoiceDetails
        ]);

    }

    public function viewinvoicee($id) {

        // Retrieve the invoice master details
        $invoiceMaster = DB::table('tbl_invoice_mst')
        ->select('tbl_invoice_mst.*', 'tbl_invoice_mst.id as invoiceid', 'tbl_order_mst.*')
        ->join('tbl_order_mst','tbl_invoice_mst.order_id','=','tbl_order_mst.id')
        ->where('tbl_invoice_mst.order_id', $id)
        ->first();

        // Retrieve the invoice details
        $invoiceDetails = DB::table('tbl_invoice_det as invoice')
                ->join('tbl_order_det as order', 'invoice.orderdet_id', '=', 'order.id') // Join tbl_order_det
                ->join('tbl_fish_variety as variety', 'order.fish_code', '=', 'variety.fish_code') // Join tbl_order_det
                ->select(
                    'invoice.*',
                    'order.fish_code',
                    'order.quantity as qty',
                    'variety.*',
                )
                ->where('invoice.order_id', $id)
                ->get();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened invoice page",$username, "View Invoice Page");
        // dd($invoiceMaster);
        return view('pages.viewinvoice', [
            'invoiceMaster' => $invoiceMaster,
            'invoiceDetails' => $invoiceDetails
        ]);

    }

    public function accessdenied() {
        return view('pages.accessdenied');
    }

    
    public function orderconfirmationpage($id) {


        $orderdetail = DB::table('tbl_order_mst as om')
            ->select(
                'om.*', 
                DB::raw("CONCAT(c.title, ' ', c.fname, ' ', IFNULL(c.lname, '')) as customer"), 
                'c.primary_contact as contact',  
                'u.fname as executive'
            )
            ->join('tbl_customers as c', 'c.id', '=', 'om.cus_id')
            ->join('tbl_users as u', 'u.id', '=', 'om.executive_id')
            ->where('om.id', $id)
            ->first();


        return view('pages.orderconfirmation')->with('orderdetail', $orderdetail);

    }


    public function salesreport() {

        
        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Data_12") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_12") == 'DENIED'){
            return view('pages.accessdenied');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened sales report page",$username, "View Sales Report Page");

        return view('pages.salesreport');


    }

    public function shippingreport() {

        
        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }
        if(Util::Privilege("View Data_11") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_11") == 'DENIED'){
            return view('pages.accessdenied');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened shipping report page",$username, "View Shipping Report Page");

        return view('pages.shipmentreport');


    }


    public function customerorderreport() {

        
        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        if(Util::Privilege("View Data_10") == 'LOGOUT'){
            return redirect('/');
        }
        if(Util::Privilege("View Data_10") == 'DENIED'){
            return view('pages.accessdenied');
        }


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened customer order report page",$username, "View Customer Order Report Page");

        return view('pages.customerorderreport');


    }

    public function customerevaluation()
    {

        $updateLastActivityTime = Util::updateLastActivityTime();

        if($updateLastActivityTime == 'false') {
            return redirect('/expired');
        }elseif($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }

        // if(Util::Privilege("View Data_19") == 'LOGOUT'){
        //     return redirect('/');
        // }
        // if(Util::Privilege("View Data_19") == 'DENIED'){
        //     return view('pages.accessdenied');
        // }

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user opened invoice page",$username, "View Invoice Page");

        return view('pages.customerevaluation');
    }
    
}
