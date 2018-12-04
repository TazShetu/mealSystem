<?php

namespace App\Http\Controllers;

use App\Mealsystem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use vendor\project\StatusTest;

use App\User;
use Illuminate\Support\Facades\Auth;

class MealsystemController extends Controller
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
        //
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
            'password' => 'required|confirmed|min:6',
        ]);
        // create user with mealManager role
        $u = new User;
        $u->name = $request->name;
        $u->username = $request->username;
        $u->slug = rand(1, 99).str_slug($request->name).rand(1,99);
        $u->password = bcrypt($request->password);
        $u->save();
        $u->attachRole('mealManager');
        Auth::loginUsingId($u->id);
        // user created

        // create meal system with current month and make created user user a member of it
        $ms = new Mealsystem;
        $ms->month = Carbon::now()->month;
        $ms->save();
        $ms->users()->attach($u);

        return redirect('home');
        // just for now we have a /home route
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mealsystem  $mealsystem
     * @return \Illuminate\Http\Response
     */
    public function show(Mealsystem $mealsystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mealsystem  $mealsystem
     * @return \Illuminate\Http\Response
     */
    public function edit(Mealsystem $mealsystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mealsystem  $mealsystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mealsystem $mealsystem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mealsystem  $mealsystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mealsystem $mealsystem)
    {
        //
    }
}
