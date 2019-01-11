<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mealsystem;

class UserController extends BaseController
{
    public function create()
    {
//        $aaa = $this->test(2);
//        dd($aaa);
        $va = $this->SideAndNav();
        return view('createMember', compact('va'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'username' => 'required|unique:users',
        ]);
        $u = new User;
        $u->name = $request->name;
        $u->username = $request->username;
        $u->slug = str_slug($request->name)."-".str_slug($request->username);
        $u->save();
        // attach member to mealSystem same as mM
        $a = Auth::user();
        $mss = $a->mealsystems()->get();
        $month = Carbon::now()->month;
        foreach ($mss as $ms){
            if ($ms->month == $month){
                $ms->users()->attach($u);
                $this->clculateExpA($ms->id);
            }
        }
        $va = $this->SideAndNav();
        return redirect()->back()->with(['va' => $va])->with('success', 'Member Created Successfully.');
    }

    public function edit($slug)
    {
        $user = User::where('slug', $slug)->first();
        $va = $this->SideAndNav();
        return view('editMember', compact('va', 'user'));
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
        ]);
        $u = User::where('slug', $slug)->first();
        $u->name = $request->name;
        $u->slug = str_slug($request->name)."-".str_slug($u->username);
        if ($u->username !== $request->username){
            $this->validate($request, [
                'username' => 'required|unique:users',
            ]);
            $u->username = $request->username;
            $u->slug = str_slug($request->name)."-".str_slug($request->username);
        }
        if ($request->password){
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
            $u->password = bcrypt($request->password);
        }
        if ($request->email){
            $this->validate($request, [
                'email' => 'required|unique:users',
            ]);
            $u->email = $request->email;
        }
        $u->update();
        $va = $this->SideAndNav();
        return redirect()->route('home', compact('va'))->with('success', 'Your Profile Updated Successfully.');
    }






































    public function index()
    {
        //
    }


    public function show($id)
    {
        //
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function oldma($id)
    {
        $mM = User::find($id);
        $msOmm = $mM->mealsystems()->get();
        $x = 0 ;
        foreach ($msOmm as $m){
            if ($m->month == Carbon::now()->month){
                $x = 1;
                break;
            }
        }
        if ($x != 1){
            $ms = new Mealsystem;
            $ms->month = Carbon::now()->month;
            $ms->save();
            $ms->users()->attach($mM);
        }
        $cmonth = Carbon::now()->month;


        $msCm = $mM->mealsystems()->where('month', $cmonth)->first();
        $CMembers = $msCm->users()->get();
        $members = [];
        foreach ($msOmm as $pMs){
            $Pmembers = $pMs->users()->get();
            foreach ($Pmembers as $pmm){
                // $pmm is an user object
                if (!$CMembers->contains('name', $pmm->name)){
                    // here we het $pmm as user object that is not in current month
                    $members[] = $pmm;
                }
            }
        }
        $userdupe=array();
        foreach ($members as $index=>$t) {
            if (isset($userdupe[$t["slug"]])) {
                unset($members[$index]);
                continue;
            }
            $userdupe[$t["slug"]]=true;
        }
        $msid = $msCm->id;

        return view('member.addOldMember', compact('members', 'msid'));


    }


    public function oldMadd(Request $request, $msid)
    {
        $this->validate($request, [
            'names' => 'required'
        ]);
        $ms = Mealsystem::find($msid);
        $ids = $request->input('names');
        foreach ($ids as $id){
            $u = User::find($id);
            $ms->users()->attach($u);
        }
        $this->clculateExpA($msid);
        return redirect()->route('home');
    }



    public function mmchange(){
        $mM = Auth::user();
        $msOmm = $mM->mealsystems()->get();
        $x = 0 ;
        foreach ($msOmm as $m){
            if ($m->month == Carbon::now()->month){
                $x = 1;
                break;
            }
        }
        if ($x != 1){
            $ms = new Mealsystem;
            $ms->month = Carbon::now()->month;
            $ms->save();
            $ms->users()->attach($mM);
        }
        $cmonth = Carbon::now()->month;
        $msCm = $mM->mealsystems()->where('month', $cmonth)->first();
        $CMembers = $msCm->users()->get();

        $members = [];
        foreach ($CMembers as $p){
            if (!$p->hasRole('mealManager')){
                $members[] = $p;
            }
        }
        $msid = $msCm->id;
        return view('member.mm_change', compact('members', 'msid'));
    }



    public function mmstore(Request $request)
    {
        $this->validate($request, [
            'member_id' => 'required'
        ]);
        $mm = Auth::user();
        $Nmm = User::find($request->member_id);

        $Nmm->attachRole('mealManager');
        $mm->detachRole('mealManager');

        return redirect()->route('home');
    }





}
