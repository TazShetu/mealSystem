{{--Edit user modal--}}
<?php $a = \Illuminate\Support\Facades\Auth::user() ?>
<div class="modal fade text-dark" id="euModal" tabindex="-1" role="dialog" aria-labelledby="euModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalTitle">Edit your Profile</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" action="{{route('update.user', ['slug' => $a->slug])}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $a->name }}" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="username">User-Name</label>
                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $a->username }}" required>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $a->email }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>
                    <input type="hidden" name="slug" value="">
                    {{--<button type="submit" class="btn btn-outline-light btn-block">Register</button>--}}
                </div>
                <div class="form-group text-center">
                    <p>Name and User-Name is mandatory !</p>
                    <p>Provide an email address in case you want to recover your forgotten password !</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-edit"></i> Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>