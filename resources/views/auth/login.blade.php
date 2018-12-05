@include('includes.header')

<!--....NAV BAR before login....  -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top justify-content-between">
    <div class="container">
        <a href="{{url('/')}}" class="navbar-brand">Meal System</a>
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


<div class="container" style="padding-top: 200px;">
    <div class="row">
        <div class="col">
            <div class="card bg-success">
                <div class="card-header text-center">
                    <h3>You have to be logged in to view the page !</h3>
                </div>
            </div>
        </div>
    </div>
</div>



<!--.......main Footer....  -->
<footer>
    <div class="text-center fixed-bottom">
        <h5 class="h3">Taz Inc. <span style="font-size: 17px;">Copyright &copy; 2018</span></h5>
    </div>
</footer>





<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->




</body>
</html>