@include('includes.header')

<!--....NAV BAR....  -->
@include('includes.navbar')

{{--@php--}}



{{--@endphp--}}

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
                                        <td>
                                            <a href="{{route('memdata.accept', ['id' => $d->id])}}" class="btn btn-outline-primary btn-sm mr-1 mb-1">&#10004;</a>
                                            {{--<a href="" class="btn btn-outline-success btn-sm mr-1 mb-1">Edit</a>--}}
                                            <button class="btn btn-outline-success btn-sm mr-1 mb-1" data-toggle="modal" data-target="#editModal">Edit</button>
                                            <a href="{{route('memdata.delete', ['id' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">&#10006;</a>
                                        </td>
                                    </tr>
                                            {{--EDIT MODAL--}}
                                            <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
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
        </div>
    </div>
</header>


<!--.......main Footer....  -->
{{--@include('includes.footer')--}}



@include('includes.euModal')


@endrole



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