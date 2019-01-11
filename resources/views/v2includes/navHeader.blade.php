<header class="header mb-5">
    <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow border-bottom border-primary fixed-top">
        @if(array_key_exists('ms', $va))
            <a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead">
                <i class="fas fa-align-left"></i>
            </a>
        @endif
        <a href="{{route('home')}}" class="navbar-brand font-weight-bold text-uppercase text-base">LessMess</a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
            <li class="nav-item dropdown mr-3">
                <a id="notifications" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle px-1 sidebar-link">
                    <i class="far fa-calendar-check mr-1"></i>{{$va['monthName']}}
                </a>
                @if(($va['pastM'] * 1) === 1)
                    <div aria-labelledby="notifications" class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-sm bg-blue text-white"><i class="far fa-calendar"></i></div>
                                <div class="text ml-2"><p class="mb-0">{{$va['pastMonthName']}}</p></div>
                            </div>
                        </a>
                    </div>
                @else
                    {{$va['pastMonthName']}}
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