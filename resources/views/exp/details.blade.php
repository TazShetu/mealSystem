@include('includes.header')

<!--....NAV BAR....  -->
@include('includes.navbar')

{{--@php--}}
    {{--// for previous month (route get {slug} {mSid})--}}
    {{--$month = \Carbon\Carbon::now()->month;--}}
    {{--$a = Auth::user();--}}
    {{--$ms = $a->mealsystems()->where('month', $month)->first();--}}

    {{--// previous month to current month (route get {slug} {mSid})--}}
    {{--if ($month == 1){--}}
            {{--$pmonth = 12;--}}
    {{--}else {--}}
            {{--$pmonth = $month - 1 ;--}}
    {{--}--}}
    {{--$pms = $a->mealsystems()->where('month', $pmonth)->first();--}}
    {{--$co = DateTime::createFromFormat('!m', $month);--}}
    {{--$mn = $co->format('F');--}}
    {{--$po = DateTime::createFromFormat('!m', $pmonth);--}}
    {{--$pmn = $po->format('F');--}}
{{--@endphp--}}

<header id="home-section" class="TablE">
    <div class="t-overlay">
        <div class="home-inner">
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-lg-12 text-center">--}}
                        {{--@if((($cmonth * 1) === (\Carbon\Carbon::now()->month)) && $ms)--}}
                            {{--<a href="{{route('p.table', ['slug' => $a->slug, 'id' => $ms->id])}}" class="btn btn-success btn-block" ><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; <span style="font-size: 25px;"> Own info {{$mn}}</span></a>--}}
                        {{--@endif--}}
                        {{--@if((($cmonth * 1) !== (\Carbon\Carbon::now()->month)) && $pms)--}}
                            {{--<a href="{{route('p.table', ['slug' => $a->slug, 'id' => $pms->id])}}" class="btn btn-success btn-block" ><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; <span style="font-size: 25px;"> Own info {{$pmn}}</span></a>--}}
                        {{--@endif--}}
                        {{--<br>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="container">
                <div class="row">
                    <!--loop start of DATE-->
                    @if(count($es) > 0)
                    @foreach($es->groupBy('day') as $ds)
                        {{--$ds is a collection of array--}}
                        <h1>{{$ds[0]->day}} - {{$ds[0]->month}}</h1>
                        <table class="table table-hover bg-light text-dark">
                            <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Expenses</th>
                                @role(['admin', 'mealManager'])
                                    <th></th>
                                @else
                                    <th></th>
                                @endrole
                            </tr>
                            </thead>
                            <tbody>
                            <!--loop start for member-->
                            @foreach($ds as $d)
                                <tr class="text-center">
                                    <td>{{$d->user->name}}</td>
                                    <td>{{$d->exp}}</td>
                                    @role(['admin', 'mealManager'])
                                        <td>
                                            <a href="{{route('exp.edit', ['eid' => $d->id, 'msid' => $d->mealsystem_id, 'uid' => $d->user_id, 'month' => $d->month, 'day' => $d->day])}}" class="btn btn-outline-primary btn-sm mb-1">Edit</a>
                                            <a href="{{route('exp.delete', ['eid' => $d->id, 'msid' => $d->mealsystem_id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this Expense?')">&#10006;</a>
                                        </td>
                                    @else
                                        <td>
                                            <a href="" class="btn btn-outline-info btn-sm mb-1">Edit</a>
                                            <a href="" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this Expense?')">&#10006;</a>
                                        </td>
                                    @endrole
                                </tr>
                            @endforeach
                            <!--loop end for member-->
                            </tbody>
                        </table>
                    @endforeach
                    @else
                    <div class="col">
                        <div class="card">
                            <div class="card-header text-dark text-center"><h1>Nothing to show yet !</h1></div>
                        </div>
                    </div>
                    @endif
                <!--loop end of DATE-->
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        @if(($x * 1) === 1)
                            <a href="{{route('details.exps', ['msid' => $pmsid])}}" class="btn btn-light pull-left"><i class="fa fa-angle-double-left" style="font-size: 20px;"></i> {{$pmn}}</a>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if(($x * 1) === 2)
                            <a href="{{route('details.exps', ['msid' => $cmsid])}}" class="btn btn-light pull-right">{{$cmn}} <i class="fa fa-angle-double-right" style="font-size: 20px;"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@include('includes.euModal')

<!--.......main Footer....  -->
{{--@include('includes.footer')--}}

<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

</body>
</html>