<!DOCTYPE html>
<html>
@include('v2includes.head')
<body>

<!-- navbar-->
<header class="header mb-5">
    <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow border-bottom border-primary fixed-top">
        @if($ms)
            <a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead">
                <i class="fas fa-align-left"></i>
            </a>
        @endif
        <a href="{{route('home')}}" class="navbar-brand font-weight-bold text-uppercase text-base">LessMess</a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
            <li class="nav-item dropdown mr-3">
                <a id="notifications" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle px-1 sidebar-link">
                    <i class="far fa-calendar-check mr-1"></i>{{$monthName}}
                </a>
                @if(($pastM * 1) === 1)
                    <div aria-labelledby="notifications" class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-sm bg-blue text-white"><i class="far fa-calendar"></i></div>
                                <div class="text ml-2"><p class="mb-0">{{$pastMonthName}}</p></div>
                            </div>
                        </a>
                    </div>
                @else
                    {{$pastMonthName}}
                @endif
            </li>
            <li class="nav-item dropdown ml-auto">
                <a id="userInfo" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    <img src="{{asset('v2/img/avatar.png')}}" alt="User" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow">
                </a>
                <div aria-labelledby="userInfo" class="dropdown-menu">
                    <a href="#" class="dropdown-item"><i class="fas fa-user-edit"></i> Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="fas fa-user"></i> <i class="fas fa-arrows-alt-h"></i> <i class="far fa-user"></i></a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
</header>


<div class="d-flex align-items-stretch" id="gradient">

    @if($ms)
        @include('v2includes.sidebar')
        <div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
                <section class="pt-5">
                    <div class="row mt-3">
                        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                            <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="dot mr-3 bg-blue"></div>
                                    <div class="text">
                                        <h6 class="mb-0">Meal Rate</h6><span class="text-gray">Tk per meal</span>
                                    </div>
                                </div>
                                <div class="mrT">{{$mealRate}}</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                            <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="dot mr-3 bg-blue"></div>
                                    <div class="text">
                                        <h6 class="mb-0">My Balance</h6><span class="text-gray">Meal + Utility</span>
                                    </div>
                                </div>
                                <div class="mrT" style="color: @php if (($myBalance * 1) < 0) { echo 'red';} else echo '#228DFF' @endphp;">
                                    {{$myBalance}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                            <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="dot mr-3 bg-green"></div>
                                    <div class="text">
                                        <h6 class="mb-0">Meal</h6><span class="text-gray">Total</span>
                                    </div>
                                </div>
                                <div class="icon text-white bg-green">{{$totalMeal}}</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                            <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="dot mr-3 bg-green"></div>
                                    <div class="text">
                                        <h6 class="mb-0">Bazar + Deposit</h6><span class="text-gray">Total</span>
                                    </div>
                                </div>
                                <div class="icon text-white bg-green">{{$totalbazarDeposit}}</div>
                            </div>
                        </div>
                    </div>
                </section>


                <section class="pt-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h2 class="h6 text-uppercase mb-0">Meal</h2>
                                </div>
                                <div class="card-body">
                                    <div class="chart-holder">
                                        <div id="meal"  style="height: 400px; margin: auto;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h2 class="h6 text-uppercase mb-0">Bazar + Deposit</h2>
                                </div>
                                <div class="card-body">
                                    <div class="chart-holder">
                                        <div id="b+d"  style="height: 400px; margin: auto;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="h6 mb-0 text-uppercase">All member's Balance</h2>
                                </div>
                                <div class="card-body">
                                    <p class="text-gray mb-5">Meal + Utility</p>
                                    <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-4 flex-column flex-sm-row">
                                        <div class="left d-flex align-items-center w-50">
                                            <div class="icon icon-lg shadow mr-3 text-gray"><i class="fas fa-users"></i></div>
                                            <div class="text">
                                                <h6 class="mb-0 d-flex align-items-center"> <span>Names</span></h6><small class="text-gray">Usernames</small>
                                            </div>
                                        </div>
                                        <div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-violet">
                                            <h5></h5>
                                        </div><div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-violet">
                                            <h5></h5>
                                        </div><div class="right ml-5 ml-sm-0 pl-3 pl-sm-0">
                                            <h5>Total</h5>
                                        </div>
                                    </div>
                                    @foreach($amounts as $a)
                                        <div class="d-flex justify-content-between align-items-start align-items-sm-center mb-4 flex-column flex-sm-row">
                                            <div class="left d-flex align-items-center w-50">
                                                <div class="icon icon-lg shadow mr-3 text-gray"><i class="far fa-user"></i></div>
                                                <div class="text">
                                                    <h6 class="mb-0 d-flex align-items-center"> <span>{{$a->name}}</span></h6><small class="text-gray">{{$a->username}}</small>
                                                </div>
                                            </div>
                                            <div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-primary">
                                                <h5>{{$a->amount}}</h5>
                                            </div><div class="right ml-5 ml-sm-0 pl-3 pl-sm-0 text-primary">
                                                <h5>{{$a->expA}}</h5>
                                            </div><div class="right ml-5 ml-sm-0 pl-3 pl-sm-0">
                                                <h5 style="color: @php if ((($a->amount + $a->expA) * 1) < 0) { echo 'red';} else echo '#228DFF' @endphp;">{{$a->amount + $a->expA}}</h5>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-5">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="h6 text-uppercase mb-0">Meal & Bazar</h2>
                                </div>
                                <div class="card-body">
                                    <div class="chart-holder">
                                        <!--                                        <canvas id="lineChartExample"></canvas>-->
                                        <div id="tMtB"  style="height: 600px; margin: auto;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


            </div>
            @include('v2includes.footer')
        </div>
    @else
        <div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
                <section class="pt-5">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h6 text-uppercase mb-0">Not added to current mealsystem yet</h3>
                                </div>
                                <div class="card-body">
                                    <h4>Ask your mealmanager to add you to new mealsystem personally.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @include('v2includes.footer')
        </div>
    @endif

</div>

@include('v2includes.buttonTheme')





<!-- JavaScript files-->
@include('v2includes.scriptTag')


{{--home.js for graph add--}}
<script src="{{asset('v2/js/EChrts.min.js')}}"></script>
@include('v2includes.homeJs')

</body>

</html>
