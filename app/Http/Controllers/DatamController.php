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
            $mData = Memdata::where('user_id', $request->name)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
            if ($mData){
                $user = User::find($request->name);
                $o = DateTime::createFromFormat('!m', $month);
                $monthName = $o->format('F');
                $va = $this->SideAndNav();
                if ($mData->dbm === null){
                    $x = 0;
                    return view('datam.mM.duplicateEntry', compact('va','user', 'day', 'monthName', 'x'));
                }else {
                    $x = 1;
                    return view('datam.mM.duplicateEntry', compact('va','user', 'day', 'monthName', 'x'));
                }
            }
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
            return redirect()->back()->with('mealDataSuccess', 'Meal Data saved successfully.');
        }
        else {
            return redirect()->back()->with('alertMeal', 'Please Select a date from current month.');
        }

    }


    public function destroy($did)
    {
        $d = Datam::find($did);
        $msid = $d->mealsystem_id;
        $month = $d->month;
        $day = $d->day;
        $d->delete();
        $this->mealRateAndAmountUpdate($msid, $month, $day);
        return redirect()->back()->with('deleteSuccess', 'Entry Deleted Successfully.');
    }


    public function acceptDelete($did){
        $memData = Memdata::find($did);
        $uid = $memData->user_id;
        $msid = $memData->mealsystem_id;
        $month = $memData->month;
        $day = $memData->day;
        $memData->delete();
        $datam = Datam::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
        if ($datam){
            $datam->delete();
        }
        $this->mealRateAndAmountUpdate($msid, $month, $day);
        return redirect()->back();
    }


    public function rejectDelete($did){
        $memData = Memdata::find($did);
        $uid = $memData->user_id;
        $msid = $memData->mealsystem_id;
        $month = $memData->month;
        $day = $memData->day;
        $memData->delete();
        $datam = Datam::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
        if ($datam){
            $datam->dbm = null;
            $datam->update();
        }
        return redirect()->back();
    }


    public function edit($slug, $msid, $m, $d)
    {
        $this->redirectBackBack();
        $u = User::where('slug', $slug)->first();
        $data = Datam::where('user_id', $u->id)->where('mealsystem_id', $msid)->where('month', $m)->where('day', $d)->first();
        $o = DateTime::createFromFormat('!m', $m);
        $mn = $o->format('F');
        $va = $this->SideAndNav();
        return view('datam.mM.edit', compact('va','mn', 'd', 'u', 'data'));
    }


    public function update(Request $request, $did)
    {
        $this->redirectBackBack();
        $d = Datam::find($did);
        if ($request->filled('meal')){
            $d->meal = $request->meal;
        }
        if ($request->filled('bazar')){
            $d->bazar = $request->bazar;
        }
        if ($request->filled('deposit')){
            $d->deposit = $request->deposit;
        }
        $d->update();
        $msid = $d->mealsystem_id;
        $month = $d->month;
        $day = $d->day;
        $this->mealRateAndAmountUpdate($msid, $month, $day);
        return redirect(session('links')[2])->with('editSuccess', 'Data Edited Successfully.');
    }

    public function editGiven($slug, $msid, $m, $d)
    {
        $this->redirectBackBack();
        $u = User::where('slug', $slug)->first();
        $data = Memdata::where('user_id', $u->id)->where('mealsystem_id', $msid)->where('month', $m)->where('day', $d)->first();
        $o = DateTime::createFromFormat('!m', $m);
        $mn = $o->format('F');
        $va = $this->SideAndNav();
        return view('datam.mM.editGiven', compact('va','mn', 'd', 'u', 'data'));
    }

    public function updateGiven(Request $request, $uid, $msid, $m, $d)
    {
        $this->redirectBackBack();
        $dataM = Datam::where('user_id', $uid)->where('mealsystem_id', $msid)->where('month', $m)->where('day', $d)->first();
        if ($dataM){
            $dataM->delete();
        }
        $data = new Datam;
        $data->user_id = $uid;
        $data->mealsystem_id = $msid;
        $data->month = $m;
        $data->day = $d;
        if ($request->filled('meal')){
            $data->meal = $request->meal;
        }
        if ($request->filled('bazar')){
            $data->bazar = $request->bazar;
        }
        if ($request->filled('deposit')){
            $data->deposit = $request->deposit;
        }
        $data->save();
        $memData = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('month', $m)->where('day', $d)->first();
        $memData->delete();
        $this->mealRateAndAmountUpdate($msid, $m, $d);
        return redirect(session('links')[2]);
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




}
