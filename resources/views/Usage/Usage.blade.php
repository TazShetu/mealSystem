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

<!-- navbar-->
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
                    <div class="row mt-3">
                        <div class="col mb-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h6 text-uppercase mb-0">Guideline</h3>
                                    <p class="text-muted mb-0">Usage</p>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Calculation result may vary from user to user by (+/-)1 Tk</b></li>
                                        <li class="list-group-item">Member has to personally collect username from meal-manager.</li>
                                        <li class="list-group-item">Member created by meal-manager has a default password 123456</li>
                                        <li class="list-group-item">Change the default password from edit profile menu.</li>
                                        <li class="list-group-item"><b>Provide a valid email address at edit profile menu to recover forgotten password.</b></li>
                                        <li class="list-group-item">The web page only shows data of a single month, <b>you can select month at top right corner.</b></li>
                                        <li class="list-group-item">Member can enter/edit/delete data but it will not be added into calculation until meal-manager accepts that.</li>
                                        <li class="list-group-item">Name and date in table can not be edited. If you want to change those, better delete and enter again.</li>
                                        <li class="list-group-item">If meal-manager enters or accepts new data for the same date and same member, it will auto overwrite the old data.</li>
                                        <li class="list-group-item">Every new month will auto create a new meal-system under the meal-manager. <b>Meal-manager can attach old member to the new meal-system.</b> Once added, member can not be removed but new month will auto erase all old member from last month.</li>
                                        <li class="list-group-item">Database only stores data worth of 2 months. So user can only see the data of the previous month and the following month.</li>
                                        <li class="list-group-item">Use <i class="fas fa-user"></i> <i class="fas fa-arrows-alt-h"></i> <i class="far fa-user"></i> this icon to make someone else meal-manager.</li>
                                        <li class="list-group-item">New member can not be added to old(last month's) meal-system.</li>
                                        <li class="list-group-item">Meal-system can have only one meal-manager.</li>
                                        <li class="list-group-item">Utility expense and deposit have nothing to do with meal-rate.</li>
                                        <li class="list-group-item">Utility expenses are divided equally among all the members.</li>
                                        <li class="list-group-item">Members cannot edit or delete accepted expense but they can enter new expense for the same date.</li>
                                        <li class="list-group-item">While changing mealmanager, it is highly recommended not to choose someone who was not a member of Last month’s meal-system as newly added member cannot access old month’s mealsystem.</li>
                                    </ul>
                                </div>
                            </div>
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
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="{{asset('v2/js/front.js')}}"></script>



</body>

</html>