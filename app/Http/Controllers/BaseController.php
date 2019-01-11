<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Expense;
use App\Mealsystem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class BaseController extends Controller
{
//    public function test($a){
//        $b = $a + 1;
//        return $b;
//    }

    public function SideAndNav(){
        $ms = null;
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

        $viewAdd = null;
        $viewAdd['ms'] = $ms;
        $viewAdd['monthName'] = $monthName;
        $viewAdd['pastM'] = $pastM;
        $viewAdd['pastMonthName'] = $pastMonthName;
        $viewAdd['user'] = $user;
        return $viewAdd;
    }



    public function clculateExpA($msid){
        $es = Expense::where('mealsystem_id', $msid)->where('a', 1)->get();
        // total exp
        $te = 0;
        foreach ($es as $exp){
            $te = $te + $exp->exp;
        }

        // all member get
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













}
