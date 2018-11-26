@include('includes.header')

<!--....NAV BAR....  -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top justify-content-between">
    <div class="container">
        <a href="index.html" class="navbar-brand">Meal System</a>
        <form method="POST" action="{{ route('login') }}" class="form-inline">
            @csrf
            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} mr-2 mb-1" name="email" value="{{ old('email') }}" placeholder="User Name" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} mr-2 mb-1" name="password" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
            @endif
            <button type="submit" class="btn btn-outline-success">Login</button>
        </form>
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
                                If Meal Manager enter data for a member and also for the same date it will overwrite the old data.
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
                    <div class="col-lg-4 mt-5">
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
@include('includes.footer')





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