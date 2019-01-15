<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Datam;
use App\Expense;
use App\mealandbazargraph;
use App\Mealsystem;
use App\Memdata;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class BaseController extends Controller
{
    public function SideAndNav(){
        $ms = null;
        $givenDataCount = null;
        $month = Carbon::now()->month;
        $user = Auth::user();
        $ms = $user->mealsystems()->where('month', $month)->first();
        $co = \DateTime::createFromFormat('!m', $month);
        $monthName = $co->format('F');
        if ($month == 1){
            $pmonth = 12;
        }else {
            $pmonth = $month - 1 ;
        }
        $pms = $user->mealsystems()->where('month', $pmonth)->first();
        if ($pms){
            $po = \DateTime::createFromFormat('!m', $pmonth);
            $pastMonthName = $po->format('F');
            $pastM = 1;
        }else {
            $pastM = 0;
            $pastMonthName = null;
        }
        if ($user->hasRole('mealManager')){
            $memData = Memdata::where('mealsystem_id', $ms->id)->get();
            $unacceptedExpa = Expense::where('mealsystem_id', $ms->id)->where('a', 0)->get();
            $givenDataCount = count($memData) + count($unacceptedExpa);
        }
        $viewAdd = null;
        $viewAdd['ms'] = $ms;
        $viewAdd['monthName'] = $monthName;
        $viewAdd['pastM'] = $pastM;
        $viewAdd['pastMonthName'] = $pastMonthName;
        $viewAdd['user'] = $user;
        $viewAdd['givenDataCount'] = $givenDataCount;
        return $viewAdd;
    }






    public function clculateExpA($msid){
        $es = Expense::where('mealsystem_id', $msid)->where('a', 1)->get();
        $te = 0;
        foreach ($es as $exp){
            $te = $te + $exp->exp;
        }
        $ms = Mealsystem::find($msid);
        $users = $ms->users;
        $uc = count($users);
        $epu = $te / $uc;
        foreach ($users as $uu){
            $eus = Expense::where('mealsystem_id', $msid)->where('a', 1)->where('user_id', $uu->id)->get();
            $tue = 0;
            foreach ($eus as $eu){
                $tue = $tue + $eu->exp;
            }
            $ea = ($tue - $epu);
            $cexpA = Amountu::where('mealsystem_id', $msid)->where('user_id', $uu->id)->first();
            if ($cexpA){
                $cexpA->expA = $ea;
                $cexpA->update();
            }else {
                $exa = new Amountu;
                $exa->user_id = $uu->id;
                $exa->mealsystem_id = $msid;
                $exa->expA = $ea;
                $exa->save();
            }
        }
    }






    public function mealRateAndAmountUpdate($msid, $month, $day){
        $dCA = Datam::where('mealsystem_id', $msid)->where('month', $month)->get();
        $tb = 0;
        $tm = 0;
        foreach ($dCA as $dA){
            $tb = $tb + $dA->bazar;
            $tm = $tm + $dA->meal;
        }
        if ($tm){
            $mr = $tb / $tm;
        }else{
            $mr = 0;
        }
        $mealS = Mealsystem::find($msid);
        $mealS->meal_rate = $mr;
        $mealS->update();
        $users = $mealS->users()->get();
        $totalDepositsOfAllMembers = 0;
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('mealsystem_id' , $msid)->get();
            foreach ($dataA as $data){
                $totalDepositsOfAllMembers = $totalDepositsOfAllMembers + $data->deposit;
            }
        }
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $month)->get();
            $tb = 0;
            $tm = 0;
            $td = 0;
            foreach ($dataA as $data){
                $tb = $tb + $data->bazar;
                $tm = $tm + $data->meal;
                $td = $td + $data->deposit;
            }
            if ($user->hasRole('mealManager')){
                if ($mr){
//                    $mrr = round($mr);
                    $amount = $td - $totalDepositsOfAllMembers + $tb - ($mr * $tm);
                }else{
                    $amount = $td - $totalDepositsOfAllMembers + $tb;
                }
            }else{
                if ($mr){
//                    $mrr = round($mr);
                    $amount = $td + $tb - ($mr * $tm);
                }else{
                    $amount = $td + $tb;
                }
            }
            $ar = Amountu::where('user_id', $user->id)->where('mealsystem_id', $msid)->first();
            if ($ar){
                $ar->amount = $amount;
                $ar->update();
            }else {
                $ar = new Amountu;
                $ar->user_id = $user->id;
                $ar->mealsystem_id = $msid;
                $ar->amount = $amount;
                $ar->save();
            }
        }
        // home graph
        $allds = Datam::where('mealsystem_id', $msid)->where('month', $month)->where('day', $day)->get();
        $totalBazar = 0;
        $totalMeal = 0;
        foreach ($allds as $d){
            $totalBazar = $d->bazar + $totalBazar;
            $totalMeal = $d->meal + $totalMeal;
        }
        $MandB = mealandbazargraph::where('mealsystem_id', $msid)->where('month', $month)->where('day', $day)->first();
        $MandB->totalMeal = $totalMeal;
        $MandB->totalBazar = $totalBazar;
        $MandB->update();
    }







    public function redirectBackBack(){
        $links = session()->has('links') ? session('links') : [];
        $currentLink = request()->path(); // Getting current URI like 'category/books/'
        array_unshift($links, $currentLink); // Putting it in the beginning of links array
        session(['links' => $links]); // Saving links array to the session
    }













}
