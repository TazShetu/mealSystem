@include('includes.header')

<!--....NAV BAR....  -->
@include('includes.navbar')

<header id="home-section" class="cM">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card bg-success text-center card-form">
                            <div class="card-body">
                                <h2><strong>Create new Member</strong></h2><br>
                                <h2>for {{$mn}}</h2>
                                <hr>
                                <form method="POST" action="{{route('store.user')}}">
                                    @csrf
                                    <div class="form-group text-center">
                                        <p><strong>Default password is <span style="color: #fef4d1">123456</span> but member can change that later.</strong></p>
                                        <p><strong>Do not forget to give member his user-name personally.</strong></p>
                                    </div>
                                    <hr>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="User Name" required>
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-light btn-block"><strong>Create Member</strong></button>
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



@include('includes.euModal')

@include('includes.footer')


<!--script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->



</body>
</html>