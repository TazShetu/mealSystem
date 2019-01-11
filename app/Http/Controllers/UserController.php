<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mealsystem;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{





    public function create()
    {
        $va = $this->SideAndNav();
//        dd($va);
        return view('createMember', compact('va'));
    }



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
        return $viewAdd;

    }

































    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        foreach ($mss as $ms){
            if (($ms->month) == (Carbon::now()->month)){
                $ms->users()->attach($u);
                $this->clculateExpA($ms->id);
            }
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->back();
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
//            dd($users);

        foreach ($users as $uu){
//                dd($uu);
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
