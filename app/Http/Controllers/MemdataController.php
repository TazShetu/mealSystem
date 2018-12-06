<?php

namespace App\Http\Controllers;

use App\Memdata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemdataController extends Controller
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
        $a = Auth::user();
        $mss = $a->mealsystems()->get();
        $x = 0;
        foreach ($mss as $m){
            if ($m->month == Carbon::now()->month){
                $ms = $m;
                $x = 1;
                return view('member.cdata', compact('ms'));
                break;
            }
        }
        // for new month
        if ($x !== 1){
            return view('member.noms');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $msid)
    {
        $this->validate($request, [
            'date' => 'required'
        ]);
        $date = $request->date;
        if(date("m", strtotime($date)) == date("m"))
        {
            $month = Carbon::now()->month;
            $day = date("d", strtotime($request->date));

            $check = Memdata::where('user_id', $request->name)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
            if ($check){
                $check->delete();
            }
            $d = new Memdata;
            $d->user_id = Auth::id();
            $d->mealsystem_id = $msid;
            $d->month = $month;
            $d->day = $day;
            if ($request->has('meal')){
                $d->meal = $request->meal;
            }
            if ($request->has('bazar')){
                $d->bazar = $request->bazar;
            }
            if ($request->has('deposit')){
                $d->deposit = $request->deposit;
            }
            $d->save();
            return redirect()->route('home');
        }
        else {
            return redirect()->back()->with('alert', 'Please Select a date from current month.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Memdata  $memdata
     * @return \Illuminate\Http\Response
     */
    public function show(Memdata $memdata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memdata  $memdata
     * @return \Illuminate\Http\Response
     */
    public function edit(Memdata $memdata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memdata  $memdata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memdata $memdata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memdata  $memdata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memdata $memdata)
    {
        //
    }



    public function showmemd(){
        // get msid of mM
        // get all data



        return view('member.datashowtable');
    }


}
