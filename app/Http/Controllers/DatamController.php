<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Datam;
use App\mealandbazargraph;
use App\Memdata;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mealsystem;
use Illuminate\Support\Facades\Session;
use DateTime;

class DatamController extends BaseController
{

    public function create()
    {
        $va = $this->SideAndNav();
        $users = $va['ms']->users()->get();
        return view('datam.mM.create', compact('va', 'users'));
    }

    public function store(Request $request, $msid)
    {
        $this->validate($request, [
            'date' => 'required',
            'name' => 'required'
        ]);
        $date = $request->date;
        if(date("m", strtotime($date)) == date("m"))
        {
            $month = Carbon::now()->month;
            $day = date("d", strtotime($request->date));


            ///////////////////////////member delete data//////////////////////////////////////////////
            $mData = Memdata::where('user_id', $request->name)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
            if ($mData){
                $user = User::find($request->name);
                if ($mData->dbm === null){
                    $x = 0;
                    return view('datam.memDataExist', compact('user', 'day', 'month', 'x'));
                }else {
                    $x = 1;
                    return view('datam.memDataExist', compact('user', 'day', 'month', 'x'));
                }
            }
            ///////////////////////////////////////////////////////////////////////////////////////////


            $check = Datam::where('user_id', $request->name)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
            if ($check){
                $check->delete();
            }
            $d = new Datam;
            $d->user_id = $request->name;
            $d->mealsystem_id = $msid;
            $d->month = $month;
            $d->day = $day;
            if ($request->filled('meal')){
                $this->validate($request, [
                    'meal' => 'integer|min:0'
                ]);
                $d->meal = $request->meal;
            }
            if ($request->filled('bazar')){
                $this->validate($request, [
                    'bazar' => 'integer|min:0'
                ]);
                $d->bazar = $request->bazar;
            }
            if ($request->filled('deposit')){
                $this->validate($request, [
                    'deposit' => 'integer|min:0'
                ]);
                $d->deposit = $request->deposit;
            }
            $d->save();
            $this->mealRateAndAmountUpdate($msid, $month, $day);
            $va = $this->SideAndNav();
            return redirect()->back()->with('va', $va)->with('mealDataSuccess', 'Meal Data saved successfully.');
        }
        else {
            return redirect()->back()->with('alertMeal', 'Please Select a date from current month.');
        }

    }





























    public function index()
    {
        //
    }

    public function show(Datam $datam)
    {
        //
    }

    public function edit($slug, $msid, $m, $d)
    {
        $u = User::where('slug', $slug)->first();
        $data = Datam::where('user_id', $u->id)->where('mealsystem_id', $msid)->where('month', $m)->where('day', $d)->first();
        return view('datam.edit', compact('m', 'd', 'u', 'data'));
    }


