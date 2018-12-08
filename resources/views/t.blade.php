@include('includes.header')

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
    $co = DateTime::createFromFormat('!m', $month);
    $mn = $co->format('F');
    $po = DateTime::createFromFormat('!m', $pmonth);
    $pmn = $po->format('F');
@endphp


<section id="home-section" class="ProfilE">
    <div class="t-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        @if((($cmonth * 1) === (\Carbon\Carbon::now()->month)) && $ms)
                            <a href="{{route('f.table', ['msid' => $ms->id])}}" class="btn btn-success btn-block"><i class="fa fa-table" aria-hidden="true"></i>&nbsp; <span style="font-size: 25px;"> Full Table {{$mn}}</span></a>
                        @endif
                        @if((($cmonth * 1) !== (\Carbon\Carbon::now()->month)) && $pms)
                            <a href="{{route('f.table', ['msid' => $pms->id])}}" class="btn btn-success btn-block" ><i class="fa fa-table" aria-hidden="true"></i>&nbsp; <span style="font-size: 25px;"> Full Table {{$pmn}}</span></a>
                        @endif
                        <br>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                   @if(!$naD->isEmpty())
                       <div class="col">
                           <h3 class="text-center bg-light text-dark">Still Not Accepted Data</h3>

                            <table class="table table-hover bg-light text-dark">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Meal</th>
                                    <th>Bazar</th>
                                    <th>Deposit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($naD as $d)
                                    <tr>
                                        <td>{{$d->day}} / {{$d->month}}</td>
                                        <td>{{$d->meal}}</td>
                                        <td>{{$d->bazar}}</td>
                                        <td>{{$d->deposit}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                       </div>
                   @endif
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Meal</th>
                            <th>Bazar</th>
                            <th>Deposit</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($dA as $d)
                                <tr>
                                    <td>{{$d->day}} / {{$d->month}}</td>
                                    <td>{{$d->meal}}</td>
                                    <td>{{$d->bazar}}</td>
                                    <td>{{$d->deposit}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        @if((($cmonth * 1) === (\Carbon\Carbon::now()->month)) && $pms)
                                <a href="{{route('p.table', ['slug' => $a->slug, 'id' => $pms->id])}}" class="btn btn-success pull-left"><i class="fa fa-angle-double-left" style="font-size: 20px;"></i> {{$pmn}}</a>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if((($cmonth * 1) !== (\Carbon\Carbon::now()->month)) && $ms)
                                <a href="{{route('p.table', ['slug' => $a->slug, 'id' => $ms->id])}}" class="btn btn-success pull-right">{{$mn}} <i class="fa fa-angle-double-right" style="font-size: 20px;"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--.......main Footer....  -->
{{--@include('includes.footer')--}}


@include('includes.euModal')
<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

</body>
</html>