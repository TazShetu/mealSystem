@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')
@role(['admin', 'mealManager'])
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
                                @if(session('alert'))
                                    <div class="alert alert-danger">
                                        {{session('alert')}}
                                    </div>
                                @endif
                                <form action="{{route('exp.store', ['msid' => $ms->id])}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Date</b></label>
                                        <input type="date" class="form-control" name="date" required>
                                        @if($errors->has('date'))
                                            <span class="help-block text-danger">{{$errors->first('date')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                        <label for="category">Name</label>
                                        <select name="name" id="name" class="form-control" required>
                                            <option value="" hidden disabled selected>Choose One</option>
                                            @foreach($ms->users as $u)
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

