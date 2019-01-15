<?php

namespace App\Http\Controllers;

use App\Datam;
use App\Expense;
use App\Mealsystem;
use App\Memdata;
use App\User;
use Illuminate\Http\Request;

class PtableController extends BaseController
{

    public function index($slug, $msid)
    {
        $this->redirectBackBack();
        $u = User::where('slug', $slug)->first();
        $uid = $u->id;
        $aD = Datam::where('user_id', $u->id)->where('mealsystem_id', $msid)->orderBy('day')->get();
        $naD = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->orderBy('day')->get();
        $va = $this->SideAndNav();
        return view('tables.personaltable', compact('va','aD' , 'naD'));
    }



    public function fulltable($msid)
    {
        $this->redirectBackBack();
        $datams = Datam::where('mealsystem_id', $msid)->orderBy('day')->get();
        if (count($datams) > 0){
            foreach ($datams as $d){
                $d['name'] = $d->user->name;
            }
        }
        $va = $this->SideAndNav();
        $month = $va['ms']->month;
        $co = \DateTime::createFromFormat('!m', $month);
        $monthName = $co->format('F');
        return view('tables.fulltable', compact('va','datams', 'monthName'));
    }



    public function givenTable($msid){
        $this->redirectBackBack();
        $mealData = Memdata::where('mealsystem_id', $msid)->orderBy('day')->get();
        if (count($mealData) > 0){
            foreach ($mealData as $d){
                $d['name'] = $d->user->name;
            }
        }
        $ms = Mealsystem::find($msid);
        $month = $ms->month;
        $co = \DateTime::createFromFormat('!m', $month);
        $monthName = $co->format('F');
        $expData = Expense::where('mealsystem_id', $msid)->where('a', 0)->orderBy('day')->get();
        if (count($expData) > 0){
            foreach ($expData as $d){
                $d['name'] = $d->user->name;
            }
        }
        $va = $this->SideAndNav();
        return view('tables.given', compact('va', 'mealData', 'expData', 'monthName'));
    }


}
