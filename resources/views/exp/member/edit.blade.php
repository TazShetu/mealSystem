@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')
<header id="home-section" class="utility">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Enter/Edit Expense</h1>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card bg-success">
                            <div class="card-body">
                                {{--@if(session('alert'))--}}
                                {{--<div class="alert alert-danger">--}}
                                {{--{{session('alert')}}--}}
                                {{--</div>--}}
                                {{--@endif--}}
                                <form action="{{route('exp.Mupdate', ['eid' => $exp->id, 'msid' => $msid])}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="lead"><b>Date</b></label>
                                        <h3 class="bg-light text-dark p-1">{{$day}} - {{$mn}}</h3>
                                    </div>
                                    <div class="form-group {{$errors->has('exp') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Expense</b></label>
                                        <input type="number" min="0" class="form-control" name="exp" value="{{$exp->exp}}" required>
                                        @if($errors->has('exp'))
                                            <span class="help-block">{{$errors->first('exp')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('remark') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Remark</b></label>
                                        <input type="text" maxlength="50" class="form-control" name="remark" value="{{$exp->remark}}">
                                        @if($errors->has('remark'))
                                            <span class="help-block">{{$errors->first('remark')}}</span>
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

