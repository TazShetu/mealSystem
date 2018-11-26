<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--link-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="css/fontawesome.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">


    <title>Meal System</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />
</head>
<body>

<!--....NAV BAR....  -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container">
        <a href="index.html" class="navbar-brand">Meal System</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="" class="nav-link active">Index</a>
                </li>
                <li class="nav-item">
                    <a href="home.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="profile.html" class="nav-link">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="table.html" class="nav-link">Full Table</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!--.....HOME section....  -->
<header id="home-section" class="IndeX">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 d-none d-lg-block">
                        <h1 class="display-4">Calculating <strong>MEAL</strong> has never been <strong>EASIER</strong></h1>
                        <div class="d-flex flex-row">
                            <div class="p-4 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-4 align-self-end">
                                You Can use any fake email like fake@g.com. We do not care ! But make sure it's unique, unfortunately 2 users can not have same email
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-4 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-4 align-self-end">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta ut illo voluptates obcaecati odit reprehenderit qui ipsa, natus architecto aliquid, repellat dolore unde facere, nostrum voluptatum assumenda magnam hic officiis?
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="p-4 align-self-start">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="p-4 align-self-end">
                                Beatae sunt impedit neque modi optio eos id. Nihil vero, culpa cumque.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">


                        {{--<a href="{{ route('login') }}" class="btn btn-success btn-block btn-lg">LOGIN</a><br>--}}
                        <button class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#loginModal">Login</button>
                        <br>



                        <div class="card bg-success text-center card-form">
                            <div class="card-body">
                                <h3>Register as <strong>Meal Manager</strong></h3>
                                <form method="POST" action="{{ route('store.mM.mS') }}">
                                    @csrf
                                    <div class="form-group">
                                        {{--<input type="text" class="form-control form-control-lg" placeholder="Username">--}}
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {{--<input type="email" class="form-control form-control-lg" placeholder="Email">--}}
                                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="User Name" required>
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {{--<input type="password" class="form-control form-control-lg" placeholder="Password">--}}
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {{--<input type="password" class="form-control form-control-lg" placeholder="Confirm Password">--}}
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                    {{--<input type="submit" class="btn btn-outline-light btn-block">--}}
                                    {{--<button type="submit" class="btn btn-primary">{{ __('Register') }}</button>--}}
                                    {{--<input type="hidden" name="slug" value="">--}}
                                    <button type="submit" class="btn btn-outline-light btn-block">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!--.......main Footer....  -->
<footer id="main-footer" class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="py-4">
                    <h1 class="h3">Taz Inc.</h1>
                    <p>Copyright &copy; 2018</p>
                    <button class="btn btn-success" data-toggle="modal" data-target="#contactModal">Contact Us</button>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- .....Contact Modal....  -->
{{--<div class="modal fade text-dark" id="contactModal">--}}
<div class="modal fade text-dark" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalTitle">Contact US</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mesage</label>
                        <textarea class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block">Submit</button>
            </div>
        </div>
    </div>
</div>


<!-- .....Login Modal....  -->
{{--<div class="modal fade text-dark" id="contactModal">--}}
<div class="modal fade text-dark" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalTitle">Login</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        {{--<input type="text" class="form-control">--}}
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        {{--<input type="text" class="form-control">--}}
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                </form>
            </div>
            {{--<div class="modal-footer">--}}
                {{--<button class="btn btn-success btn-block" data-dismiss="modal">Login</button>--}}
            {{--</div>--}}
        </div>
    </div>
</div>



<!--script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->


<script>
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#password-confirm').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });
</script>

</body>
</html>