<?php

namespace App\Http\Controllers;

use App\Memdata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Datam;
use App\Mealsystem;
use App\Amountu;

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
    public function destroy($id)
    {
        $d = Memdata::find($id);
        $d->delete();
        return redirect()->back();
    }



    public function showmemd(){
        $mm = Auth::user();
        $cm = Carbon::now()->month;
        $ms = $mm->mealsystems()->where('month', $cm)->first();
        $memdata = Memdata::where('mealsystem_id', $ms->id)->get();
        // $memdata is a collection of array
//        dd($memdata);
        return view('member.datashowtable', compact('memdata'));
    }



    public function saveE($id){
        $md = Memdata::find($id);
        $check = Datam::where('user_id', $md->user_id)->where('mealsystem_id', $md->mealsystem_id)->where('day', $md->day)->where('month', $md->month)->first();
        if ($check){
            $check->delete();
        }
        $d = new Datam;
        $d->user_id = $md->user_id;
        $d->mealsystem_id = $md->mealsystem_id;
        $d->month = $md->month;
        $d->day = $md->day;
        if ($md->meal){
            $d->meal = $md->meal;
        }
        if ($md->bazar){
            $d->bazar = $md->bazar;
        }
        if ($md->deposit){
            $d->deposit = $md->deposit;
        }
        $d->save();


        $md->delete();


        $dCA = Datam::where('mealsystem_id', $d->mealsystem_id)->where('month', $d->month)->get();
        $tb = 0;
        $tm = 0;
        foreach ($dCA as $dA){
            $tb = $tb + $dA->bazar;
            $tm = $tm + $dA->meal;
        }
        if ($tm){
            $mr = $tb / $tm;
        }else{
            $mr = 0;
        }
        $mealS = Mealsystem::where('id', $d->mealsystem_id)->where('month', $d->month)->first();
        $mealS->meal_rate = $mr;
        $mealS->update();

        $users = $mealS->users()->get();

        $tdo = 0;
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $d->month)->get();
            foreach ($dataA as $data){
                $tdo = $tdo + $data->deposit;
            }
        }
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $d->month)->get();
            $tb = 0;
            $tm = 0;
            $td = 0;
            foreach ($dataA as $data){
                $tb = $tb + $data->bazar;
                $tm = $tm + $data->meal;
                $td = $td + $data->deposit;
            }

            if ($user->hasRole('mealManager')){
                if ($mr){
                    $mrr = round($mr);
                    $amount = $td - $tdo + $tb - ($mrr * $tm);
                }else{
                    $amount = $td - $tdo + $tb;
                }
            }else{
                if ($mr){
                    $mrr = round($mr);
                    $amount = $td + $tb - ($mrr * $tm);
                }else{
                    $amount = $td + $tb;
                }
            }
            $ar = Amountu::where('user_id', $user->id)->where('mealsystem_id', $d->mealsystem_id)->first();
            if ($ar){
                $ar->amount = $amount;
                $ar->update();
            }else {
                $ar = new Amountu;
                $ar->user_id = $user->id;
                $ar->mealsystem_id = $d->mealsystem_id;
                $ar->amount = $amount;
                $ar->save();
            }
        }

        return redirect()->back();
    }


    public function es(Request $request, $uid, $msid, $m, $d){
        $check = Datam::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        if ($check){
            $check->delete();
        }
        $data = new Datam;
        $data->user_id = $uid;
        $data->mealsystem_id = $msid;
        $data->month = $m;
        $data->day = $d;
        if ($request->has('meal')){
            $data->meal = $request->meal;
        }
        if ($request->has('bazar')){
            $data->bazar = $request->bazar;
        }
        if ($request->has('deposit')){
            $data->deposit = $request->deposit;
        }
        $data->save();

        // delete memdata
        $a = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        $a->delete();


        $dCA = Datam::where('mealsystem_id', $msid)->where('month', $m)->get();
        $tb = 0;
        $tm = 0;
        foreach ($dCA as $dA){
            $tb = $tb + $dA->bazar;
            $tm = $tm + $dA->meal;
        }
        if ($tm){
            $mr = $tb / $tm;
        }else{
            $mr = 0;
        }
        $mealS = Mealsystem::where('id', $msid)->where('month', $m)->first();
        $mealS->meal_rate = $mr;
        $mealS->update();

        $users = $mealS->users()->get();

        $tdo = 0;
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $m)->get();
            foreach ($dataA as $data){
                $tdo = $tdo + $data->deposit;
            }
        }
        foreach ($users as $user){
            $dataA = Datam::where('user_id', $user->id)->where('month' , $m)->get();
            $tb = 0;
            $tm = 0;
            $td = 0;
            foreach ($dataA as $data){
                $tb = $tb + $data->bazar;
                $tm = $tm + $data->meal;
                $td = $td + $data->deposit;
            }

            if ($user->hasRole('mealManager')){
                if ($mr){
                    $mrr = round($mr);
                    $amount = $td - $tdo + $tb - ($mrr * $tm);
                }else{
                    $amount = $td - $tdo + $tb;
                }
            }else{
                if ($mr){
                    $mrr = round($mr);
                    $amount = $td + $tb - ($mrr * $tm);
                }else{
                    $amount = $td + $tb;
                }
            }
            $ar = Amountu::where('user_id', $user->id)->where('mealsystem_id', $msid)->first();
            if ($ar){
                $ar->amount = $amount;
                $ar->update();
            }else {
                $ar = new Amountu;
                $ar->user_id = $user->id;
                $ar->mealsystem_id = $msid;
                $ar->amount = $amount;
                $ar->save();
            }
        }
        return redirect()->back();

    }


}
