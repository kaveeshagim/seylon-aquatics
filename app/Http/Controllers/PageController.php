<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function home()
    {
        return view('pages.home');
    }

    public function users()
    {

        $usertypelist = DB::table('tbl_usertype')
                        ->select('tbl_usertype.id', 'tbl_usertype.title')
                        ->get();

        return view('pages.users')->with('usertypelist', $usertypelist);
    }

    public function customers()
    {
        return view('pages.customers');
    }

    public function suppliers()
    {
        return view('pages.suppliers');
    }

    public function dashboard()
    {
        return view('pages.dashboard');
    }

    public function orderupload()
    {
        return view('pages.orderupload');
    }

    public function orders()
    {
        return view('pages.orders');
    }
    
}
