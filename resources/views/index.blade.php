<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LessMess Mess System - calculate meal-rate for free</title>
    <!-- Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('v2/img/icon.png')}}">
    {{--basic SEO--}}
    <meta name="description" content="Calculating meal, Meal manager who controls meal system. Meal calculation is so easy here in lessmess.ttazs.com. mess system lessmess">
    <meta name="keywords" content="mess, lessmess, meal, system, manager, mealsystem, mealmanager, calculation, calculating, calculating meal, member, mealmember, bazar, bazar khorosh, ttazs, lessmess.ttazs, lessmess.ttazs.com">

    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('v2/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">

    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('v2/css/style.default.css')}}"  id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('v2/css/custom.css')}}">

    {{--<!-- Tweaks for older IEs--><!--[if lt IE 9]>--}}
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>--}}
    {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->--}}
</head>
<body>

<header class="header mb-5">

    <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow border-bottom border-primary fixed-top">
        @if (Route::has('login'))
            @auth
                {{--<a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead">--}}
                    {{--<i class="fas fa-align-left"></i>--}}
                {{--</a>--}}
                <a href="{{route('home')}}" class="navbar-brand font-weight-bold text-uppercase text-base">LessMess</a>
                <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
                    <li class="nav-item dropdown mr-3">
                        <a id="notifications" href="{{route('home')}}" class="nav-link px-1 sidebar-link">
                            <i class="fas fa-home mr-1"></i>
                        </a>
                    </li>
                </ul>
            @else
                <a href="{{url('/')}}" class="navbar-brand font-weight-bold text-uppercase text-base">LessMess</a>
                <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
                    <li class="nav-item dropdown mr-3">
                        <a id="notifications" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle px-1 sidebar-link">
                            <i class="fas fa-sign-in-alt mr-1" style="font-size: 18px;"></i> Signin
                        </a>
                        <div aria-labelledby="notifications" class="dropdown-menu">
                            <form method="POST" action="{{ route('login') }}" class="form-inline m-3">
                                @csrf
                                <input id="email" name="email" value="{{ old('email') }}" class="form-control mb-1" type="text" placeholder="username" required>
                                <input name="password" class="form-control" type="password" placeholder="password" required>
                                <div class="d-flex flex-nowrap">
                                    <input class="form-control" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="ml-1" for="remember">Remember Me</label>
                                </div>
                                <button class="btn btn-outline-secondary btn-block" type="submit"><span class="text-primary">Login</span></button>
                                @if ($errors->has('email'))
                                    <p class="mb-0 p-2" style="color: #f44;">{{ $errors->first('email') }}</p>
                                @endif
                            </form>
                        </div>
                    </li>
                </ul>
            @endauth
        @endif
    </nav>
</header>


<div class="d-flex align-items-stretch " id="gradient">

    <div class="page-holder w-100 d-flex flex-wrap">

        <div class="container-fluid px-xl-5">

            <section class="pt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 d-none d-lg-block" style="padding-top: 70px; background-color: rgba(255, 255, 255, 0.2)">
                            <h1 class="display-4">Calculating <em>MEALRATE</em> &nbsp;has never been <em>EASIER</em></h1>
                            <h2>This Mess System is free to use</h2>

                            <div class="d-flex flex-row">
                                <div class="p-4 align-self-start">
                                    <i class="fa fa-check text-primary"></i>
                                </div>
                                <div class="p-4 align-self-end">
                                    This is a mealmanager controlled mealsystem. Calculation result may vary from user to user by (+/-) 1 Tk.
                                </div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="p-4 align-self-start">
                                    <i class="fa fa-check text-primary"></i>
                                </div>
                                <div class="p-4 align-self-end">
                                    Every new month will auto create a new mealsystem under the mealmanager. Mealmanager can add old member to the new mealsystem. Once added member can not be removed but new month will auto erase all old member from last month.
                                </div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="p-4 align-self-start">
                                    <i class="fa fa-check text-primary"></i>
                                </div>
                                <div class="p-4 align-self-end">
                                    Please provide a valid email address at edit profile menu to recover forgotten password.
                                </div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="p-4 align-self-start">
                                    <i class="fa fa-check text-primary"></i>
                                </div>
                                <div class="p-4 align-self-end">
                                    And do not forget to wash your hands before eating.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-5 pl-lg-5">
                            <div class="card"><a href="{{route('usage')}}" class="btn btn-block btn-outline-primary">Guideline !</a></div>
                            <br>
                            @if (Route::has('login'))
                                @auth
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h6 text-uppercase mb-0">you are already logged in.</h3>
                                        </div>
                                        <div class="card-body">
{{--                                            <a href="{{ route('logout') }} ">Loge out</a>--}}
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                     </div>
                                    @else
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h6 text-uppercase mb-0">Register</h3>
                                            <p class="text-muted mb-0">as mealmanager</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('store.mM.mS') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required min="3" max="30">
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-4">
                                                    <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Username" required>
                                                    @if ($errors->has('username'))
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-4">
                                                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                                    @endif
                                                </div>
                                                <div class="form-group mb-4">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-primary">Register</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card"><a href="{{ route('password.request') }}" class="btn btn-outline-primary btn-block">Forget Password</a></div>
                                    <br>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-center text-md-left text-primary">
                        <p class="mb-2 mb-md-0">Taz Inc. &copy; 2019</p>
                    </div>
                    <div class="col-md-6 text-center text-md-right text-gray-400">
                        <a href="#" class="external text-gray-400 mr-1" target="_blank">Contact</a>
                        <a href="http://www.ttazs.com/" class="external text-gray-400 mr-1" target="_blank">About</a>
                        <a href="{{route('usage')}}" class="external" target="_blank">Usage</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>


</div>


@include('v2includes.buttonTheme')

<!-- JavaScript files-->
<script src="{{asset('v2/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('v2/vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{asset('v2/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('v2/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<!--    <script src="vendor/chart.js/Chart.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<!--    <script src="js/charts-home.js"></script>-->
<!--    <script src="js/EChrts.min.js"></script>-->
<script src="{{asset('v2/js/front.js')}}"></script>
<!--    <script src="js/utility.js"></script>-->


<style>
    .fa-check {
        font-size: 30px;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 5px;
        padding: 4px;
    }
</style>

</body>



</html>
