@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')

<header id="home-section" class="oM">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Choose, who to add in current month</h1>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
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
                    <div class="col-lg-4"></div>

                </div>
            </div>
        </div>
    </div>
</header>



@include('includes.euModal')

@include('includes.footer')


{{--Edit user modal--}}
@include('includes.euModal')


<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->


</body>
</html>