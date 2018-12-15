@include('includes.header')
<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <div class="container">
        <a href="{{route('home')}}" class="navbar-brand">Meal System</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link active">Home</a>
                </li>
                @role(['admin','mealManager'])
                    <li class="nav-item">
                        <a href="{{route('create.user')}}" class="nav-link"><i class="fa fa-user-plus"></i> Add new Meal Member</a>
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
                        <button class="dropdown-item" data-toggle="modal" data-target="#euModal"><i class="fa fa-edit"></i>&nbsp; Edit Profile</button>
                        @role(['admin','mealManager'])
                            <a href="{{route('mm.change')}}" class="dropdown-item"><i class="fa fa-user"></i> <i class="fa fa-arrows-h"></i> <i class="fa fa-user-o"></i></a>
                        @endrole
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
@php
    $month = \Carbon\Carbon::now()->month;
    $a = Auth::user();
    $ms = $a->mealsystems()->where('month', $month)->first();
    if ($ms){
        $am = $a->amountus()->where('mealsystem_id', $ms->id)->first();
    } else {
        $am = 0;
    }
    if ($month == 1){
            $pmonth = 12;
    }else {
            $pmonth = $month - 1 ;
    }
    $pms = $a->mealsystems()->where('month', $pmonth)->first();
    $co = DateTime::createFromFormat('!m', $month);
    $mn = $co->format('F');
    $po = DateTime::createFromFormat('!m', $pmonth);
    $pmn = $po->format('F');
@endphp
<header id="home-section" class="HomE">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if($pms)
                            <a href="{{route('lhome', ['msid' => $pms->id])}}" class="btn btn-success pull-left btn-sm"><i class="fa fa-angle-double-left" style="font-size: 20px;"></i> {{$pmn}}</a>
                        @endif
                    </div>
                    <div class="col-md-12 text-center mt-1"><h1><strong>{{$mn}}</strong></h1></div>
                </div>
            </div>
            <hr>
            <div class="container">
                @role(['admin', 'mealManager'])
                    <div class="row">
                        <div class="col-md-6 text-center pb-1">
                            <a href="{{route('datam.create')}}" class="btn btn-info ">
                                <b><span style="font-size: 25px;'">New</span> Data ({{$mn}})</b>
                            </a>
                        </div>
                        <div class="col-md-6 text-center pb-1">
                            <a href="{{route('show.memd', ['month' => $month])}}" class="btn btn-outline-info">
                                <b><span style="font-size: 25px;'">Member</span> Data ({{$mn}})</b>
                            </a>
                        </div>
                    </div>
                    <br>
                @else
                    <div class="row">
                        <div class="col text-center">
                            <a href="{{route('memdata.create')}}" class="btn btn-info btn-lg">
                                <b><span style="font-size: 25px;'">New</span> Data ({{$mn}})</b>
                            </a>
                        </div>
                    </div>
                    <br>
                @endrole
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="card bg-success text-center card-form">
                            <div class="card-body">
                                @if($ms)
                                    <h3 class="display-4">Meal-rate is <em>{{$ms->meal_rate}}</em> &nbsp;Tk/meal</h3>
                                @else
                                    @role(['admin', 'mealManager'])
                                        <h3>New month New meal-system</h3>
                                        <h3>Do not forget to</h3>
                                        <h1>Add old members to new meal-system</h1>
                                    @else
                                        <h3>Ask Meal Manager to add you to new meal-system personally.</h3>
                                    @endrole
                                @endif
                            </div>
                        </div>
                        <br>
                        @if($am)
                            <div class="card bg-info text-center card-form">
                                <div class="card-body">
                                    <h3 class="display-6">Your balance <span id="amountt"><em>{{$am->amount}}</em></span> &nbsp;Tk</h3>
                                </div>
                            </div>
                            <br>
                        @endif
                        @role(['admin', 'mealManager'])
                            @if($pms)
                                <h4>Add old Meal Member to new meal-system</h4>
                                <a href="{{route('oldm.attach', ['id' => $a->id])}}" class="btn btn-info "><i class="fa fa-user-plus"></i>&nbsp; </a>
                            @endif
                        @endrole
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-1">
                        @if($ms)
                            <br>
                            <a href="{{route('p.table', ['slug' => $a->slug, 'id' => $ms->id])}}" class="btn btn-lg btn-success btn-block"><i class="fa fa-bars" style="font-size: 20px;"></i>&nbsp; Personal Table</a>
                        @elseif($pms)
                            <br>
                            <a href="{{route('p.table', ['slug' => $a->slug, 'id' => $pms->id])}}" class="btn btn-lg btn-success btn-block"><i class="fa fa-bars" style="font-size: 20px;"></i>&nbsp; Last month</a>
                        @endif
                    </div>
                    <div class="col-md-6 p-1">
                        @if($ms)
                            <br>
                            <a href="{{route('f.table', ['msid' => $ms->id])}}" class="btn btn-lg btn-outline-success btn-block"><i class="fa fa-table" style="font-size: 20px;"></i>&nbsp; Full Table</a>
                        @elseif($pms)
                            <br>
                            <a href="{{route('f.table', ['msid' => $pms->id])}}" class="btn btn-lg btn-outline-success btn-block"><i class="fa fa-table" style="font-size: 20px;"></i>&nbsp; Last month</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@role(['admin'])
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="{{route('admin.delete')}}" class="btn btn-outline-danger">Delete 2 Months Old Data</a>
                </div>
            </div>
        </div>
    </section>
@endrole
{{--Edit user modal--}}
@include('includes.euModal')

<!--.......main Footer....  -->
@include('includes.footer')


<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

<script>
    @if (count($errors) > 0)
        $('#euModal').modal('show');
    @endif
</script>


<script>
    $(function () {
        var score = parseInt($('#amountt').text().trim());
        var color = 'red';
        if (!isNaN(score)) {
            if (score >= 0) {
                color = 'white';
            }
            $('#amountt').css('color', color);
        }
    });
</script>

</body>
</html>