<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Expense;
use App\Mealsystem;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // user er ms for current month
        $u = Auth::user();
        $month = Carbon::now()->month;
        $ms = $u->mealsystems->where('month', $month)->first();
        // for new month
        if (is_null($ms)){
            if ($u->hasRole('mealManager')){
                $ms = new Mealsystem;
                $ms->month = Carbon::now()->month;
                $ms->save();
                $ms->users()->attach($u);
            } else {
                return view('member.no_ms');
            }

        }
        $amounts = Amountu::where('mealsystem_id', $ms->id)->get();
        $co = \DateTime::createFromFormat('!m', $month);
        $mn = $co->format('F');



        return view('exp.index', compact('amounts', 'ms', 'mn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($msid)
    {
        $ms = Mealsystem::find($msid);
//        $c = $this->test(2);
//        dd($c);
        return view('exp.create', compact('ms'));
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
            'date' => 'required',
            'name' => 'required',
            'exp' => 'required'
        ]);
        $date = $request->date;
        if(date("m", strtotime($date)) == date("m")){
            $month = Carbon::now()->month;
            $day = date("d", strtotime($request->date));

//            $mData = Memdata::where('user_id', $request->name)->where('mealsystem_id', $id)->where('day', $day)->where('month', $month)->first();
//            if ($mData){
//                $user = User::find($request->name);
//                if ($mData->dbm === null){
//                    $x = 0;
//                    return view('datam.memDataExist', compact('user', 'day', 'month', 'x'));
//                }else {
//                    $x = 1;
//                    return view('datam.memDataExist', compact('user', 'day', 'month', 'x'));
//                }
//            }

            $check = Expense::where('user_id', $request->name)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->first();
            if ($check){
                $check->delete();
            }
            $e = new Expense;
            $e->user_id = $request->name;
            $e->mealsystem_id = $msid;
            $e->month = $month;
            $e->day = $day;
            $e->exp = $request->exp;
            $e->a = 1;
            $e->save();

            $this->clculateExpA($msid);
            return redirect()->route('utility');
        }
        else {
            return redirect()->back()->with('alert', 'Please Select a date from current month.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($eid, $uid, $month, $day, $msid)
    {
        $exp = Expense::find($eid);
        $u = User::find($uid);
        $un = $u->name;
        $co = \DateTime::createFromFormat('!m', $month);
        $mn = $co->format('F');
        return view('exp.edit', compact('exp', 'un', 'day', 'mn', 'msid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $eid, $msid)
    {
        $this->validate($request, [
            'exp' => 'required'
        ]);
        $e = Expense::find($eid);
        $e->exp = $request->exp;
        $e->update();
        $this->clculateExpA($msid);
        return redirect()->route('details.exps', ['msid' => $msid]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($eid, $msid)
    {
        $exp = Expense::find($eid);
        $exp->delete();
        $this->clculateExpA($msid);
        return redirect()->back();
    }


    public function de($msid){
        $es = Expense::where('mealsystem_id', $msid)->orderBy('day')->get();
        return view('exp.details', compact('es'));
    }



//    public function test($a){
//        return $a+1;
//    }

    public function clculateExpA($msid){
        $es = Expense::where('mealsystem_id', $msid)->where('a', 1)->get();
        // total exp
        $te = 0;
        foreach ($es as $exp){
            $te = $te + $exp->exp;
        }

        // all member get
        $ms = Mealsystem::find($msid);
        $users = $ms->users;
        $uc = count($users);
        $epu = $te / $uc;
//            dd($users);

        foreach ($users as $uu){
//                dd($uu);
            $eus = Expense::where('mealsystem_id', $msid)->where('a', 1)->where('user_id', $uu->id)->get();
            $tue = 0;
            foreach ($eus as $eu){
                $tue = $tue + $eu->exp;
            }
            $ea = ($tue - $epu);

            $cexpA = Amountu::where('mealsystem_id', $msid)->where('user_id', $uu->id)->first();
            if ($cexpA){
                $cexpA->expA = $ea;
                $cexpA->update();
            }else {
                $exa = new Amountu;
                $exa->user_id = $uu->id;
                $exa->mealsystem_id = $msid;
                $exa->expA = $ea;
                $exa->save();
            }
        }
    }

}