    public function update(Request $request, $did)
    {
//        dd($did);
        $d = Datam::find($did);
        if ($request->has('meal')){
            $d->meal = $request->meal;
        }
        if ($request->has('bazar')){
            $d->bazar = $request->bazar;
        }
        if ($request->has('deposit')){
            $d->deposit = $request->deposit;
        }
        $d->update();

        $dCA = Datam::where('mealsystem_id', $d->mealsystem_id)->where('month', $d->month)->get();
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
        $mealS = Mealsystem::where('id', $d->mealsystem_id)->first();
        $mealS->meal_rate = $mr;
        $mealS->update();

        $users = $mealS->users()->get();

        $tdo = 0;
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $d->month)->get();
            foreach ($dataA as $data){
                $tdo = $tdo + $data->deposit;
            }
        }
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $d->month)->get();
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
                    $mrr = round($mr);
                    $amount = $td - $tdo + $tb - ($mrr * $tm);
                }else{
                    $amount = $td - $tdo + $tb;
                }
            }else{
                if ($mr){
                    $mrr = round($mr);
                    $amount = $td + $tb - ($mrr * $tm);
                }else{
                    $amount = $td + $tb;
                }
            }
            $ar = Amountu::where('user_id', $user->id)->where('mealsystem_id', $d->mealsystem_id)->first();
            if ($ar){
                $ar->amount = $amount;
                $ar->update();
            }else {
                $ar = new Amountu;
                $ar->user_id = $user->id;
                $ar->mealsystem_id =  $d->mealsystem_id;
                $ar->amount = $amount;
                $ar->save();
            }
        }
        return redirect()->route('f.table', ['msid' => $d->mealsystem_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Datam  $datam
     * @return \Illuminate\Http\Response
     */
    public function destroy($did)
    {
//        dd($did);
        $d = Datam::find($did);
        $msid = $d->mealsystem_id;
        $month = $d->month;
        $d->delete();

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
        $mealS = Mealsystem::where('id', $msid)->where('month', $month)->first();
        $mealS->meal_rate = $mr;
        $mealS->update();

        $users = $mealS->users()->get();

        $tdo = 0;
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $month)->get();
            foreach ($dataA as $data){
                $tdo = $tdo + $data->deposit;
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
                    $mrr = round($mr);
                    $amount = $td - $tdo + $tb - ($mrr * $tm);
                }else{
                    $amount = $td - $tdo + $tb;
                }
            }else{
                if ($mr){
                    $mrr = round($mr);
                    $amount = $td + $tb - ($mrr * $tm);
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

        return redirect()->back();

    }


    public function pcreate($msid)
    {
        $ms = Mealsystem::find($msid);
        $month = \Carbon\Carbon::now()->month;
        if ($month == 1){
            $pmonth = 12;
        }else {
            $pmonth = $month - 1 ;
        }
        $po = DateTime::createFromFormat('!m', $pmonth);
        $pmn = $po->format('F');
        return view('datam.pcreate', compact('ms', 'pmonth', 'pmn'));
    }


    public function pstore(Request $request, $msid)
    {
//        dd($msid);
        $this->validate($request, [
            'name' => 'required'
        ]);
        $ms = Mealsystem::find($msid);
        $m = $ms->month;
        if ($m==1 || $m==3 || $m==5 || $m==7 || $m==8 || $m==10 || $m==12){
            $this->validate($request, [
                'day' => 'required|integer|between:1,31'
            ]);
        }elseif ($m==4 || $m==6 || $m==9 || $m==11){
            $this->validate($request, [
                'day' => 'required|integer|between:1,30'
            ]);
        }else{
            $this->validate($request, [
                'day' => 'required|integer|between:1,28'
            ]);
        }

        $mData = Memdata::where('user_id', $request->name)->where('mealsystem_id', $msid)->where('day', $request->day)->where('month', $m)->first();
        if ($mData){
            $user = User::find($request->name);
            $day = $request->day;
            $month = $m;
            if ($mData->dbm === null){
                $x = 0;
                return view('datam.memDataExist', compact('user', 'day', 'month', 'x'));
            }else {
                $x = 1;
                return view('datam.memDataExist', compact('user', 'day', 'month', 'x'));
            }
        }

        $check = Datam::where('user_id', $request->name)->where('mealsystem_id', $msid)->where('day', $request->day)->where('month', $m)->first();
        if ($check){
            $check->delete();
        }

        $d = new Datam;
        $d->user_id = $request->name;
        $d->mealsystem_id = $msid;
        $d->month = $m;
        $d->day = $request->day;
        if ($request->has('meal')){
            $d->meal = $request->meal;
        }
        if ($request->has('bazar')){
            $d->bazar = $request->bazar;
        }
        if ($request->has('deposit')){
            $d->deposit = $request->deposit;
        }
        $d->save();

        $dCA = Datam::where('mealsystem_id', $msid)->where('month', $m)->get();
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
        $mealS = Mealsystem::where('id', $msid)->where('month', $m)->first();
        $mealS->meal_rate = $mr;
        $mealS->update();

        $users = $mealS->users()->get();

        $tdo = 0;
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $m)->get();
            foreach ($dataA as $data){
                $tdo = $tdo + $data->deposit;
            }
        }
        foreach ($users as $user) {
            $dataA = Datam::where('user_id', $user->id)->where('month', $m)->get();
            $tb = 0;
            $tm = 0;
            $td = 0;
            foreach ($dataA as $data) {
                $tb = $tb + $data->bazar;
                $tm = $tm + $data->meal;
                $td = $td + $data->deposit;
            }

            if ($user->hasRole('mealManager')) {
                if ($mr) {
                    $mrr = round($mr);
                    $amount = $td - $tdo + $tb - ($mrr * $tm);
                } else {
                    $amount = $td - $tdo + $tb;
                }
            } else {
                if ($mr) {
                    $mrr = round($mr);
                    $amount = $td + $tb - ($mrr * $tm);
                } else {
                    $amount = $td + $tb;
                }
            }
            $ar = Amountu::where('user_id', $user->id)->where('mealsystem_id', $msid)->first();
            if ($ar) {
                $ar->amount = $amount;
                $ar->update();
            } else {
                $ar = new Amountu;
                $ar->user_id = $user->id;
                $ar->mealsystem_id = $msid;
                $ar->amount = $amount;
                $ar->save();
            }
        }
        return redirect()->route('lhome', ['msid' => $msid]);
    }



    public function ad($uid, $msid, $m, $d){
        // find delete datam
        $datam = Datam::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        $datam->delete();

        // calculate all
        $dCA = Datam::where('mealsystem_id', $msid)->where('month', $m)->get();
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
        $mealS = Mealsystem::where('id', $msid)->where('month', $m)->first();
        $mealS->meal_rate = $mr;
        $mealS->update();

        $users = $mealS->users()->get();

        $tdo = 0;
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $m)->get();
            foreach ($dataA as $data){
                $tdo = $tdo + $data->deposit;
            }
        }
        foreach ($users as $user) {
            $dataA = Datam::where('user_id', $user->id)->where('month', $m)->get();
            $tb = 0;
            $tm = 0;
            $td = 0;
            foreach ($dataA as $data) {
                $tb = $tb + $data->bazar;
                $tm = $tm + $data->meal;
                $td = $td + $data->deposit;
            }

            if ($user->hasRole('mealManager')) {
                if ($mr) {
                    $mrr = round($mr);
                    $amount = $td - $tdo + $tb - ($mrr * $tm);
                } else {
                    $amount = $td - $tdo + $tb;
                }
            } else {
                if ($mr) {
                    $mrr = round($mr);
                    $amount = $td + $tb - ($mrr * $tm);
                } else {
                    $amount = $td + $tb;
                }
            }
            $ar = Amountu::where('user_id', $user->id)->where('mealsystem_id', $msid)->first();
            if ($ar) {
                $ar->amount = $amount;
                $ar->update();
            } else {
                $ar = new Amountu;
                $ar->user_id = $user->id;
                $ar->mealsystem_id = $msid;
                $ar->amount = $amount;
                $ar->save();
            }
        }

        // delete memData
        $memData = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        $memData->delete();

        return redirect()->route('show.memd', ['month' => $m]);
    }



    public function rd($uid, $msid, $m, $d){
        // change dbm on datam
        $datam = Datam::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        $datam->dbm = null;
        $datam->update();

        // delete memD
        $memData = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        if ($memData){
            $memData->delete();
        }

        return redirect()->route('show.memd', ['month' => $m]);
    }


}
