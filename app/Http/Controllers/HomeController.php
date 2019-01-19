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

        $u = Auth::user();
        $userMealSystems = $u->mealsystems()->get();
        $month = Carbon::now()->month;
        $x = 0;
        foreach ($userMealSystems as $m){
            if (($m->month * 1) === ($month * 1)){
                $x = 1;
            }
        }
        if ($x !== 1){
            if ($u->hasRole('mealManager')) {
                $ms = new Mealsystem;
                $ms->month = $month;
                $ms->save();
                $ms->users()->attach($u);
                if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
                    $days = 31;
                } elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11){
                    $days = 30;
                } else {
                    $days = 28;
                }
                for ($i = 1; $i <= $days; $i++){
                    $newMaB = new mealandbazargraph;
                    $newMaB->mealsystem_id = $ms->id;
                    $newMaB->day = $i;
                    $newMaB->month = $month;
                    $newMaB->save();
                }
            } else {
                if (($month * 1) === 1){
                    $pmonth = 12;
                }else {
                    $pmonth = $month - 1 ;
                }
                $po = \DateTime::createFromFormat('!m', $pmonth);
                $pastMonthName = $po->format('F');
                $pms = $u->mealsystems()->where('month', $pmonth)->first();
                return view('member.no_ms', compact('u', 'pastMonthName', 'pms'));
            }
        }
        $va = $this->SideAndNav();
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
        if ($am){
            $myBalance = $am->amount + $am->expA;
        }else {
            $myBalance = 0;
        }
        //  GRAPH starts
        $usersForMBD = $va['ms']->users()->orderBy('name', 'desc')->get();
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

        return view('home', compact('va','mealRate', 'myBalance', 'totalMeal', 'totalbazarDeposit', 'amounts', 'usersForMBD', 'maxBazarDeposit', 'mealandbazars', 'maxMeal', 'maxBazar'));

    }




    public function homePast($pmsid){
        $va = $this->SideAndNavPast($pmsid);
        $u = Auth::user();
        $mealRate = $va['pms']->meal_rate;
        $am = $u->amountus()->where('mealsystem_id', $va['pms']->id)->first();
        if ($am){
            $myBalance = $am->amount + $am->expA;
        }else {
            $myBalance = 0;
        }
        $datams = Datam::where('user_id', $u->id)->where('mealsystem_id', $va['pms']->id)->get();
        $totalbazarDeposit = 0;
        $totalMeal = 0;
        foreach ($datams as $d){
            $totalMeal = $d->meal + $totalMeal;
            $totalbazarDeposit = $d->bazar + $d->deposit + $totalbazarDeposit;
        }
        $amounts = Amountu::where('mealsystem_id', $va['pms']->id)->get();
        foreach ($amounts as $a){
            // add name to each amounts
            $a['name'] = $a->user->name;
            $a['username'] = $a->user->username;
        }
        //  GRAPH starts
        $usersForMBD = $va['pms']->users()->orderBy('name', 'desc')->get();
        foreach ($usersForMBD as $u){
            $datams = Datam::where('user_id', $u->id)->where('mealsystem_id', $va['pms']->id)->get();
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
        $mealandbazars = mealandbazargraph::where('mealsystem_id', $va['pms']->id)->get();
        $maxMeal = $mealandbazars->max('totalMeal');
        $maxBazar = $mealandbazars->max('totalBazar');

        return view('homePast', compact('va', 'mealRate', 'myBalance', 'totalMeal', 'totalbazarDeposit', 'amounts', 'usersForMBD', 'maxBazarDeposit', 'mealandbazars', 'maxMeal', 'maxBazar'));
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
