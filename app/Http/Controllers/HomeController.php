<?php

namespace App\Http\Controllers;

use App\Mealsystem;
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
        return view('home');
    }

    public function me(){
        return view('mmHome');
    }


    public function lmonth($msid){
//        dd($msid);
        $ms = Mealsystem::find($msid);
        return view('pastHome', compact('ms'));
    }





}
