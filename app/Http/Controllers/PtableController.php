<?php

namespace App\Http\Controllers;

use App\Datam;
use App\Mealsystem;
use App\Memdata;
use App\User;
use Illuminate\Http\Request;

class PtableController extends BaseController
{

    public function index($slug, $msid)
    {
        $u = User::where('slug', $slug)->first();
        $uid = $u->id;
        $aD = Datam::where('user_id', $u->id)->where('mealsystem_id', $msid)->orderBy('day')->get();
        $naD = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->orderBy('day')->get();
        $va = $this->SideAndNav();
        return view('tables.personaltable', compact('va','aD' , 'naD'));
    }

    public function fulltable($msid)
    {
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
























    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }





}
