@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')

<header id="home-section" class="createData">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Enter/Edit Data</h1>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card bg-success">
                            <div class="card-body">
                                @if(session('alert'))
                                    <div class="alert alert-danger">
                                        {{session('alert')}}
                                    </div>
                                @endif
                                <form action="{{route('memdata.store' , ['msid' => $ms->id])}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Date</b></label>
                                        <input type="date" class="form-control" name="date">
                                        @if($errors->has('date'))
                                            <span class="help-block text-danger">{{$errors->first('date')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('meal') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Meal</b></label>
                                        <input type="number" min="0" class="form-control" name="meal" value="{{old('meal')}}">
                                        @if($errors->has('meal'))
                                            <span class="help-block">{{$errors->first('meal')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('bazar') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Bazar</b></label>
                                        <input type="number" min="0" class="form-control" name="bazar" value="{{old('bazar')}}">
                                        @if($errors->has('bazar'))
                                            <span class="help-block">{{$errors->first('bazar')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('deposit') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Deposit</b></label>
                                        <input type="number" min="0" class="form-control" name="deposit" value="{{old('deposit')}}">
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