<?php

namespace App\Http\Controllers;

use App\Datam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mealsystem;

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
        // find Suthuser mealSystem of current month
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
    public function store(Request $request)
    {
        //
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
