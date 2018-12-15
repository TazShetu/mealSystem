@include('includes.header')

<!--....NAV BAR....  -->
@include('includes.navbar')

@php
// mmm=cm  nmm=0 we r in current month
if (($nmm * 1) === 0){
    if(($mmm * 1) === 1){
        $pm = 12;
    }else {
        $pm = $mmm - 1;
    }
    $po = DateTime::createFromFormat('!m', $pm);
    $pmn = $po->format('F');
}


// nmm=nm  mmm=0 we r in past month
$co = DateTime::createFromFormat('!m', $cm);
$mnn = $co->format('F');







@endphp

@role(['admin', 'mealManager'])
<header id="home-section" class="TablE">
    <div class="t-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <!--loop start of DATE-->
                    @if(!$memdata->isEmpty())
                        @foreach($memdata->groupBy('day') as $ds)
                            {{--$ds is a collection of array--}}
                            @php
                                $month = $ds[0]->month;
                                $co = DateTime::createFromFormat('!m', $month);
                                $mn = $co->format('F');
                            @endphp
                            <h1 class="text-center pull-right">{{$ds[0]->day}} - {{$ds[0]->month}}</h1>
                            <table class="table table-hover bg-light text-dark">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Meal</th>
                                    <th>Bazar</th>
                                    <th>Deposit</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <!--loop start for member-->
                                @foreach($ds as $d)
                                    <tr>
                                        <td>{{$d->user->name}}</td>
                                        @if($d->dbm === null)
                                            <td>{{$d->meal}}</td>
                                            <td>{{$d->bazar}}</td>
                                            <td>{{$d->deposit}}</td>
                                            <td>
                                                <a href="{{route('memdata.accept', ['id' => $d->id])}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">Accept</a>
                                                <button class="btn btn-outline-success btn-sm mr-1 mb-1" data-toggle="modal" data-target="#editModal-<?php echo $d->id;?>">Edit</button>
                                                            {{--EDIT MODAL--}}
                                                            <div class="modal fade " id="editModal-<?php echo $d->id;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-success text-white">
                                                                            <h5 class="modal-title">Edit member's Data</h5>
                                                                            <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                                                        </div>
                                                                        <form action="{{route('memdata.ea', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" method="post">
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
                                                <a href="{{route('memdata.delete', ['id' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">Reject</a>
                                            </td>
                                        @else
                                            <td>&#10006;</td>
                                            <td>&#10006;</td>
                                            <td>&#10006;</td>
                                            <td>
                                                <a href="{{route('accept.delete', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-info btn-sm mb-1" onclick="return confirm('Are you sure?')">Accept Delete</a>
                                            </td>
                                        @endif
                                    </tr>


                                @endforeach
                                    <!--loop end for member-->
                                </tbody>
                            </table>
                        @endforeach
                        <!--loop end of DATE-->
                    @else
                        <dic class="col">
                            <div class="card">
                                <div class="card-header bg-success text-center">
                                    <h3>No member's data to show.</h3>
                                </div>
                            </div>
                        </dic>
                    @endif
                </div>
            </div>


            <div class="container mt-2">
                <div class="row">
                    <div class="col-sm-6">
                        @if(($nmm * 1) === 0)
                            <a href="{{route('show.memd', ['month' => $pm])}}" class="btn btn-light pull-left"><i class="fa fa-angle-double-left" style="font-size: 20px;"></i> {{$pmn}}</a>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if(($mmm * 1) === 0)
                            <a href="{{route('show.memd', ['month' => $cm])}}" class="btn btn-light pull-right">{{$mnn}} <i class="fa fa-angle-double-right" style="font-size: 20px;"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!--.......main Footer....  -->
{{--@include('includes.footer')--}}

@endrole


@include('includes.euModal')





<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

{{--<script>--}}
    {{--@if (count($errors) > 0)--}}
    {{--$('#nuModal').modal('show');--}}
    {{--@endif--}}
{{--</script>--}}


</body>
</html>