@include('includes.header')

@if (Route::has('login'))
    @auth
        <!--....NAV BAR after login....  -->
        <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
            <div class="container">
                <a href="{{route('home')}}" class="navbar-brand">Mess System</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{route('home')}}" class="nav-link">Home</a>
                        </li>
                        <li>
                            <a href="{{route('utility')}}" class="nav-link">Utility</a>
                        </li>
                        @role(['admin','mealManager'])
                        <li class="nav-item">
                            <a href="{{route('create.user')}}" class="nav-link"><i class="fa fa-user-plus"></i></a>
                        </li>
                        @endrole
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-outline-success" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i>&nbsp; {{ __('Logout') }}
                                </a><span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form></span>
                                {{--<button class="dropdown-item" data-toggle="modal" data-target="#euModal"><i class="fa fa-edit"></i>&nbsp; Edit Profile</button>--}}
                                @role(['admin','mealManager'])
                                <a href="{{route('mm.change')}}" class="dropdown-item"><i class="fa fa-user"></i> <i class="fa fa-arrows-h"></i> <i class="fa fa-user-o"></i></a>
                                @endrole
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @else
        <!--....NAV BAR before login....  -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top justify-content-between">
            <a href="{{url('/')}}" class="navbar-brand ml-5">Mess System</a>

            <div class="flex-column mr-5">
            {{--<div class="container">--}}
                <div class="flex-row">
                    <form method="POST" action="{{ route('login') }}" class="form-inline">
                        @csrf
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} mr-2 mb-1" name="email" value="{{ old('email') }}" placeholder="User Name" required autofocus>
                        {{--@if ($errors->has('email'))--}}
                            {{--<span class="invalid-feedback pb-1" role="alert"><strong>{{ $errors->first('email') }}</strong></span>--}}
                        {{--@endif--}}
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} mr-2 mb-1" name="password" placeholder="Password" required>
                        {{--@if ($errors->has('password'))--}}
                            {{--<span class="invalid-feedback pb-1" role="alert"><strong>{{ $errors->first('password') }}</strong></span>--}}
                        {{--@endif--}}
                        <button type="submit" class="btn btn-outline-success">Login</button>
                    </form>
                </div>
                @if ($errors->has('email'))
                    <div class="flex-row">
                        {{--<span class="invalid-feedback pb-1" role="alert"><strong>{{ $errors->first('email') }}</strong></span>--}}
                        <p style="color: #f44; font-size: small;">{{ $errors->first('email') }}</p>
                    </div>
                @endif


                {{--</div>--}}
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
                        <h1 class="display-4">Calculating <em>MEAL-RATE</em> has never been <em>EASIER</em></h1>
                        <h2>This Mess System is free to use</h2>
                        {{--<h3>This is a meal-manager controlled meal-system</h3>--}}
                        <div class="d-flex flex-row">
                            <div class="p-4 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-4 align-self-end">
                                This is a meal-manager controlled meal-system. Calculation result may vary from user to user by (+/-)1 Tk.
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-4 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-4 align-self-end">
                                Every new month will auto create a new meal-system under the meal-manager. Meal-manager can add old member to the new meal-system. Once added member can not be removed but new month will auto erase all old member from last month.
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-4 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-4 align-self-end">
                                And do not forget to wash your hands before eating.
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
                                        <a href="{{route('home')}}" class="btn btn-outline-light btn-block">Back to home. </a>
                                    </div>
                                </div>
                            </div>
                    @else
                        <!--....before login....  -->
                        <div class="col-lg-4 mt-5">
                            <div class="card bg-success">
                                <button class="btn btn-outline-warning" data-toggle="modal" data-target="#usesModal"><span style="color: white;">Guideline !</span></button>
                            </div>
                            <br>
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
                                        <button type="submit" class="btn btn-outline-light btn-block"><strong>Register</strong></button>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <div class="card bg-success">
                                <a href="{{ route('password.request') }}" class="btn btn-outline-light">forget password</a>
                            </div>
                            <br>
                            {{--<div class="card bg-success">--}}
                                {{--<button class="btn btn-outline-warning" data-toggle="modal" data-target="#usesModal">USAGE</button>--}}
                            {{--</div>--}}
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