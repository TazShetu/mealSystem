@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')
@role(['admin', 'mealManager'])
<header id="home-section" class="utility">
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
                                <form action="{{route('pstore.exp', ['month' => $pm, 'msid' => $pms->id])}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label class="lead"><b>Month</b></label>
                                                <h3 class="bg-light text-dark p-1">{{$pmn}}</h3>
                                            </div>
                                            <div class="col">
                                                <label class="lead"><b>Day</b></label>
                                                <input type="number" step="1" class="form-control" name="day" required>
                                                @if($errors->has('day'))
                                                    <span class="help-block text-danger">{{$errors->first('day')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                        <label for="category">Name</label>
                                        <select name="name" id="name" class="form-control" required>
                                            <option value="" hidden disabled selected>Choose One</option>
                                            @foreach($pms->users as $u)
                                                <option value="{{$u->id}}">{{$u->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('name'))
                                            <span class="help-block text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('exp') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Expense</b></label>
                                        <input type="number" min="0" class="form-control" name="exp" value="{{old('exp')}}" required>
                                        @if($errors->has('exp'))
                                            <span class="help-block">{{$errors->first('exp')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('remark') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Remark</b></label>
                                        <input type="text" maxlength="50" class="form-control" name="remark" value="{{old('remark')}}">
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
@endrole

@include('includes.euModal')

@include('includes.footer')

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->


</body>
</html>