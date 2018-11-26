<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container">
        <a href="index.html" class="navbar-brand">Meal System</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="index.html" class="nav-link">Index</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link active">Home</a>
                </li>
                <li class="nav-item">
                    <a href="profile.html" class="nav-link">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="table.html" class="nav-link">Full Table</a>
                </li>
                {{--<li class="nav-item">--}}
                {{--<a href="" class="nav-link btn btn-outline-success">Log Out</a>--}}
                {{--</li>--}}
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-outline-success" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a><span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form></span>
                        {{--<a href="" class="dropdown-item">Edit Profile</a>--}}
                        <button class="dropdown-item" data-toggle="modal" data-target="#euModal">Edit Profile</button>
                        {{--<a href="" class="dropdown-item">Add a Meal Member</a>--}}
                        <button class="dropdown-item" data-toggle="modal" data-target="#nuModal">Add a Meal Member</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>