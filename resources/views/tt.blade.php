@include('includes.header')

<!--....NAV BAR....  -->
@include('includes.navbar')

@php
    // for previous month (route get {slug} {mSid})
    $month = \Carbon\Carbon::now()->month;
    $a = Auth::user();
    $ms = $a->mealsystems()->where('month', $month)->first();

    // previous month to current month (route get {slug} {mSid})
    if ($month == 1){
            $pmonth = 12;
    }else {
            $pmonth = $month - 1 ;
    }
    $pms = $a->mealsystems()->where('month', $pmonth)->first();

@endphp

<header id="home-section" class="TablE">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        @if($cmonth == (\Carbon\Carbon::now()->month && $ms))
                            <a href="{{route('p.table', ['slug' => $a->slug, 'id' => $ms->id])}}" class="btn btn-success btn-block" ><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; <span style="font-size: 25px;"> View personal Table</span></a>
                        @endif
                        @if($cmonth !== \Carbon\Carbon::now()->month && $pms)
                            <a href="{{route('p.table', ['slug' => $a->slug, 'id' => $pms->id])}}" class="btn btn-success btn-block" ><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; <span style="font-size: 25px;"> View personal Table</span></a>
                        @endif
                        <br>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <!--loop start of DATE-->
                    @foreach($datams->groupBy('day') as $ds)
                    {{--$ds is a collection of array--}}
                    <h1 class="text-center pull-right">{{$ds[0]->day}} - {{$ds[0]->month}}</h1>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Meal</th>
                                <th>Bazar</th>
                                <th>Deposit</th>
                                @role(['admin', 'mealManager'])
                                    <th></th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                        <!--loop start for member-->
                        @foreach($ds as $d)
                            <tr>
                                <td>{{$d->user->name}}</td>
                                <td>{{$d->meal}}</td>
                                <td>{{$d->bazar}}</td>
                                <td>{{$d->deposit}}</td>
                                @role(['admin', 'mealManager'])
                                    @if($d->month == $month)
                                        <td><a href="{{route('datam.t.edit', ['slug' => $d->user->slug, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-success btn-sm">Edit</a></td>
                                    @endif
                                @endrole
                        @endforeach
                        <!--loop end for member-->
                        </tbody>
                    </table>
                    @endforeach
                    <!--loop end of DATE-->
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        @if($cmonth == (\Carbon\Carbon::now()->month) && $pms)
                            <a href="{{route('f.table', ['msid' => $pms->id])}}" class="btn btn-success pull-left"><i class="fa fa-angle-double-left" style="font-size: 20px;"></i> Previous Month</a>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if($cmonth !== \Carbon\Carbon::now()->month && $ms)
                            <a href="{{route('f.table', ['msid' => $ms->id])}}" class="btn btn-success pull-right">Current Month <i class="fa fa-angle-double-right" style="font-size: 20px;"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!--.......main Footer....  -->
@include('includes.footer')

<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

</body>
</html>