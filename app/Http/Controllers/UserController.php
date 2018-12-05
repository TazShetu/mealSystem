<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mealsystem;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // check mS exist for current month. if not create mS for new month and attach mM to that
        $a = Auth::user();
        $msOmm = $a->mealsystems()->get();
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
            $ms->users()->attach($a);
        }
        return view('createMember');
    }

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

         // create member
        $u = new User;
        $u->name = $request->name;
        $u->username = $request->username;
        $u->slug = rand(1, 99).str_slug($request->name).rand(1,99);
        $u->save();
        // attach member to mealSystem same as mM
        $a = Auth::user();
        $mss = $a->mealsystems()->get();
        foreach ($mss as $ms){
//            dd($ms->id);
            $ms->users()->attach($u);
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
        if ($u->username !== $request->username){
            $this->validate($request, [
                'username' => 'required|unique:users',
            ]);
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
        $u->name = $request->name;
        $u->username = $request->username;
        $u->slug = rand(1, 99).str_slug($request->name).rand(1,99);

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
//        if ($cmonth == 1){
//            $pmonth = 12;
//        }else {
//            $pmonth = $cmonth - 1 ;
//        }


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

        // remove duplicate entries from $members[] as it will add all old members from all month
        $userdupe=array();
        foreach ($members as $index=>$t) {
            if (isset($userdupe[$t["slug"]])) {
                unset($members[$index]);
                continue;
            }
            $userdupe[$t["slug"]]=true;
        }
//        dd($members);

//        $msPm = $mM->mealsystems()->where('month', $pmonth)->first();
//        $Pmembers = $msPm->users()->get();
//        // $Pmembers is an object that has collection of past month user(s)
//        $msCm = $mM->mealsystems()->where('month', $cmonth)->first();
//        $CMembers = $msCm->users()->get();
//        // $CMembers is an object that has collection of current month user(s)
//
//        $members = [];
//        foreach ($Pmembers as $pmm){
//            // $pmm is an user object
//            if (!$CMembers->contains('name', $pmm->name)){
//                // here we het $pmm as user object that is not in current month
//                $members[] = $pmm;
//            }
//        }

        $msid = $msCm->id;
//        dd($members);

        return view('member.addOldMember', compact('members', 'msid'));


    }


    public function oldMadd(Request $request, $msid)
    {
//        dd($msid);
//        option field
//        $u = User::find($request->member_id);
//        $ms = Mealsystem::find($msid);
//        $ms->users()->attach($u);
//        return redirect()->route('home');
        ///////////////
        // Check Box
        $ms = Mealsystem::find($msid);
        $ids = $request->input('member_ids');
        foreach ($ids as $id){
            $u = User::find($id);
            $ms->users()->attach($u);
        }
        return redirect()->route('home');
    }


}
