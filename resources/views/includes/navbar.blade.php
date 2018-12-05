<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <div class="container">
        <a href="{{url('/')}}" class="navbar-brand">Meal System</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                {{------------------------------------------------------------------}}
                {{--<li class="nav-item">--}}
                    {{--<a href="http://localhost:8000" class="nav-link">Index</a>--}}
                {{--</li>--}}
                {{------------------------------------------------------------------}}
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">Home</a>
                </li>
                @role(['admin','mealManager'])
                    <li class="nav-item">
                        <a href="{{route('create.user')}}" class="nav-link"><i class="fa fa-user-plus"></i> Add a Meal Member</a>
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
                        {{--@role(['admin','mealManager'])--}}
                            {{--<a href="{{route('create.user')}}" class="dropdown-item"><i class="fa fa-user-plus"></i>&nbsp; Add a Meal Member</a>--}}
                        {{--@endrole--}}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>