@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')

<header id="home-section" class="HomE">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Choose, who to add in current month</h1>
            <br>
            <div class="container">
                <div class="row">
                    {{--<div class="col-sm-12">--}}
                        {{--<div class="card text-center bg-success">--}}
                            {{--<div class="card-body">--}}
                                {{--@if(empty($members))--}}
                                    {{--<h2>No old member to add !</h2>--}}
                                {{--@else--}}
                                    {{--<form action="" method="post">--}}
                                        {{--{{csrf_field()}}--}}
                                        {{--<input type="hidden" name="msid" value="{{$msid}}">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="member"><h4>Select member from last month</h4></label>--}}
                                            {{--<select name="member_id" id="member" class="form-control">--}}
                                                {{--<option value="" hidden disabled selected>Choose One</option>--}}
                                                {{--@foreach($members as $m)--}}
                                                    {{--<option value="{{$m->id}}">{{$m->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<div class="text-center">--}}
                                                {{--<button class="btn btn-primary btn-block" type="submit">Add (XXX)</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<br>--}}
                    {{--</div>--}}
                    <div class="col-sm-12">
                        <div class="card text-center bg-success">
                            @if(empty($members))
                                <div class="card-header">
                                    <h2>No old member to add !</h2>
                                </div>
                            @else
                                <div class="card-header">
                                    <h3>Select member from last month</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('old.add', ['msid' => $msid])}}" method="post">
                                        {{csrf_field()}}
                                        @foreach($members as $m)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="member_ids[]" value="{{$m->id}}" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{$m->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                        <hr>
                                        <div class="form-group">
                                            <div class="text-center">
                                                <button class="btn btn-primary btn-block" type="submit">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>




@include('includes.footer')


{{--Edit user modal--}}
@include('includes.euModal')


<!--script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->


</body>
</html>