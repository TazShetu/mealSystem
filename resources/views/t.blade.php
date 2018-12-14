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
                                        <td>{{$d->meal}}</td>
                                        <td>{{$d->bazar}}</td>
                                        <td>{{$d->deposit}}</td>
                                        <td>
                                            <button class="btn btn-outline-success btn-sm mr-1 mb-1" data-toggle="modal" data-target="#editModal">Edit</button>
                                            <a href="{{route('member.DownD', ['id' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">&#10006;</a>
                                        </td>
                                    </tr>
                                                {{--Edit Modal--}}
                                                <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title">Edit Data</h5>
                                                                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <form action="{{route('memdata.ea.own', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" method="post">
                                                                {{csrf_field()}}
                                                                <div class="modal-body bg-success">
                                                                    <div class="form-group">
                                                                        <label class="lead"><b>Date</b></label>
                                                                        <h3 class="bg-light text-dark p-1">{{$d->day}} - {{$mn}}</h3>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="lead">Name</label>
                                                                        <h3 class="bg-light text-dark p-1">{{$d->user->name}}</h3>
                                                                    </div>
                                                                    <div class="form-group {{$errors->has('meal') ? 'has-error' : ''}}">
                                                                        <label class="lead"><b>Meal</b></label>
                                                                        <input type="number" class="form-control" name="meal" value="{{$d->meal}}">
                                                                        @if($errors->has('meal'))
                                                                            <span class="help-block">{{$errors->first('meal')}}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{$errors->has('bazar') ? 'has-error' : ''}}">
                                                                        <label class="lead"><b>Bazar</b></label>
                                                                        <input type="number" class="form-control" name="bazar" value="{{$d->bazar}}">
                                                                        @if($errors->has('bazar'))
                                                                            <span class="help-block">{{$errors->first('bazar')}}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{$errors->has('deposit') ? 'has-error' : ''}}">
                                                                        <label class="lead"><b>Deposit</b></label>
                                                                        <input type="number" class="form-control" name="deposit" value="{{$d->deposit}}">
                                                                        @if($errors->has('deposit'))
                                                                            <span class="help-block">{{$errors->first('deposit')}}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer bg-success text-center">
                                                                    <div class="form-group ">
                                                                        <button class="btn btn-primary" type="submit">Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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

                                            <a href="" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">&#10006;</a>
                                        @else
                                            <a href="" class="btn btn-outline-success btn-sm mr-1 mb-1">Edit</a>
                                            <a href="" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">&#10006;</a>
                                        @endrole
                                    </td>
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