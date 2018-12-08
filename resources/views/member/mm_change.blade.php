@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')

<header id="home-section" class="oM">
    <div class="dark-overlay">
        <div class="home-inner">
            <h2 class="text-center">Choose, who do you want to make meal-manager.</h2>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card text-center bg-success">
                            @if(empty($members))
                                <div class="card-header">
                                    <h3>No Member in Current Meal-System !</h3>
                                    <p>First add member in current meal-system.</p>
                                </div>
                            @else
                                <div class="card-header">
                                    <h4>Select who will be meal-manager.</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('mm.store')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="form-group {{$errors->has('member_id') ? 'has-error' : ''}}">
                                            <select name="member_id" id="member" class="form-control">
                                                <option value="" hidden disabled selected>Choose One</option>
                                                @foreach($members as $m)
                                                    <option value="{{$m->id}}">{{$m->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('member_id'))
                                                <span class="help-block text-warning">{{$errors->first('member_id')}}</span>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="text-center">
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('You will no longer be meal-manager. Are you sure ?');">Meal-Manager Change</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
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


{{--Edit user modal--}}
@include('includes.euModal')


<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->


</body>
</html>