@include('includes.header')
<!--....NAV BAR....  -->
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
                        {{--<li class="nav-item">--}}
                            {{--<a href="" class="nav-link active">Contact</a>--}}
                        {{--</li>--}}
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
                <div class="flex-row">
                    <form method="POST" action="{{ route('login') }}" class="form-inline">
                        @csrf
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} mr-2 mb-1" name="email" value="{{ old('email') }}" placeholder="User Name" required autofocus>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} mr-2 mb-1" name="password" placeholder="Password" required>
                        <button type="submit" class="btn btn-outline-success">Login</button>
                    </form>
                </div>
                @if ($errors->has('email'))
                    <div class="flex-row">
                        <p style="color: #f44; font-size: small;">{{ $errors->first('email') }}</p>
                    </div>
                @endif
            </div>
        </nav>
    @endauth
@endif

<header id="home-section" class="cM">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Contact Form</h1>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card bg-success">
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{session('success')}}
                                    </div>
                                @endif
                                <form action="{{route('contact.sent')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Name</b></label>
                                        <input type="text" maxlength="30" class="form-control" name="name" value="{{old('name')}}" required>
                                        @if($errors->has('name'))
                                            <span class="help-block text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Email</b></label>
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                                        @if($errors->has('email'))
                                            <span class="help-block text-danger">{{$errors->first('email')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('message') ? 'has-error' : ''}}">
                                        <label class="lead"><b>Message</b></label>
                                        <textarea name="message" cols="30" rows="10" class="form-control" value="{{old('message')}}" required></textarea>
                                        @if($errors->has('message'))
                                            <span class="help-block text-danger">{{$errors->first('message')}}</span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <div class="text-center">
                                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>
    </div>
</header>



@include('includes.footer')

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->


<style>
    .acC{
        color: white;
    }
</style>


</body>
</html>