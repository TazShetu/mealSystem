<?php

namespace App\Http\Controllers;

use App\Datam;
use App\Mealsystem;
use App\Memdata;
use App\User;
use Illuminate\Http\Request;

class PtableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug, $id)
    {
//        dd($id);
        $u = User::where('slug', $slug)->first();
        $uid = $u->id;
        $dA = Datam::where('user_id', $uid)->where('mealsystem_id', $id)->get();
        $ms = Mealsystem::find($id);
        $cmonth = $ms->month;

        $naD = Memdata::where('user_id', $uid)->where('mealsystem_id', $id)->get();

        return view('t', compact('dA' , 'cmonth', 'naD'));
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
        //
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
    public function update(Request $request, $id)
    {
        //
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


    public function tt($msid)
    {
        $datams = Datam::where('mealsystem_id', $msid)->get();

        $ms = Mealsystem::find($msid);
        $cmonth = $ms->month;

        return view('tt', compact('datams', 'cmonth'));
    }


}
