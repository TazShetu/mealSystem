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
                $va = $this->SideAndNav();
                if ($mData->dbm === null){
                    $x = 0;
                    return view('datam.mM.duplicateEntry', compact('va','user', 'day', 'x'));
                }else {
                    $x = 1;
                    return view('datam.mM.duplicateEntry', compact('va','user', 'day', 'x'));
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




    public function createPast($pmsid)
    {
        $va = $this->SideAndNavPast($pmsid);
        $users = $va['pms']->users()->get();
        return view('datam.mM.past.create', compact('va', 'users'));
    }


    public function storePast(Request $request, $pmsid)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $ms = Mealsystem::find($pmsid);
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
        $mData = Memdata::where('user_id', $request->name)->where('mealsystem_id', $pmsid)->where('day', $request->day)->where('month', $m)->first();
        if ($mData){
            $user = User::find($request->name);
            $day = $request->day;
            $va = $this->SideAndNavPast($pmsid);
            if ($mData->dbm === null){
                $x = 0;
                return view('datam.mM.past.duplicateEntry', compact('va','user', 'day', 'x'));
            }else {
                $x = 1;
                return view('datam.mM.past.duplicateEntry', compact('va','user', 'day', 'x'));
            }
        }
        $check = Datam::where('user_id', $request->name)->where('mealsystem_id', $pmsid)->where('day', $request->day)->where('month', $m)->first();
        if ($check){
            $check->delete();
        }
        $d = new Datam;
        $d->user_id = $request->name;
        $d->mealsystem_id = $pmsid;
        $d->month = $m;
        $d->day = $request->day;
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
        $day = $request->day;
        $this->mealRateAndAmountUpdate($pmsid, $m, $day);
        return redirect()->back()->with('mealDataSuccess', 'Meal Data saved successfully.');
    }




}
