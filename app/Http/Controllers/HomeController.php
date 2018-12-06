<?php

namespace App\Http\Controllers;

use App\Datam;
use App\Mealsystem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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


    public function admin(){
        $cm = Carbon::now()->month;
        if ($cm == 1){
            $om = 11;
        } elseif ($cm == 2){
            $om = 12;
        }else{
            $om = $cm - 2 ;
        }

        $ds = Datam::where('month', $om)->get();
        foreach ($ds as $d){
            $d->delete();
        }
        $mss = Mealsystem::where('month', $om)->get();
        foreach ($mss as $ms){
            $msid = $ms->id;
            DB::delete('DELETE FROM mealsystem_user WHERE mealsystem_id = :msid', ['msid' => $msid]);
            $ms->delete();
        }


        return redirect()->back();

    }



}
