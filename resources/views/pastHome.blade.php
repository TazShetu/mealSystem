@include('includes.header')
<!--....NAV BAR....  -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <div class="container">
        <a href="{{route('home')}}" class="navbar-brand">Meal System</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">Home</a>
                </li>
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
    $a = Auth::user();
    $am = $a->amountus()->where('mealsystem_id', $ms->id)->first();

    $o = DateTime::createFromFormat('!m', $ms->month);
    $mn = $o->format('F');

    if (($ms->month) === 12){
        $nm = 1;
    }else{
        $nm = ($ms->month) + 1;
    }
    $no = DateTime::createFromFormat('!m', $nm);
    $nmn = $no->format('F');

    $pm = $ms->month;
@endphp
<header id="home-section" class="HomE">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('home')}}" class="btn btn-success pull-right btn-sm">{{$nmn}} <i class="fa fa-angle-double-right" style="font-size: 20px;"></i></a>
                    </div>
                    <div class="col-md-12 text-center mt-1"><h1><strong>{{$mn}}</strong></h1></div>
                </div>
            </div>

            <hr>
            <div class="container">
                @role(['admin', 'mealManager'])
                    @php
                        $memD = \App\Memdata::where('mealsystem_id', $ms->id)->get();
                        $c = count($memD);
                    @endphp
                    <div class="row">
                        <div class="col-md-6 text-center pb-1">
                            <a href="{{route('datam.pcreate', ['msid' => $ms->id])}}" class="btn btn-outline-info">
                                <b><span style="font-size: 25px;'">New</span> Data ({{$mn}})</b>
                            </a>
                        </div>
                        <div class="col-md-6 text-center pb-1">
                            <a href="{{route('show.memd', ['month' => $pm])}}" class="btn btn-info">
                                <b>given Data ({{$mn}})<span class="badge" style="color: yellow; font-size: 25px;">{{$c}}</span></b>
                            </a>
                        </div>
                    </div>
                    <br>
                @else
                    <div class="row">
                        <div class="col text-center">
                            <a href="{{route('memdata.p.create')}}" class="btn btn-info">
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
                                <h3 class="display-4">Meal-rate is <em>{{$ms->meal_rate}}</em> &nbsp;Tk/meal</h3>
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
                        <br>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6 p-1">
                        @if($ms)
                            <br>
                            <a href="{{route('p.table', ['slug' => $a->slug, 'id' => $ms->id])}}" class="btn btn-lg btn-success btn-block"><i class="fa fa-bars" style="font-size: 20px;"></i>&nbsp; Personal Table</a>
                        @endif
                    </div>
                    <div class="col-md-6 p-1">
                        @if($ms)
                            <br>
                            <a href="{{route('f.table', ['msid' => $ms->id])}}" class="btn btn-lg btn-outline-success btn-block"><i class="fa fa-table" style="font-size: 20px;"></i>&nbsp; Full Table</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

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