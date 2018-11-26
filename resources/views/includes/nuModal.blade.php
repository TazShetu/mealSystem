<div class="modal fade text-dark" id="nuModal" tabindex="-1" role="dialog" aria-labelledby="nuModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalTitle">Add New Meal Member</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" action="{{route('store.user')}}">
                @csrf
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
                    <div class="form-group text-center">
                        <p>Default password is 123456 but member can change that later.</p>
                        <p>Do not forget to tell give member his user-name personally.</p>
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