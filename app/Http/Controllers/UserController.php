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


    public function mmchange(){
        $va = $this->SideAndNav();
        $CMembers = $va['ms']->users()->get();
        $members = [];
        foreach ($CMembers as $p){
            if (!$p->hasRole('mealManager')){
                $members[] = $p;
            }
        }
        return view('member.mealManagerChange', compact('va','members'));
    }


    public function mmchangestore(Request $request)
    {
        $this->validate($request, [
            'member_id' => 'required'
        ]);
        $mm = Auth::user();
        $Nmm = User::find($request->member_id);
        $Nmm->attachRole('mealManager');
        $mm->detachRole('mealManager');
        $va = $this->SideAndNav();
        return redirect()->route('home', compact('va'))->with('alert', 'You are no longer a Mealmanager.');
    }


    public function attachOldMember()
    {
        $va = $this->SideAndNav();
        $mM = $va['user'];
        $msOmm = $mM->mealsystems()->get();
        $cmonth = Carbon::now()->month;
        $msCm = $mM->mealsystems()->where('month', $cmonth)->first();
        $CMembers = $msCm->users()->get();
        $members = [];
        foreach ($msOmm as $pMs){
            $Pmembers = $pMs->users()->get();
            foreach ($Pmembers as $pmm){
                // $pmm is an user object
                if (!$CMembers->contains('username', $pmm->username)){
                    // here we het $pmm as user object that is not in current month
                    $members[] = $pmm;
                }
            }
        }
        $userDuplicate=array();
        foreach ($members as $index=>$t) {
            if (isset($userDuplicate[$t["slug"]])) {
                unset($members[$index]);
                continue;
            }
            $userDuplicate[$t["slug"]]=true;
        }
        return view('member.attachOldMember', compact('va', 'members'));
    }


    public function attachOldMemberUpdate(Request $request, $msid)
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




}
