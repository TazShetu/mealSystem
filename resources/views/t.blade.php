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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($naD as $d)
                                    <tr>
                                        <td>{{$d->day}} / {{$d->month}}</td>
                                        @if($d->dbm === null)
                                            <td>{{$d->meal}}</td>
                                            <td>{{$d->bazar}}</td>
                                            <td>{{$d->deposit}}</td>
                                            <td>
                                                <a href="{{route('memdata.ea.own', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-success btn-sm mr-1 mb-1">Edit</a>
                                                <a href="{{route('member.DownD', ['id' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">&#10006;</a>
                                            </td>
                                        @else
                                            <td>&#10006;</td>
                                            <td>&#10006;</td>
                                            <td>&#10006;</td>
                                            <td>
                                                <a href="{{route('delete.undo', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-info btn-sm mb-1" onclick="return confirm('Are you sure?')">undo delete</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                       </div>
                   @endif
                   @if(count($dA) > 0)
                   <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Meal</th>
                            <th>Bazar</th>
                            <th>Deposit</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($dA as $d)
                                <tr>
                                    <td>{{$d->day}} / {{$d->month}}</td>
                                    <td>{{$d->meal}}</td>
                                    <td>{{$d->bazar}}</td>
                                    <td>{{$d->deposit}}</td>
                                    <td>
                                        @role(['admin','mealManager'])
                                            <a href="{{route('datam.t.edit', ['slug' => $d->user->slug, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-success btn-sm mr-1 mb-1">Edit</a>
                                            <a href="{{route('datam.t.delete', ['did' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this entry?')">&#10006;</a>
                                        @else
                                            @if($d->dbm === null)
                                                <a href="{{route('data.mem.edit', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-success btn-sm mr-1 mb-1">Edit</a>
                                                <a href="{{route('data.mem.delete', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return alert('It will be deleted if Meal-Manager accept this !')">&#10006;</a>
                                            @else
                                                <a href="{{route('delete.undo', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-info btn-sm mb-1" onclick="return confirm('Are you sure?')">undo delete</a>
                                            @endif
                                        @endrole
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                   </table>
                   @else
                       <div class="col">
                           <div class="card bg-success">
                               <div class="card-header text-warning text-center"><h1>Nothing to show yet !</h1></div>
                           </div>
                       </div>
                   @endif
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