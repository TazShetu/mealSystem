<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Datam;
use App\Mealsystem;
use App\Memdata;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $c = null;
        $ms = null;
        $pms = null;
        $u = Auth::user();
        $month = \Carbon\Carbon::now()->month;
        $ms = $u->mealsystems()->where('month', $month)->first();
        if ($ms){
            $am = $u->amountus()->where('mealsystem_id', $ms->id)->first();
            if ($u->hasRole('mealManager')){
                $memD = \App\Memdata::where('mealsystem_id', $ms->id)->get();
                $c = count($memD);
            }
        } else {
            $am = 0;
            if ($u->hasRole('mealManager')){
                $c = 0;
            }
        }
        if ($month == 1){
            $pmonth = 12;
        }else {
            $pmonth = $month - 1 ;
        }
        $co = \DateTime::createFromFormat('!m', $month);
        $mn = $co->format('F');
        $pms = $u->mealsystems()->where('month', $pmonth)->first();
        if ($pms){
            $po = \DateTime::createFromFormat('!m', $pmonth);
            $pmn = $po->format('F');
            $pastM = 1;
        }else {
            $pastM = 0;
            $pmn = 'No past month meal-system';
        }
        return view('mmHome', compact('pms','pastM', 'pmn', 'month', 'mn', 'c', 'ms', 'am', 'u'));
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

        // datams table
        $ds = Datam::where('month', $om)->get();
        foreach ($ds as $d){
            $d->delete();
        }

        // memdatas table
        $mds = Memdata::where('month', $om)->get();
        foreach ($mds as $md){
            $md->delete();
        }

        $mss = Mealsystem::where('month', $om)->get();
        foreach ($mss as $ms){
            // amountus table
            $amounts = Amountu::where('mealsystem_id', $ms->id)->get();
            foreach ($amounts as $a){
                $a->delete();
            }

            // mealsystem_user table
            $msid = $ms->id;
            DB::delete('DELETE FROM mealsystem_user WHERE mealsystem_id = :msid', ['msid' => $msid]);

            // mealsystems table
            $ms->delete();
        }

        return redirect()->back();

    }



}
