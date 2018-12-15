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
            return view('member.no_ms');
        }
    }

    public function Pcreate()
    {
//        dd('dgdsg');
        $a = Auth::user();
        $cm = Carbon::now()->month;
        if ($cm == 1){
            $pm = 12;
        }else {
            $pm = $cm - 1 ;
        }
        $ms = $a->mealsystems()->where('month', $pm)->first();
        return view('member.Pcdata', compact('ms'));
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

            $check = Memdata::where('user_id', Auth::id())->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
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


    public function Pstore(Request $request, $msid)
    {
        $this->validate($request, [
            'day' => 'required'
        ]);
        $ms = Mealsystem::find($msid);
        $check = Memdata::where('user_id', Auth::id())->where('mealsystem_id', $msid)->where('day', $request->day)->where('month', $ms->month)->first();
        if ($check){
            $check->delete();
        }
        $d = new Memdata;
        $d->user_id = Auth::id();
        $d->mealsystem_id = $msid;
        $d->month = $ms->month;
        $d->day = $request->day;
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

        return redirect()->route('lhome', ['msid' => $msid]);
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



    public function showmemd($month){
        $mm = Auth::user();
        $ms = $mm->mealsystems()->where('month', $month)->first();
        if ($ms){
            $memdata = Memdata::where('mealsystem_id', $ms->id)->get();
        } else {
            $ms = new Mealsystem;
            $ms->month = Carbon::now()->month;
            $ms->save();
            $ms->users()->attach($mm);
            $memdata = Memdata::where('mealsystem_id', 0)->get();
            // tecnique to create empty collection of array   (msid 0 is impossible)
        }
        $cm = Carbon::now()->month;
        if (($month * 1) === $cm){
            $mmm = $cm;
            $nmm = 0;
        }else {
            // here we are in past month
            if (($month * 1) === 12){
                $nmm = 1;
            }else{
                $nmm = $month + 1;
            }
            $mmm = 0;
        }
//        dd($nmm);
        return view('member.datashowtable', compact('memdata', 'mmm', 'nmm', 'cm'));
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
        $mdata = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        $mdata->delete();


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
        $mealS = Mealsystem::find($msid);
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

    public function deleteown($id){
        $d = Memdata::find($id);
        $d->delete();
        return redirect()->back();
    }


    public function esOwn($uid, $msid, $m, $d){
        $memD = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
        return view('member.editown', compact('memD'));
    }


    public function upOwn(Request $request, $uid, $msid, $m, $d){
        $data = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $d)->where('month', $m)->first();
//        $data->user_id = $uid;
//        $data->mealsystem_id = $msid;
//        $data->month = $m;
//        $data->day = $d;
        if ($request->has('meal')){
            $data->meal = $request->meal;
        }
        if ($request->has('bazar')){
            $data->bazar = $request->bazar;
        }
        if ($request->has('deposit')){
            $data->deposit = $request->deposit;
        }
        $data->update();
        return redirect()->route('p.table', ['slug' => $data->user->slug, 'id' => $msid]);
    }


//    public function memTDelete($did){
////        $data = Datam::find($did);
////        $uid = $data->user_id;
////        $msid = $data->mealsystem_id;
////        $month = $data->month;
////        $day = $data->day;
////
////        $memD = Memdata::where('user_id', $uid)->where('mealsystem_id', $msid)->where('month', $month)->where('day', $day)->first();
////        if ($memD){
////            $memD->delete();
////        }
////        $d = new Memdata;
////        $d->user_id = $uid;
////        $d->mealsystem_id = $msid;
////        $d->month = $month;
////        $d->day = $day;
////        $d->meal = 0;
////        $d->bazar = 0;
////        $d->deposit = 0;
////        $d->save();
////        return redirect()->back();
////    }

}
