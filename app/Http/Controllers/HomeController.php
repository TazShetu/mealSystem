<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Datam;
use App\Expense;
use App\mealandbazargraph;
use App\Mealsystem;
use App\Memdata;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function home(){
//        $ms = null;
        $totalMeal = 0;
        $totalbazarDeposit = 0;
        $amounts =null;
        $usersForMBD = null;
        $maxBazarDeposit = null;
        $mealandbazars = null;
        $maxMeal = null;
        $maxBazar = null;


        // check mS exist or not, if note create for mM only and attach him ////////////////////////////



        $va = $this->SideAndNav();
        $u = Auth::user();
        if(array_key_exists('ms', $va)){
            $datams = Datam::where('user_id', $u->id)->where('mealsystem_id', $va['ms']->id)->get();
            foreach ($datams as $d){
                $totalMeal = $d->meal + $totalMeal;
                $totalbazarDeposit = $d->bazar + $d->deposit + $totalbazarDeposit;
            }
            $mealRate = $va['ms']->meal_rate;
            $am = $u->amountus()->where('mealsystem_id', $va['ms']->id)->first();
            $amounts = Amountu::where('mealsystem_id', $va['ms']->id)->get();
            foreach ($amounts as $a){
                // add name to each amounts
                $a['name'] = $a->user->name;
                $a['username'] = $a->user->username;
            }
        } else {
            $am = 0;
        }
        if ($am){
            $myBalance = $am->amount + $am->expA;
        }else {
            $myBalance = 0;
        }
        //  GRAPH starts

        if(array_key_exists('ms', $va)){
            $usersForMBD = $va['ms']->users()->get();
            foreach ($usersForMBD as $u){
                $datams = Datam::where('user_id', $u->id)->where('mealsystem_id', $va['ms']->id)->get();
                $tm = 0;
                $tbd = 0;
                foreach ($datams as $d){
                    $tm = $d->meal + $tm;
                    $tbd = $d->bazar + $d->deposit + $tbd;
                }
                $u['totalMeal'] = $tm;
                $u['totalBazarDeposit'] = $tbd;
            }
            $maxBazarDeposit = 0;
            foreach ($usersForMBD as $u) {
                if ($maxBazarDeposit < ( ($u['totalBazarDeposit']) * 1 )){
                    $maxBazarDeposit = $u['totalBazarDeposit'];
                }
            }
            // MEAL & BAZAR (sort the data by day, check asc or desc which works)
            $mealandbazars = mealandbazargraph::where('mealsystem_id', $va['ms']->id)->get();
            $maxMeal = $mealandbazars->max('totalMeal');
            $maxBazar = $mealandbazars->max('totalBazar');
        }
        $va = $this->SideAndNav();
        return view('home', compact('va','mealRate', 'myBalance', 'totalMeal', 'totalbazarDeposit', 'amounts', 'usersForMBD', 'maxBazarDeposit', 'mealandbazars', 'maxMeal', 'maxBazar'));


    }
































//    public function index()
//    {
//        return view('home');
//    }

    public function lmonth($msid){
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

        // expenses table
        $exps = Expense::where('month', $om)->get();
        foreach ($exps as $exp){
            $exp->delete();
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

    public function allbalance($msid){
//        dd($msid);
        $amounts = Amountu::where('mealsystem_id', $msid)->get();
        // also pass month name
        $ms = Mealsystem::find($msid);
        $month = $ms->month;
        $co = \DateTime::createFromFormat('!m', $month);
        $mn = $co->format('F');

        $m = \Carbon\Carbon::now()->month;
        $u = \Illuminate\Support\Facades\Auth::user();
        if (($month * 1) === $m){
            $cms = null;
            $cmn = null;
            // we r in current month
            // pastmonth msid
            if ($m === 1){
                $pm = 12;
            }else {
                $pm = $m - 1;
            }
            $pms = $u->mealsystems->where('month', $pm)->first();
            $o = \DateTime::createFromFormat('!m', $pm);
            $pmn = $o->format('F');
        }else {
            $pms = null;
            $pmn = null;
            // we r in past month
            // present month msid
            $cms = $u->mealsystems->where('month', $m)->first();
            $oo = \DateTime::createFromFormat('!m', $m);
            $cmn = $oo->format('F');
        }

        return view('allbalance', compact('amounts', 'mn', 'month', 'pms', 'cms', 'pmn', 'cmn'));
    }



}
