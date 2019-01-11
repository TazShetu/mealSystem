<?php

namespace App\Http\Controllers;

use App\mealandbazargraph;
use App\Mealsystem;
use App\Notifications\SendContactNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use vendor\project\StatusTest;

use App\User;
use Illuminate\Support\Facades\Auth;

class MealsystemController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        // create user with mealManager role
        $u = new User;
        $u->name = $request->name;
        $u->username = $request->username;
        $u->slug = str_slug($request->name)."-".str_slug($request->username);
        $u->password = bcrypt($request->password);
        $u->save();
        $u->attachRole('mealManager');
        Auth::loginUsingId($u->id);

        // create meal system with current month and make created user user a member of it
        $ms = new Mealsystem;
        $month = Carbon::now()->month;
        $ms->month = $month;
        $ms->save();
        $ms->users()->attach($u);

        // total meal + bazar table banano and put default o for graph ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            $days = 31;
        } elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11){
            $days = 30;
        } else {
            $days = 28;
        }
        for ($i = 1; $i <= $days; $i++){
            $newMaB = new mealandbazargraph;
            $newMaB->mealsystem_id = $ms->id;
            $newMaB->day = $i;
            $newMaB->month = $month;
            $newMaB->save();
        }

        return redirect()->route('home');
    }
























    public function index()
    {
        //
    }


    public function contact(){
        return view('contact');
    }

    public function contactSent(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|max:50',
            'message' => 'required'
        ]);
        Notification::route('mail', 'test@g.com')->notify(new SendContactNotification($request));
        Session::flash('success', 'Email was sent successfully. Thanks for your query.');
        return redirect()->back();
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
