<?php

namespace App\Http\Controllers;

use App\Amountu;
use App\Expense;
use App\Mealsystem;
use App\User;
use Carbon\Carbon;
use function Composer\Autoload\includeFile;
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

        if (($month * 1) === 1){
            $pm = 12;
        }else {
            $pm = $month - 1;
        }
        $pms = $u->mealsystems->where('month', $pm)->first();
        if (is_null($pms)){
            // pms does not exist
            $x = 0;
            $pmn = null;
        }else{
            $x = 1;
            $po = \DateTime::createFromFormat('!m', $pm);
            $pmn = $po->format('F');
        }
        $nmn = null;

        $nd = 1;

        $u = Auth::user();

        return view('exp.index', compact('amounts', 'ms', 'mn', 'pmn', 'x', 'pms', 'nmn', 'nd', 'u'));
    }


    public function pindex($pmsid){
        $amounts = Amountu::where('mealsystem_id', $pmsid)->get();
        $ms = Mealsystem::find($pmsid);
        $pm = $ms->month;
        $o = \DateTime::createFromFormat('!m', $pm);
        $mn = $o->format('F');
        $pms = null;
        $pmn = null;
        $x = null;
        if (($pm * 1) === 12){
            $nm = 1;
        }else {
            $nm = $pm + 1;
        }
        $no = \DateTime::createFromFormat('!m', $nm);
        $nmn = $no->format('F');
        $nd = 2;
        $u = Auth::user();
        return view('exp.index', compact('amounts', 'ms', 'mn', 'pmn', 'x', 'pms', 'nmn', 'nd', 'u'));

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


    public function Mcreate($slug, $msid)
    {
        $ms = Mealsystem::find($msid);
        $u = User::where('slug', $slug)->first();
        return view('exp.member.create', compact('ms', 'u'));
    }


    public function pcreate($msid)
    {
        $pms = Mealsystem::find($msid);
        $pm = $pms->month;
        $po = \DateTime::createFromFormat('!m', $pm);
        $pmn = $po->format('F');
        return view('exp.pcreate', compact('pms', 'pmn', 'pm'));
    }

    public function MPcreate($slug, $msid)
    {
        $pms = Mealsystem::find($msid);
        $u = User::where('slug', $slug)->first();
        $pm = $pms->month;
        $po = \DateTime::createFromFormat('!m', $pm);
        $pmn = $po->format('F');
        return view('exp.member.pcreate', compact('pms', 'pmn', 'pm', 'u'));
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
        if(date("m", strtotime($date)) == date("m")){
            $this->validate($request, [
                'name' => 'required',
                'exp' => 'required'
            ]);
            $month = Carbon::now()->month;
            $day = date("d", strtotime($request->date));

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
            if ($request->has('remark')){
                $this->validate($request, [
                    'remark' => 'max:50'
                ]);
                $e->remark = $request->remark;
            }
            $e->save();
            $this->clculateExpA($msid);
            return redirect()->route('utility');
        }
        else {
            return redirect()->back()->with('alert', 'Please Select a date from current month.');
        }
    }


    public function Mstore(Request $request, $uid, $msid)
    {
        $this->validate($request, [
            'date' => 'required',
            'exp' => 'required'
        ]);
        $date = $request->date;
        if(date("m", strtotime($date)) == date("m")){
            $month = Carbon::now()->month;
            $day = date("d", strtotime($request->date));

            $check = Expense::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $day)->where('month', $month)->where('a', 0)->first();
            if ($check){
                $check->delete();
            }
            $e = new Expense;
            $e->user_id = $uid;
            $e->mealsystem_id = $msid;
            $e->month = $month;
            $e->day = $day;
            $e->exp = $request->exp;
            if ($request->has('remark')){
                $this->validate($request, [
                    'remark' => 'max:50'
                ]);
                $e->remark = $request->remark;
            }
            $e->save();
            return redirect()->route('utility');
        }
        else {
            return redirect()->back()->with('alert', 'Please Select a date from current month.');
        }
    }


    public function pstore(Request $request, $month, $msid)
    {
        $this->validate($request, [
            'name' => 'required',
            'exp' => 'required'
        ]);
        if ($month==1 || $month==3 || $month==5 || $month==7 || $month==8 || $month==10 || $month==12){
            $this->validate($request, [
                'day' => 'required|integer|between:1,31'
            ]);
        }elseif ($month==4 || $month==6 || $month==9 || $month==11){
            $this->validate($request, [
                'day' => 'required|integer|between:1,30'
            ]);
        }else{
            $this->validate($request, [
                'day' => 'required|integer|between:1,28'
            ]);
        }

        $check = Expense::where('user_id', $request->name)->where('mealsystem_id', $msid)->where('day', $request->day)->where('month', $month)->first();
        if ($check){
            $check->delete();
        }
        $e = new Expense;
        $e->user_id = $request->name;
        $e->mealsystem_id = $msid;
        $e->month = $month;
        $e->day = $request->day;
        $e->exp = $request->exp;
        $e->a = 1;
        if ($request->has('remark')){
            $this->validate($request, [
                'remark' => 'max:50'
            ]);
            $e->remark = $request->remark;
        }
        $e->save();

        $this->clculateExpA($msid);
        return redirect()->route('p.utility', ['pmsid' => $msid]);

    }

    public function MPstore(Request $request, $uid, $msid, $month)
    {
        $this->validate($request, [
            'exp' => 'required'
        ]);
        if ($month==1 || $month==3 || $month==5 || $month==7 || $month==8 || $month==10 || $month==12){
            $this->validate($request, [
                'day' => 'required|integer|between:1,31'
            ]);
        }elseif ($month==4 || $month==6 || $month==9 || $month==11){
            $this->validate($request, [
                'day' => 'required|integer|between:1,30'
            ]);
        }else{
            $this->validate($request, [
                'day' => 'required|integer|between:1,28'
            ]);
        }

        $check = Expense::where('user_id', $uid)->where('mealsystem_id', $msid)->where('day', $request->day)->where('month', $month)->first();
        if ($check){
            $check->delete();
        }
        $e = new Expense;
        $e->user_id = $uid;
        $e->mealsystem_id = $msid;
        $e->month = $month;
        $e->day = $request->day;
        $e->exp = $request->exp;
        if ($request->has('remark')){
            $this->validate($request, [
                'remark' => 'max:50'
            ]);
            $e->remark = $request->remark;
        }
        $e->save();

        return redirect()->route('p.utility', ['pmsid' => $msid]);
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
    public function edit($eid, $msid, $uid, $month, $day)
    {
        $exp = Expense::find($eid);
        $u = User::find($uid);
        $un = $u->name;
        $co = \DateTime::createFromFormat('!m', $month);
        $mn = $co->format('F');
        return view('exp.edit', compact('exp', 'un', 'day', 'mn', 'msid'));
    }


    public function Medit($eid, $msid, $month, $day)
    {
        $exp = Expense::find($eid);
//        $u = User::find($uid);
//        $un = $u->name;
        $co = \DateTime::createFromFormat('!m', $month);
        $mn = $co->format('F');
        return view('exp.member.edit', compact('exp', 'day', 'mn', 'msid'));
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
        if ($request->has('remark')){
            $this->validate($request, [
                'remark' => 'max:50'
            ]);
            $e->remark = $request->remark;
        }
        $e->a = 1;
        $e->update();
        $this->clculateExpA($msid);
        return redirect()->route('details.exps', ['msid' => $msid]);
    }

    public function Mupdate(Request $request, $eid, $msid)
    {
        $this->validate($request, [
            'exp' => 'required'
        ]);
        $e = Expense::find($eid);
        $e->exp = $request->exp;
        if ($request->has('remark')){
            $this->validate($request, [
                'remark' => 'max:50'
            ]);
            $e->remark = $request->remark;
        }
        $e->update();
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

    public function Mdestroy($eid)
    {
        $exp = Expense::find($eid);
        $exp->delete();
        return redirect()->back();
    }

    public function mMAcceptExp($eid, $msid){
        $e = Expense::find($eid);
        $e->a = 1;
        $e->update();
        $this->clculateExpA($msid);
        return redirect()->route('details.exps', ['msid' => $msid]);
    }


    public function de($msid){
        $es = Expense::where('mealsystem_id', $msid)->where('a', 1)->orderBy('day')->get();
        $u = Auth::user();
        $uaexp = Expense::where('mealsystem_id', $msid)->where('user_id', $u->id)->where('a', 0)->orderBy('day')->get();
//        dd($uaexp);
        $ms = Mealsystem::find($msid);
        $month = $ms->month;
        $x = null;
        $pmsid = null;
        $cmsid = null;
        $cmn = null;
        $pmn = null;
        $mmm= Carbon::now()->month;
        if (($month * 1) === $mmm){
            // in current month
            if (($month * 1) === 1){
                $pm = 12;
            }else{
                $pm = $month - 1;
            }
            $pms = $u->mealsystems->where('month', $pm)->first();
            if ($pms){
                $x = 1;
                $pmsid = $pms->id;
            }
            $po = \DateTime::createFromFormat('!m', $pm);
            $pmn = $po->format('F');
        }else {
            // in past month
            $x = 2;
            $ms = $u->mealsystems->where('month', $mmm)->first();
            $cmsid = $ms->id;
            $co = \DateTime::createFromFormat('!m', $mmm);
            $cmn = $co->format('F');
        }
        $staexp = null;
        if ($u->hasRole('mealManager')){
            $staexp = Expense::where('mealsystem_id', $msid)->where('a', 0)->orderBy('day')->get();
        }
//        dd($staexp);

        return view('exp.details', compact('es', 'x', 'pmn', 'cmn', 'pmsid', 'cmsid', 'uaexp', 'staexp'));
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
