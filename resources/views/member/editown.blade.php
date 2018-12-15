@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')
@php
    $o = DateTime::createFromFormat('!m', $memD->month);
    $mn = $o->format('F');
@endphp

<header id="home-section" class="createData">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Edit Data</h1>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card bg-success">
                            <div class="card-body">
                                <form action="{{route('memdata.up.own', ['uid' => $memD->user_id, 'msid' => $memD->mealsystem_id, 'm' => $memD->month, 'd' => $memD->day])}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="lead"><b>Date</b></label>
                                        <h3 class="bg-light text-dark p-1">{{$memD->day}} - {{$mn}}</h3>
                                    </div>
                                    <div class="form-group">
                                        <label class="lead">Name</label>
                                        <h3 class="bg-light text-dark p-1">{{$memD->user->name}}</h3>
                                    </div>
                                    <div class="form-group {{$errors->has('meal') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Meal</b></label>
                                        <input type="number" class="form-control" name="meal" value="{{$memD->meal}}">
                                        @if($errors->has('meal'))
                                            <span class="help-block">{{$errors->first('meal')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('bazar') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Bazar</b></label>
                                        <input type="number" class="form-control" name="bazar" value="{{$memD->bazar}}">
                                        @if($errors->has('bazar'))
                                            <span class="help-block">{{$errors->first('bazar')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('deposit') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Deposit</b></label>
                                        <input type="number" class="form-control" name="deposit" value="{{$memD->deposit}}">
                                        @if($errors->has('deposit'))
                                            <span class="help-block">{{$errors->first('deposit')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="text-center">
                                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>

                </div>
            </div>
        </div>
    </div>
</header>


@include('includes.euModal')

@include('includes.footer')

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->


</body>
</html>