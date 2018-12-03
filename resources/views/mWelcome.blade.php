@include('includes.header')

@if (Route::has('login'))
    @auth
        @include('includes.navbar')
    @else
        <!--....NAV BAR before login....  -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top justify-content-between">
            <div class="container">
                <a href="index.html" class="navbar-brand">Meal System</a>
                <form method="POST" action="{{ route('login') }}" class="form-inline">
                    @csrf
                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} mr-2 mb-1" name="email" value="{{ old('email') }}" placeholder="User Name" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} mr-2 mb-1" name="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                    <button type="submit" class="btn btn-outline-success">Login</button>
                </form>
            </div>
        </nav>
    @endauth
@endif


<!--.....HOME section....  -->
<header id="home-section" class="IndeX">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 d-none d-lg-block">
                        <h3>We are still in Beta. Your data might get lost !</h3>
                        <h1 class="display-4">Calculating <strong>MEAL</strong> has never been <strong>EASIER</strong></h1>
                        <div class="d-flex flex-row">
                            <div class="p-4 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-4 align-self-end">
                                To edit data meal-manager can simply enter new data for the same date and same member. It will auto overwrite the old data.
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-4 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-4 align-self-end">
                                Every new month will auto create a new meal-system under the meal-manager. Meal-manager will add member for new meal-system. Once added member can not be deleted but new month will auto erase all old member from last month.
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-4 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-4 align-self-end">
                                Lorem eatae sunt impedit neque modi optio eos id. Nihil vero, culpa cumque.
                            </div>
                        </div>
                    </div>
                @if (Route::has('login'))
                    @auth
                        {{--aftere login--}}
                            <div class="col-lg-4 mt-5">
                                <div class="card bg-success text-center card-form">
                                    <div class="card-header">
                                        <h3>You are already logged in.</h3>
                                    </div>
                                    <div class="card-body">
                                        <a href="http://localhost:8000/hh" class="btn btn-outline-light btn-block">Back to home. </a>
                                    </div>
                                </div>
                            </div>
                    @else
                        <!--....before login....  -->
                        <div class="col-lg-4 mt-5">
                            <div class="card bg-success text-center card-form">
                                <div class="card-body">
                                    <h3>Register as <strong>Meal Manager</strong></h3>
                                    <form method="POST" action="{{ route('store.mM.mS') }}">
                                        @csrf
                                        <div class="form-group">
                                            {{--<input type="text" class="form-control form-control-lg" placeholder="Username">--}}
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{--<input type="email" class="form-control form-control-lg" placeholder="Email">--}}
                                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="User Name" required>
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{--<input type="password" class="form-control form-control-lg" placeholder="Password">--}}
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{--<input type="password" class="form-control form-control-lg" placeholder="Confirm Password">--}}
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                        </div>
                                        {{--<input type="submit" class="btn btn-outline-light btn-block">--}}
                                        {{--<button type="submit" class="btn btn-primary">{{ __('Register') }}</button>--}}
                                        {{--<input type="hidden" name="slug" value="">--}}
                                        <button type="submit" class="btn btn-outline-light btn-block">Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>


<!--.......main Footer....  -->
@include('includes.footer')





<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->




</body>
</html>