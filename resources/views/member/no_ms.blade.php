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
        <a href="{{route('home')}}" class="navbar-brand font-weight-bold text-uppercase text-base">LessMess</a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
            @if($pms)
                <li class="nav-item dropdown mr-3">
                    <a id="notifications" href="{{route('home.Past', ['pmsid' => $pms->id])}}" class="nav-link px-1 sidebar-link"><i class="far fa-calendar-check" style="font-size: 20px;"></i>&nbsp;{{$pastMonthName}}</a>
                </li>
            @endif
            <li class="nav-item dropdown ml-auto">
                <a id="userInfo" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    <i class="fa fa-user"></i> {{$u->name}}
                </a>
                <div aria-labelledby="userInfo" class="dropdown-menu">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
</header>


<div class="d-flex align-items-stretch " id="gradient">

    <div class="page-holder w-100 d-flex flex-wrap">

        <div class="container-fluid px-xl-5">

            <section class="pt-5">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h4>You are not added to new meal system yet.</h4>
                                    <p>Please tell your mealmanager to add you personally.</p>
                                </div>
                                <div class="card-footer text-center">
                                    @if($pms)
                                        <a href="{{route('home.Past', ['pmsid' => $pms->id])}}" class="btn btn-primary">{{$pastMonthName}}</a>
                                    @endif
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
<!--    <script src="vendor/chart.js/Chart.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<!--    <script src="js/charts-home.js"></script>-->
<!--    <script src="js/EChrts.min.js"></script>-->
<script src="{{asset('v2/js/front.js')}}"></script>

</body>
</html>
