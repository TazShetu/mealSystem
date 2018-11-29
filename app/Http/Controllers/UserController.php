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
        return view('mmHome');
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


    public function oldma($id){
    // if Cms exist then do this
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
        if ($cmonth == 1){
            $pmonth = 12;
        }else {
            $pmonth = $cmonth - 1 ;
        }
        $msPm = $mM->mealsystems()->where('month', $pmonth)->first();
        $Pmembers = $msPm->users()->get();
        // $Pmembers is an object that has collection of past month user(s)
//        dd($Pmembers);
        $msCm = $mM->mealsystems()->where('month', $cmonth)->first();
        $CMembers = $msCm->users()->get();
        // $CMembers is an object that has collection of current month user(s)
//        dd($CMembers);

//        $members = (object)[];
        $members = [];
        foreach ($Pmembers as $pmm){
            // $pmm is an user object
//            dd($pmm);
            if (!$CMembers->contains('name', $pmm->name)){
                // here we het $pmm as user object that is not in current month
//                dd($pmm);
                // add $pmm to $members(collection of object)
//                $pmm->push($members);          not working
                $members[] = $pmm;
            }
        }
//        dd($members);

        return view('member.addOldMember', compact('members'));

    // else create a new mS the do the upper
    }

}
