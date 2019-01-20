<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Expense;
use App\Mealsystem;
use App\User;
use Carbon\Carbon;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends BaseController
{
    public function index()
    {
        $this->redirectBackBack();
        $va = $this->SideAndNav();
        // Gaph
        $uepm = $va['ms']->users()->orderBy('name', 'desc')->get();
        foreach ($uepm as $user){
            $totalexpense = 0;
            $expenses = Expense::where('mealsystem_id', $va['ms']->id)->where('user_id', $user->id)->where('a', 1)->get();
            if ($expenses){
                foreach ($expenses as $e){
                    $totalexpense = $e->exp + $totalexpense;
                }
            }
            $user['totalexpense'] = $totalexpense;
            $expA = Amountu::where('user_id', $user->id)->where('mealsystem_id', $va['ms']->id)->first();
            if ($expA){
                $user['expA'] = $expA->expA;
            }else {
                $user['expA'] = 0;
            }
        }
        // table
        $allsxpenses = Expense::where('mealsystem_id', $va['ms']->id)->where('a', 1)->orderBy('day')->get();
        if ($allsxpenses){
            foreach ($allsxpenses as $e){
                $e['name'] = $e->user->name;
            }
        }
        // unaccepted data of auth user
        $unacceptedExp = Expense::where('mealsystem_id', $va['ms']->id)->where('user_id', $va['user']->id)->where('a', 0)->orderBy('day')->get();
        return view('exp.index', compact('va', 'uepm', 'allsxpenses', 'unacceptedExp'));
    }




    public function store(Request $request, $msid)
    {
        $this->validate($request, [
            'date' => 'required'
        ]);
        $date = $request->date;
        if(date("m", strtotime($date)) == date("m")){
            $this->validate($request, [
                'name' => 'required',
                'exp' => 'required|integer|min:0'
            ]);
            $month = Carbon::now()->month;
            $day = date("d", strtotime($request->date));
            $check = Expense::where('user_id', $request->name)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
            if ($check){
                $check->delete();
            }
            $e = new Expense;
            $e->user_id = $request->name;
            $e->mealsystem_id = $msid;
            $e->month = $month;
            $e->day = $day;
            $e->exp = $request->exp;
            $e->a = 1;
            if ($request->filled('remark')){
                $this->validate($request, [
                    'remark' => 'string|max:50'
                ]);
                $e->remark = $request->remark;
            }
            $e->save();
            $this->clculateExpA($msid);
            return redirect()->back()->with('utilityDataSuccess', 'Utility Expense saved successfully.');
        }
        else {
            return redirect()->back()->with('alertUtility', 'Please Select a date from current month.');
        }
    }


    public function MemberStore(Request $request, $uid, $msid)
    {
        $this->validate($request, [
            'date' => 'required',
            'exp' => 'required'
        ]);
        $date = $request->date;
        $va = $this->SideAndNav();
        if(date("m", strtotime($date)) == date("m")){
            $month = Carbon::now()->month;
            $day = date("d", strtotime($request->date));
            $check = Expense::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->where('a', 0)->first();
            if ($check){
                $check->delete();
            }
            $e = new Expense;
            $e->user_id = $uid;
            $e->mealsystem_id = $msid;
            $e->month = $month;
            $e->day = $day;
            $e->exp = $request->exp;
            if ($request->filled('remark')){
                $this->validate($request, [
                    'remark' => 'string|max:50'
                ]);
                $e->remark = $request->remark;
            }
            $e->save();
            return redirect()->back()->with('va', $va)->with('utilityDataSuccess', "Utility Expense saved successfully. It will be added into calculation after mealmanager's acceptance.");
        }
        else {
            return redirect()->back()->with('va', $va)->with('alertUtility', 'Please Select a date from current month.');
        }
    }


    public function destroy($eid)
    {
        $exp = Expense::find($eid);
        $msid = $exp->mealsystem_id;
        $exp->delete();
        $this->clculateExpA($msid);
        return redirect()->back();
    }

    public function destroyUnaccepted($eid)
    {
        $exp = Expense::find($eid);
        $exp->delete();
        return redirect()->back();
    }

    public function destroyMember($eid)
    {
        $exp = Expense::find($eid);
        $exp->delete();
        return redirect()->back()->with('expMemberDeleteSuccess', 'Expense Deleted Successfully.');
    }


    public function edit($eid)
    {
        $this->redirectBackBack();
        $exp = Expense::find($eid);
        $day = $exp->day;
        $month = $exp->month;
        $co = \DateTime::createFromFormat('!m', $month);
        $monthName = $co->format('F');
        $u = User::find($exp->user_id);
        $userName = $u->name;
        $va = $this->SideAndNav();
        return view('exp.edit', compact('va','exp', 'userName', 'day', 'monthName'));
    }

    public function update(Request $request, $eid)
    {
        $this->redirectBackBack();
        $this->validate($request, [
            'exp' => 'required'
        ]);
        $e = Expense::find($eid);
        $e->exp = $request->exp;
        if ($request->filled('remark')){
            $this->validate($request, [
                'remark' => 'string|max:50'
            ]);
            $e->remark = $request->remark;
        }
        $e->a = 1;
        $e->update();
        $this->clculateExpA($e->mealsystem_id);
        return redirect(session('links')[2]);
    }


    public function MemberEdit($eid)
    {
        $this->redirectBackBack();
        $exp = Expense::find($eid);
        $month = $exp->month;
        $co = \DateTime::createFromFormat('!m', $month);
        $monthName = $co->format('F');
        $day = $exp->day;
        $u = User::find($exp->user_id);
        $userName = $u->name;
        $va = $this->SideAndNav();
        return view('exp.member.edit', compact('va','exp', 'day', 'monthName', 'userName'));
    }


    public function MemberUpdate(Request $request, $eid)
    {
        $this->redirectBackBack();
        $this->validate($request, [
            'exp' => 'required'
        ]);
        $e = Expense::find($eid);
        $e->exp = $request->exp;
        if ($request->filled('remark')){
            $this->validate($request, [
                'remark' => 'string|max:50'
            ]);
            $e->remark = $request->remark;
        }
        $e->update();
        return redirect(session('links')[2])->with('MemberUpdateSuccess', 'Expense Updated Successfully.');
    }


    public function mMAcceptExp($eid){
        $e = Expense::find($eid);
        $e->a = 1;
        $e->update();
        $this->clculateExpA($e->mealsystem_id);
        return redirect()->back();
    }


    public function indexPast($pmsid){
        $this->redirectBackBack();
        $va = $this->SideAndNavPast($pmsid);
        // Gaph
        $uepm = $va['pms']->users()->orderBy('name', 'desc')->get();
        foreach ($uepm as $user){
            $totalexpense = 0;
            $expenses = Expense::where('mealsystem_id', $va['pms']->id)->where('user_id', $user->id)->where('a', 1)->get();
            if ($expenses){
                foreach ($expenses as $e){
                    $totalexpense = $e->exp + $totalexpense;
                }
            }
            $user['totalexpense'] = $totalexpense;
            $expA = Amountu::where('user_id', $user->id)->where('mealsystem_id', $va['pms']->id)->first();
            if ($expA){
                $user['expA'] = $expA->expA;
            }else {
                $user['expA'] = 0;
            }
        }
        // table
        $allsxpenses = Expense::where('mealsystem_id', $pmsid)->where('a', 1)->orderBy('day')->get();
        if ($allsxpenses){
            foreach ($allsxpenses as $e){
                $e['name'] = $e->user->name;
            }
        }
        $unacceptedExp = Expense::where('mealsystem_id', $pmsid)->where('user_id', $va['user']->id)->where('a', 0)->orderBy('day')->get();
        return view('exp.PAST.index', compact('va', 'uepm','allsxpenses', 'unacceptedExp'));
    }



    public function storePast(Request $request, $pmsid)
    {
        $this->validate($request, [
            'nameExp' => 'required',
            'exp' => 'required|integer|min:0'
        ]);
        $pms = Mealsystem::find($pmsid);
        $month = $pms->month;
        if ($month==1 || $month==3 || $month==5 || $month==7 || $month==8 || $month==10 || $month==12){
            $this->validate($request, [
                'Day' => 'required|integer|between:1,31'
            ]);
        }elseif ($month==4 || $month==6 || $month==9 || $month==11){
            $this->validate($request, [
                'Day' => 'required|integer|between:1,30'
            ]);
        }else{
            $this->validate($request, [
                'Day' => 'required|integer|between:1,28'
            ]);
        }
        $check = Expense::where('user_id', $request->nameExp)->where('mealsystem_id', $pmsid)->where('day', $request->Day)->where('month', $month)->first();
        if ($check){
            $check->delete();
        }
        $e = new Expense;
        $e->user_id = $request->nameExp;
        $e->mealsystem_id = $pmsid;
        $e->month = $month;
        $e->day = $request->Day;
        $e->exp = $request->exp;
        $e->a = 1;
        if ($request->filled('remark')){
            $this->validate($request, [
                'remark' => 'string|max:50'
            ]);
            $e->remark = $request->remark;
        }
        $e->save();
        $this->clculateExpA($pmsid);
        return redirect()->back()->with('utilityDataSuccess', 'Utility Expense saved successfully.');
    }









































    public function MPstore(Request $request, $uid, $msid, $month)
    {
        $this->validate($request, [
            'exp' => 'required|integer|min:0'
        ]);
        if ($month==1 || $month==3 || $month==5 || $month==7 || $month==8 || $month==10 || $month==12){
            $this->validate($request, [
                'day' => 'required|integer|between:1,31'
            ]);
        }elseif ($month==4 || $month==6 || $month==9 || $month==11){
            $this->validate($request, [
                'day' => 'required|integer|between:1,30'
            ]);
        }else{
            $this->validate($request, [
                'day' => 'required|integer|between:1,28'
            ]);
        }

        $check = Expense::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $request->day)->where('month', $month)->first();
        if ($check){
            $check->delete();
        }
        $e = new Expense;
        $e->user_id = $uid;
        $e->mealsystem_id = $msid;
        $e->month = $month;
        $e->day = $request->day;
        $e->exp = $request->exp;
        if ($request->has('remark')){
            $this->validate($request, [
                'remark' => 'max:50'
            ]);
            $e->remark = $request->remark;
        }
        $e->save();

        return redirect()->route('p.utility', ['pmsid' => $msid]);
    }

}
