<?php

namespace App\Http\Controllers;

use App\Client;
use App\Deal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->isAdmin()){
            return view('home');
        }
        $deals = Deal::where('start_at','<=', now())
            ->where('end_at','>=', now())
            ->get();

        return view('user.home',compact('deals'));
    }
}
