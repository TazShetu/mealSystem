{{--Edit user modal--}}
<div class="modal fade text-dark" id="euModal" tabindex="-1" role="dialog" aria-labelledby="euModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalTitle">Add New Meal Member</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
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
                    <input type="hidden" name="slug" value="">
                    {{--<button type="submit" class="btn btn-outline-light btn-block">Register</button>--}}
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Create Member</button>
                </div>
            </form>
        </div>
    </div>
</div>