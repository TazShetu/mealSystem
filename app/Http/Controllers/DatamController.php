<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Datam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mealsystem;
use Illuminate\Support\Facades\Session;

class DatamController extends Controller
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
        // find Auth-user mealSystem of current month
        $a = Auth::user();
        $mss = $a->mealsystems()->get();
        $x = 0;
        foreach ($mss as $m){
            if ($m->month == Carbon::now()->month){
                $ms = $m;
                $x = 1;
                return view('datam.create', compact('ms'));
                break;
            }
        }
        // for new month
        if ($x != 1){
            $ms = new Mealsystem;
            $ms->month = Carbon::now()->month;
            $ms->save();
            $ms->users()->attach($a);
            return view('datam.create', compact('ms'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required',
            'name' => 'required',
//            'meal' => 'integer',
//            'bazar' => 'integer'
        ]);
        $date = $request->date;
        if(date("m", strtotime($date)) == date("m"))
        {
            $month = Carbon::now()->month;
            $day = date("d", strtotime($request->date));

            $check = Datam::where('user_id', $request->name)->where('mealsystem_id', $id)->where('day', $day)->where('month', $month)->first();
            if ($check){
                $check->user_id = $request->name;
                $check->mealsystem_id = $id;
                $check->month = $month;
                $check->day = $day;
                if ($request->has('meal')){
                    $check->meal = $request->meal;
                }
                if ($request->has('bazar')){
                    $check->bazar = $request->bazar;
                }
                $check->update();

                $dCA = Datam::where('mealsystem_id', $id)->where('month', $month)->get();
                $tb = 0;
                $tm = 0;
                foreach ($dCA as $dA){
                    $tb = $tb + $dA->bazar;
                    $tm = $tm + $dA->meal;
                }
                $mr = $tb / $tm;
                //                dd($mr);
                $mealS = Mealsystem::where('id', $id)->where('month', $month)->first();
                $mealS->meal_rate = $mr;
                $mealS->update();

                $users = $mealS->users()->get();
                foreach ($users as $user){
                    $dataA = Datam::where('user_id', $user->id)->where('month' , $month)->get();
                    $tb = 0;
                    $tm = 0;
                    foreach ($dataA as $data){
                        $tb = $tb + $data->bazar;
                        $tm = $tm + $data->meal;
                    }
                    $mrr = round($mr);
                    $amount = $tb - ($mrr * $tm);

                    // get user_id($user->id) and mealsystem_id ($id)
                    // find that row in amountus table
                    $ar = Amountu::where('user_id', $user->id)->where('mealsystem_id', $id)->first();
                    $ar->amount = $amount;
                    $ar->update();
                }

                return redirect('hh');

            } else {
                $d = new Datam;
                $d->user_id = $request->name;
                $d->mealsystem_id = $id;
                $d->month = $month;
                $d->day = $day;
                if ($request->has('meal')){
                    $d->meal = $request->meal;
                }
                if ($request->has('bazar')){
                    $d->bazar = $request->bazar;
                }
                $d->save();

                $dCA = Datam::where('mealsystem_id', $id)->where('month', $month)->get();
                $tb = 0;
                $tm = 0;
                foreach ($dCA as $dA){
                    $tb = $tb + $dA->bazar;
                    $tm = $tm + $dA->meal;
                }
                $mr = $tb / $tm;
                $mealS = Mealsystem::where('id', $id)->where('month', $month)->first();
                $mealS->meal_rate = $mr;
                $mealS->update();

                $users = $mealS->users()->get();
                foreach ($users as $user){
                    $dataA = Datam::where('user_id', $user->id)->where('month' , $month)->get();
                    $tb = 0;
                    $tm = 0;
                    foreach ($dataA as $data){
                        $tb = $tb + $data->bazar;
                        $tm = $tm + $data->meal;
                    }
                    $mrr = round($mr);
                    $amount = $tb - ($mrr * $tm);
                    $ar = Amountu::where('user_id', $user->id)->where('mealsystem_id', $id)->first();
                    if ($ar){
                        $ar->amount = $amount;
                        $ar->save();
                    }else {
                        $ar = new Amountu;
                        $ar->user_id = $user->id;
                        $ar->mealsystem_id = $id;
                        $ar->amount = $amount;
                        $ar->save();
                    }
                }

                return redirect('hh');
            }
        }
        else {
            return redirect()->back()->with('alert', 'Please Select a date from current month.');
        }




        // calculate amount+- for all user ////////////////////////////////
        // get mealsystem_id >>>> $id
        // get month >>>> month
        // get all the user of that month>mealSystem
//        $mealSystem = Mealsystem::find($id);      // $mealS
//        $users = $mealSystem->users()->get();
//        // foreach user
//        foreach ($users as $user){
//            // get users total bazar and total meal
//            $dataA = Datam::where('user_id', $user->id)->where('month' , $month);
//            $tb = 0;
//            $tm = 0;
//            foreach ($dataA as $data){
//                $tb = $tb + $data->bazar;
//                $tm = $tm + $data->meal;
//            }
//            // amount = (mealRate * total meal) - total bazar
//            $amount = ($mr * $tm) - $tb;
//            $user->amont = $amount;
//            $user->update;

    }








    /**
     * Display the specified resource.
     *
     * @param  \App\Datam  $datam
     * @return \Illuminate\Http\Response
     */
    public function show(Datam $datam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Datam  $datam
     * @return \Illuminate\Http\Response
     */
    public function edit(Datam $datam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Datam  $datam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Datam $datam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Datam  $datam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Datam $datam)
    {
        //
    }





}
