<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Memdata;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Datam;
use App\Mealsystem;
use App\Amountu;

class MemdataController extends BaseController
{
    public function create()
    {
        $va = $this->SideAndNav();
        $mss = $va['user']->mealsystems()->get();
        $x = 0;
        $cmonth = Carbon::now()->month;
        foreach ($mss as $m){
            if ((($m->month)*1) === ($cmonth*1)){
                $x = 1;
                return view('datam.member.create', compact('va'));
                break;
            }
        }
        // for new month ////////////////////////////////////////////////////////////////////////////////
        if ($x !== 1){
            ///////////// Create a view ////////////////////////////////////////////
            return view('member.no_ms');

        }
    }



    public function store(Request $request, $msid)
    {
        $this->validate($request, [
            'date' => 'required'
        ]);
        $date = $request->date;
        if(date("m", strtotime($date)) == date("m"))
        {
            $month = Carbon::now()->month;
            $day = date("d", strtotime($request->date));
            $va = $this->SideAndNav();
            $check = Memdata::where('user_id', Auth::id())->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
            if ($check){
                if ($check->dbm === null){
                    $x = 0;
                    return view('datam.member.duplicateEntry', compact('va','x', 'day'));
                }else {
                    $x = 1;
                    return view('datam.member.duplicateEntry', compact('va','x', 'day'));
                }
            }
            $d = new Memdata;
            $d->user_id = Auth::id();
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
            return redirect()->back()->with('va', $va)->with('mealDataSuccess', "Meal Data saved successfully. It will be added into calculation after mealmanager's acceptance.");
        }
        else {
            return redirect()->back()->with('alertMeal', 'Please Select a date from current month.');
        }
    }


    public function destroy($did)
    {
        $d = Memdata::find($did);
        $d->delete();
        return redirect()->back();
    }


    public function datamDeleteMember($did){
        $datam = Datam::find($did);
        $datam->dbm = 1;
        $datam->update();
        $memData = Memdata::where('user_id', $datam->user_id)->where('mealsystem_id', $datam->mealsystem_id)->where('day', $datam->day)->first();
        if ($memData){
            $memData->delete();
        }
        $dd = new Memdata;
        $dd->user_id = $datam->user_id;
        $dd->mealsystem_id = $datam->mealsystem_id;
        $dd->month = $datam->month;
        $dd->day = $datam->day;
        $dd->dbm = 1;
        $dd->save();
        return redirect()->back()->with('successDatamDeleteMember', "It will be deleted after mealmanager's acceptance.");
    }


    public function datamDeleteMemberUndo($uid, $msid, $m, $d){
        $datam = Datam::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        if ($datam){
            $datam->dbm = null;
            $datam->update();
        }
        $memData = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        if ($memData){
            $memData->delete();
        }
        return redirect()->back()->with('restoreMemberDelete', 'Data Restored successfully.');
    }



    public function memdataDeleteMember($did){
        $d = Memdata::find($did);
        $d->delete();
        return redirect()->back()->with('memdataDeleteMemberSuccess', 'Data deleted Successfully.');
    }


    public function dataMemEdit($did){
        $this->redirectBackBack();
        $data = Datam::find($did);
        $month = $data->month;
        $co = \DateTime::createFromFormat('!m', $month);
        $monthName = $co->format('F');
        $u = User::find($data->user_id);
        $userName = $u->name;
        $va = $this->SideAndNav();
        return view('datam.member.edit', compact('va', 'data', 'monthName', 'userName'));
    }


    public function dataMemUpdate(Request $request, $did){
        $this->redirectBackBack();
        $data = Datam::find($did);
        $uid = $data->user_id;
        $msid = $data->mealsystem_id;
        $day = $data->day;
        $month = $data->month;
        $memD = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
        if ($memD){
            $memD->delete();
        }
        $dd = new Memdata;
        $dd->user_id = $uid;
        $dd->mealsystem_id = $msid;
        $dd->month = $month;
        $dd->day = $day;
        if ($request->filled('meal')){
            $dd->meal = $request->meal;
        }
        if ($request->filled('bazar')){
            $dd->bazar = $request->bazar;
        }
        if ($request->filled('deposit')){
            $dd->deposit = $request->deposit;
        }
        $dd->save();
        return redirect(session('links')[2])->with('dataMemUpdateSuccess', "Data updated successfully but it will be added to calculation after melamanager's acceptance.");
    }



    public function editGivenMember($did){
        $this->redirectBackBack();
        $data = Memdata::find($did);
        $month = $data->month;
        $co = \DateTime::createFromFormat('!m', $month);
        $monthName = $co->format('F');
        $u = User::find($data->user_id);
        $userName = $u->name;
        $va = $this->SideAndNav();
        return view('datam.member.editGiven', compact('va','data', 'monthName', 'userName'));
    }


    public function updateGivenMember(Request $request, $did){
        $this->redirectBackBack();
        $data = Memdata::find($did);
        if ($request->filled('meal')){
            $data->meal = $request->meal;
        }
        if ($request->filled('bazar')){
            $data->bazar = $request->bazar;
        }
        if ($request->filled('deposit')){
            $data->deposit = $request->deposit;
        }
        $data->update();
        return redirect(session('links')[2])->with('updateGivenMemberSuccess', 'Data Updated Successfully.');
    }




    public function memberDataAccept($did){
        $md = Memdata::find($did);
        $check = Datam::where('user_id', $md->user_id)->where('mealsystem_id', $md->mealsystem_id)->where('day', $md->day)->where('month', $md->month)->first();
        if ($check){
            $check->delete();
        }
        $d = new Datam;
        $d->user_id = $md->user_id;
        $d->mealsystem_id = $md->mealsystem_id;
        $d->month = $md->month;
        $d->day = $md->day;
        if ($md->meal){
            $d->meal = $md->meal;
        }
        if ($md->bazar){
            $d->bazar = $md->bazar;
        }
        if ($md->deposit){
            $d->deposit = $md->deposit;
        }
        $d->save();
        $md->delete();
        $this->mealRateAndAmountUpdate($d->mealsystem_id, $d->month, $d->day);
        return redirect()->back();
    }





















































    public function Pcreate()
    {
        $a = Auth::user();
        $cm = Carbon::now()->month;
        if ($cm == 1){
            $pm = 12;
        }else {
            $pm = $cm - 1 ;
        }
        $ms = $a->mealsystems()->where('month', $pm)->first();
        return view('member.Pcdata', compact('ms'));
    }

    public function Pstore(Request $request, $msid)
    {
        $this->validate($request, [
            'day' => 'required'
        ]);
        $ms = Mealsystem::find($msid);
        $check = Memdata::where('user_id', Auth::id())->where('mealsystem_id', $msid)->where('day', $request->day)->where('month', $ms->month)->first();
        if ($check){
            $day = $request->day;
            $month = $ms->month;
            if ($check->dbm === null){
                $x = 0;
                return view('datam.memDEU', compact('day', 'month', 'msid', 'x'));
            }else {
                $x = 1;
                return view('datam.memDEU', compact('day', 'month', 'msid', 'x'));
            }
        }
        $d = new Memdata;
        $d->user_id = Auth::id();
        $d->mealsystem_id = $msid;
        $d->month = $ms->month;
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

        return redirect()->route('lhome', ['msid' => $msid]);
    }






}
