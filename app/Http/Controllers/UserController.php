<?php

namespace App\Http\Controllers;

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
            'username' => 'required|unique:users',
        ]);
        $u = User::where('slug', $slug)->first();
//        dd($u);
        $u->name = $request->name;
        $u->username = $request->username;
        $u->slug = rand(1, 99).str_slug($request->name).rand(1,99);
//        dd($u);
        $u->save();

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
}
